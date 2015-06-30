<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Videos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->utils->validateSession();
        $this->load->model('permissao_model');
        $this->load->model('videos_model');

        // se nao tiver permissao, volta para o inicio
        $id = $this->session->userdata('usuario_id');
        if ($id) {
            $this->load->model('permissao_model');
            if (!$this->permissao_model->hasPermissao($id, 6)) { // 5 = Cadastro de cursos
                echo "<script> location.href = '" . base_url() . "administracao' </script>";
            }
        }
    }

    public function index() {
        error_reporting(E_ALL);

        $this->load->library('utils');
        $this->load->library('pagination');
        $offset = $this->uri->segment(3);
        $busca = $this->input->get_post('busca');
        $limit = 20;
        $arrWhere = array();
        $arrFields = array();
        $videos = $this->videos_model->get2($arrWhere, $arrFields, "v.video_titulo ASC", $busca, $limit, $offset);

        foreach ($videos->result() as $key => $value) {
            $value->video_vimeo_id = str_replace('videos', 'video', $value->video_vimeo_id);
            //$value->vimeo_url = str_replace('height="720"', 'height="301"', str_replace('width="1280"', 'width="536"', $value->vimeo_url));
        }

        $config['base_url'] = base_url() . 'videos/index';
        $config['total_rows'] = $this->videos_model->getQtd($arrWhere, $arrFields, "v.video_titulo ASC", $busca);
        $config['per_page'] = $limit;
        $config['first_link'] = 'Primeira';
        $config['last_link'] = '&Uacute;ltima';
        $this->pagination->initialize($config);


        $data = array('url' => base_url(),
            'videos' => $videos->result(),
            'busca' => $busca,
            'paginacao' => $this->pagination->create_links()
        );


        $this->utils->loadPageAdmin('videos/lista', $data);
    }

    public function cadastrar() {

        $data = array('url' => base_url());
        $this->utils->loadPageAdmin('videos/form-add', $data);
    }

    public function do_upload() {
        error_reporting(E_ALL);

        $this->load->library('vimeo_class');
        $file_data = array();

        $file_data['file_name'] = $_FILES['files']['name'][0];
        $file_data['file_size'] = $_FILES['files']['size'][0];
        $file_data['file_type'] = $_FILES['files']['type'][0];
        $file_data['file_path'] = $_FILES['files']['tmp_name'][0];

        $vimeoId = $this->vimeo_class->upload($file_data);

        if (!empty($vimeoId)) {
            $this->load->view('videos/upload_success', array('upload_data' => $file_data));
        } else {
            $this->load->view('videos/delete_sucess', array('upload_data' => $file_data));
        }
    }

    function remover() {
        $id = $this->uri->segment(3);
        $where = array('video_id' => $id);
        $update = array('video_apagado' => 1);

        $this->videos_model->set($where, $update);

        header("location:" . base_url() . "videos");
    }

    function gerarRelatorioVideos() {
        error_reporting(E_ALL);
        $this->load->library('image_lib');
        $this->load->library('vimeo_class');

        set_time_limit(0);
        ini_set('upload_max_filesize', '64M');
        ini_set('post_max_size', '64M');

        ini_set('mysql.connect_timeout', 12000000);
        ini_set('default_socket_timeout', 12000000);
        set_time_limit(120000000);


        $pageNumber = 100;
        $infoVideos = $this->vimeo_class->getVideos(array('per_page' => 1));
        $total = $infoVideos['body']['total'];
        $totalPages = ceil($total / $pageNumber);

        $arrRelatorio = array();

        for ($i = 1; $i <= $totalPages; $i++) {
            $allVideos = $this->vimeo_class->getVideos(array('per_page' => $pageNumber, 'page' => $i));

            foreach ($allVideos['body']['data'] as $video) {
                $arrRelatorio[] = array('nome' => $video['name'],
                    'video_id' => $video['uri'],
                    'duracao' => round($video['duration'] / 60),
                    'dataCadastro' => $video['created_time']);
            }

            $content = $this->parser->parse('relatorios/relatorio_videos', array('relatorioVideos' => $arrRelatorio), true);

            $this->output
                    ->set_header("Last-Modified: " . gmdate('D, d M Y H:i:s', time()) . ' GMT')
                    ->set_header("Cache-control: max-age=86400")
                    ->set_header("Content-Disposition: inline; filename='relatorio_videos_upados.xls'")
                    ->set_content_type("application/octet-stream")
                    ->set_output($content);
            
        }
    }
}