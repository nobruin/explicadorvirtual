<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Materias extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->utils->validateSession();
        $this->load->model('permissao_model');
        $this->load->model('materia_model');
        // se nao tiver permissao, volta para o inicio
        $id = $this->session->userdata('usuario_id');
        if ($id) {
            $this->load->model('permissao_model');
            if (!$this->permissao_model->hasPermissao($id, 6)) { // 6 = Cadastro de materias
                echo "<script> location.href = '" . base_url() . "administracao' </script>";
            }
        }
    }

    public function index() {
        $this->load->library('utils');

        $materias = $this->materia_model->get();

        $data = array('url' => base_url(),
            'materias' => $materias);
        $this->utils->loadPageAdmin('materias/lista', $data);
    }

    public function cadastrar() {
        $this->load->library('utils');

        $tituloErros = '';
        $erros = array();
        $materia_nome = '';

        if ($this->input->post('sent')) {
            $materia_nome = $this->input->post('materia_nome');

            if ($materia_nome == '') {
                $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o digitou o nome do materia.";
            }

            if ($_FILES['materia_icone']['name'] == "") {
                $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o escolheu um icone para a matéria.";
            }

            $qtdErros = count($erros);
            if ($qtdErros > 0) {
                $tituloErros = $qtdErros == 1 ? 'O seguinte erro ocorreu' : 'Os seguintes erros ocorreram';
            } else {
                $data = array(
                    'materia_nome' => $materia_nome,
                    'materia_por' => $this->session->userdata('usuario_id')
                );
                //pego o id da materia
                $idMateria = $this->materia_model->insert($data);
                //faco o upload e mudo o nome do icone
                $arrIcone = $this->utils->genericUpload($this->config->item('icone_path'), "icone_materia{$idMateria}", $_FILES['materia_icone'], 'materia_icone');
                //pego o nome do icone
                $nomeIcone = "icone_materia{$idMateria}{$arrIcone['file_ext']}";
                // monto a url
                $urlIcone = base_url() . "image/icones/{$nomeIcone}";
                // monto o caminho fisico
                $caminhoIcone = $this->config->item('icone_path') . $nomeIcone;
                // guardo no banco 
                $this->materia_model->adicionarIcone($idMateria, $urlIcone, $caminhoIcone);

                // redireciono
                header("location:" . base_url() . "materias");
                return;
            }
        }

        $data = array(
            'title' => "Inserir Cursos",
            'materia_nome' => $materia_nome,
            'erros' => $erros,
            'tituloErros' => $tituloErros
        );

        $this->utils->loadPageAdmin('materias/form-add', $data);
    }

    function alterar() {
        $materia_id = $this->uri->segment(3);

        $tituloErros = '';
        $erros = array();

        if ($this->input->post('materia_id')) {
            date_default_timezone_set('America/Sao_Paulo');
            
            $info = new stdClass();
            $info->materia_id = $this->input->post('materia_id');
            $info->materia_nome = $this->input->post('materia_nome');
            $info->materia_icone = $this->input->post('materia_icone2');

            if (trim($info->materia_nome) == '') {
                $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o digitou o nome da materia.";
            }
           
            if (!empty($_FILES['materia_icone']['name']) && !in_array($_FILES['materia_icone']['type'], array('image/jpeg', 'image/png','jpg','png')) ) {
                $erros[]['mensagem'] = "Apenas os formatos de foto jpg e png são permitidos.";
            }

            $qtdErros = count($erros);
            if ($qtdErros > 0) {
                $tituloErros = $qtdErros == 1 ? 'O seguinte erro ocorreu' : 'Os seguintes erros ocorreram';
            } else {

                $idMateria = $info->materia_id;
                $where = array('materia_id' => $info->materia_id);
                $info->materia_por = $this->session->userdata('usuario_id');
                $info->materia_data = date('Y-m-d H:i:s');
                
                unset($info->materia_id);
                //atualizo as informaçoes
                $this->materia_model->set($where, $info);
                if (!empty($_FILES['materia_icone']['name'])) {
                    $materia = $this->materia_model->getByid($idMateria);
                    if(file_exists($materia->materia_icone_caminho_fisico)){
                        unlink($materia->materia_icone_caminho_fisico);
                        echo "ok";
                    }
                    //faco o upload e mudo o nome do icone
                    $arrIcone = $this->utils->genericUpload($this->config->item('icone_path'), "icone_materia{$idMateria}", $_FILES['materia_icone'], 'materia_icone');
                    //pego o nome do icone
                    $nomeIcone = "icone_materia{$idMateria}{$arrIcone['file_ext']}";
                    // monto a url
                    $urlIcone = base_url() . "image/icones/{$nomeIcone}";
                    // monto o caminho fisico
                    $caminhoIcone = $this->config->item('icone_path') . $nomeIcone;

                    // guardo no banco 
                    $this->materia_model->adicionarIcone($idMateria, $urlIcone, $caminhoIcone);
                }

                header("location:" . base_url() . "materias?#");
                return;
            }
        } else {
            $info = $this->materia_model->getById($materia_id, array('m.materia_id', 'm.materia_nome', 'm.materia_icone'));
        }

        $data = array(
            'title' => "Renomear materia",
            'materia_id' => $info->materia_id,
            'materia_nome' => $info->materia_nome,
            'materia_icone' => $info->materia_icone,
            'erros' => $erros,
            'tituloErros' => $tituloErros
        );

        $this->utils->loadPageAdmin('materias/form-alterar', $data);
    }

}
