<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aulas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->utils->validateSession();
        $this->load->model('permissao_model');
        $this->load->model('aulas_model');
        
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
        $this->load->library('utils');

        $aulas = $this->aulas_model->get();

        $data = array('url' => base_url(),
            'aulas' => $aulas);
        $this->utils->loadPageAdmin('aulas/lista', $data);
    }
    
    public function formCadastro(){
        $data = array('url' => base_url());
        $this->utils->loadPageAdmin('aulas/form-add', $data);
    }
    
    public function cadastrarArquivosAula(){
        
        var_dump($this->input->get_post());
        
        var_dump($_FILES);
        
        die();
    }
   
    
}