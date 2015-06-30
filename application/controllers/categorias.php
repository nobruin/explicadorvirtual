<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categorias extends CI_Controller {
   
    public function __construct() {
        parent::__construct();
        $this->load->library('utils');
        $this->load->model('categoria_Model');
        $this->utils->validateSession();
        $id = $this->session->userdata('usuario_id');
        if ($id) {
            $this->load->model('permissao_model');
            if (!$this->permissao_model->hasPermissao($id, 3)) { // 3 = Cadastro de categorias
                echo "<script> location.href = '" . base_url() . "administracao' </script>";
            }
        }
    }
    
    public function index(){
     
        $this->load->model('categoria_model');
        $where = array();
        $fields = array(
            'ca.categoria_id',
            'ca.categoria_nome'
        );
        $categorias = $this->categoria_model->get($where, $fields);
        $data = array(
            'title' => "Cadastro de categorias",
            'categorias' => $categorias
        );
        
        $this->utils->loadPageAdmin('categorias/lista', $data);   
    }
    
    function cadastrar()
    {
        $this->load->model('categoria_model');
        
        $tituloErros = '';
        $erros = array();
        $categoria_nome = '';
        
        if($this->input->post('sent'))
        {
            $categoria_nome = $this->input->post('categoria_nome');
            
            if($categoria_nome == '') $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o digitou o nome da categoria.";

            $qtdErros = count($erros);
            if($qtdErros > 0)
            {
                $tituloErros = $qtdErros == 1 ? 'O seguinte erro ocorreu' : 'Os seguintes erros ocorreram';
            }
            else
            {
                $data = array(
                    'categoria_nome' => $categoria_nome,
                    'categoria_por' => $this->session->userdata('usuario_id')
                );
                $this->categoria_model->insert($data);
                header("location:".base_url()."categorias");
                return;
            }
        }
        
        $data = array(
            'title' => "Inserir categoria",
            'categoria_nome' => $categoria_nome,
            'erros' => $erros,
            'tituloErros' => $tituloErros
        );
        
        $this->utils->loadPageAdmin('categorias/form-add', $data);
    }
    
    function alterar()
    {
        $this->load->model('categoria_model');
        
        $categoria_id = $this->uri->segment(3);
        
        $tituloErros = '';
        $erros = array();
        
        if($this->input->post('categoria_id'))
        {
            date_default_timezone_set('America/Sao_Paulo');
            
            $info = new stdClass();
            $info->categoria_id = $this->input->post('categoria_id');
            $info->categoria_nome = $this->input->post('categoria_nome');
            
            if(trim($info->categoria_nome) == '') $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o digitou o nome da categoria.";

            $qtdErros = count($erros);
            if($qtdErros > 0)
            {
                $tituloErros = $qtdErros == 1 ? 'O seguinte erro ocorreu' : 'Os seguintes erros ocorreram';
            }
            else
            {
                $where = array('categoria_id' => $info->categoria_id);
                $info->categoria_por = $this->session->userdata('usuario_id');
                $info->categoria_data = date('Y-m-d H:i:s');
                unset($info->categoria_id);
                $this->categoria_model->set($where, $info);
                header("location:".base_url()."categorias");
                return;
            }
        }
        else
        {
            $info = $this->categoria_model->getById($categoria_id, array('ca.categoria_id', 'ca.categoria_nome'));
        }
        
        $data = array(
            'title' => "Renomear categoria",
            'categoria_id' => $info->categoria_id,
            'categoria_nome' => $info->categoria_nome,
            'erros' => $erros,
            'tituloErros' => $tituloErros
        );
        
        $this->utils->loadPageAdmin('categorias/form-alterar', $data);
    }    
    
     function remover()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $this->load->model('categoria_model');
        
        $id = $this->uri->segment(3);
        $where = array('categoria_id' => $id);
        $update = array(
            'categoria_apagado' => 1,
            'categoria_apagado_por' => $this->session->userdata('usuario_id'),
            'categoria_apagado_data' => date('Y-m-d H:i:s'),
        );
        
        $this->categoria_model->set($where, $update);
        
        header("location:".base_url()."categorias");
    }

}
