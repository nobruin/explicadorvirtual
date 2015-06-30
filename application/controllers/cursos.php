<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cursos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->utils->validateSession();
        $this->load->model('permissao_model');
        $this->load->model('curso_model');
        // se nao tiver permissao, volta para o inicio
        $id = $this->session->userdata('usuario_id');
        if ($id) {
            $this->load->model('permissao_model');
            if (!$this->permissao_model->hasPermissao($id, 5)) { // 5 = Cadastro de cursos
                echo "<script> location.href = '" . base_url() . "administracao' </script>";
            }
        }
    }

    public function index() {
        $this->load->library('utils');

        $cursos = $this->curso_model->get();

        $data = array('url' => base_url(),
            'cursos' => $cursos);
        $this->utils->loadPageAdmin('cursos/lista', $data);
    }

    public function cadastrar() {
        $tituloErros = '';
        $erros = array();
        $curso_nome = '';

        if ($this->input->post('sent')) {
            $curso_nome = $this->input->post('curso_nome');

            if ($curso_nome == '')
                $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o digitou o nome do curso.";

            $qtdErros = count($erros);
            if ($qtdErros > 0) {
                $tituloErros = $qtdErros == 1 ? 'O seguinte erro ocorreu' : 'Os seguintes erros ocorreram';
            } else {
                $data = array(
                    'curso_nome' => $curso_nome,
                    'curso_por' => $this->session->userdata('usuario_id')
                );
                $idCurso = $this->curso_model->insert($data);
                // faco o upload e renomeio
                $arrIcone = $this->utils->genericUpload($this->config->item('icone_path'), "icone_curso{$idCurso}", $_FILES['curso_icone'], 'curso_icone');
                //pego o nome do icone
                $nomeIcone = "icone_curso{$idCurso}{$arrIcone['file_ext']}";
                // monto a url
                $urlIcone = base_url() . "image/icones/{$nomeIcone}";
                // monto o caminho fisico
                $caminhoIcone = $this->config->item('icone_path') . $nomeIcone;
                // guardo no banco 
                $this->curso_model->adicionarIcone($idCurso, $urlIcone, $caminhoIcone);

                // redireciono
                header("location:" . base_url() . "cursos");
                return;
            }
        }

        $data = array(
            'title' => "Inserir Cursos",
            'curso_nome' => $curso_nome,
            'erros' => $erros,
            'tituloErros' => $tituloErros
        );

        $this->utils->loadPageAdmin('cursos/form-add', $data);
    }

    function alterar() {
        $curso_id = $this->uri->segment(3);

        $tituloErros = '';
        $erros = array();

        if ($this->input->post('curso_id')) {
            date_default_timezone_set('America/Sao_Paulo');

            $info = new stdClass();
            $info->curso_id = $this->input->post('curso_id');
            $info->curso_nome = $this->input->post('curso_nome');
            $info->curso_icone = $this->input->post('curso_icone2');

            if (trim($info->curso_nome) == '') {
                $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o digitou o nome da curso.";
            }

            if (!empty($_FILES['curso_icone']['name']) && !in_array($_FILES['curso_icone']['type'], array('image/jpeg', 'image/png','jpg','png')) ) {
                $erros[]['mensagem'] = "Apenas os formatos de foto jpg e png são permitidos.";
            }
            
            $qtdErros = count($erros);
            if ($qtdErros > 0) {
                $tituloErros = $qtdErros == 1 ? 'O seguinte erro ocorreu' : 'Os seguintes erros ocorreram';
            } else {
                $idCurso = $info->curso_id;
                $where = array('curso_id' => $info->curso_id);
                $info->curso_por = $this->session->userdata('usuario_id');
                $info->curso_data = date('Y-m-d H:i:s');
                unset($info->curso_id);
                //altero o registro
                $this->curso_model->set($where, $info);

                if (!empty($_FILES['curso_icone']['name'])) {
                    
                    $curso = $this->curso_model->getByid($idCurso);
                    if(file_exists($curso->curso_icone_caminho_fisico)){
                        unlink($curso->curso_icone_caminho_fisico);
                        echo "ok";
                    }
                    //altero a foto
                    $arrIcone = $this->utils->genericUpload($this->config->item('icone_path'), "icone_curso{$idCurso}", $_FILES['curso_icone'], 'curso_icone');
                    //pego o nome do icone
                    $nomeIcone = "icone_curso{$idCurso}{$arrIcone['file_ext']}";
                    // monto a url
                    $urlIcone = base_url() . "image/icones/{$nomeIcone}";
                    // monto o caminho fisico
                    $caminhoIcone = $this->config->item('icone_path') . $nomeIcone;
                    // guardo no banco 
                    $this->curso_model->adicionarIcone($idCurso, $urlIcone, $caminhoIcone);
                }

                header("location:" . base_url() . "cursos");
                return;
            }
        } else {
            $info = $this->curso_model->getById($curso_id, array('c.curso_id', 'c.curso_nome', 'c.curso_icone'));
        }

        $data = array(
            'title' => "Renomear curso",
            'curso_id' => $info->curso_id,
            'curso_nome' => $info->curso_nome,
            'curso_icone' => $info->curso_icone,
            'erros' => $erros,
            'tituloErros' => $tituloErros
        );

        $this->utils->loadPageAdmin('cursos/form-alterar', $data);
    }

}
