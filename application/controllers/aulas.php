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
        $this->load->model('materia_model');
        $this->load->model('usuario_model');
        $this->load->model('videos_model');
        $this->load->model('curso_model');
       
        $arrAulapdf = explode('-',$_FILES['aulaPdf']['name']);
        
        var_dump($arrAulapdf);
        
        $anoAula = (int) preg_replace("/[^0-9]/","", $arrAulapdf[0]);
        $curso = $this->curso_model->get(null, null, null, $anoAula);
        $materiaSearch = explode('(',trim($arrAulapdf[1]));
        $materia = $this->materia_model->get(null, null, null, trim($materiaSearch[0]));
        $numeroAula = (int) preg_replace("/[^0-9]/","", $arrAulapdf[2]);
        if($numeroAula < 9){
            $numeroAula = "00$numeroAula";
        }
        $nomeProfessor = explode(' ',str_replace(')','',$materiaSearch[1]));
        $likeVideos = "{$numeroAula}{$nomeProfessor[0]}-{$nomeProfessor[0]}-{$nomeProfessor[0]} {$numeroAula}";
        $likeAND = "{$nomeProfessor[0]}-{$numeroAula}";
        $video = $this->videos_model->getSearch(null, null, 'v.video_titulo', null, null, null, $likeAND);
        //var_dump($materia);
        //var_dump($curso);
        var_dump($video);
        var_dump($numeroAula);
        var_dump($nomeProfessor);
        
        
        //var_dump($_FILES['mapaAula']);
        
        die();
    }
   
    
}