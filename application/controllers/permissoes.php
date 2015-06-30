<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permissoes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->utils->validateSession();

        // se nao tiver permissao, volta para o inicio
        $id = $this->session->userdata('usuario_id');
        if ($id) {
            $this->load->model('permissao_model');
            if (!$this->permissao_model->hasPermissao($id, 4)) { // 4 = Definir permissoes
                echo "<script> location.href = '" . base_url() . "administracao' </script>";
            }
        }
    }

    public function index() {
        $this->load->model('usuario_model');
        $this->load->model('categoria_model');

        $where = array();
        $fields = array(
            'ca.categoria_id',
            'ca.categoria_nome'
        );
        $categorias = $this->categoria_model->get($where, $fields);

        $data = array(
            'title' => "Definir permiss&otilde;es",
            'categorias' => $categorias
        );

        $this->utils->loadPageAdmin('permissoes/selecao-categoria', $data);
    }

    function acoes() {
        $this->load->model('permissao_model');

        $idCategoria = $this->input->post('idCategoria');

        $acoes = $this->permissao_model->getAcoes($idCategoria);
        for ($i = 0; $i < count($acoes); $i++) {
            $acoes[$i]->checked = $acoes[$i]->categoria_id != '' ? 'checked' : '';
        }
        $this->parser->parse('permissoes/acoes', array('url' => base_url(), 'acoes' => $acoes));
    }

    function salvar() {
        $this->load->model('permissao_model');

        $categoria = $this->input->post('categoria');
        $acoes = $this->input->post('acoes');
        if (!$acoes)
            $acoes = array();

        $this->permissao_model->limparAcoes($categoria);
        for ($i = 0; $i < count($acoes); $i++) {
            $this->permissao_model->insert($categoria, $acoes[$i]);
        }
        echo 1;
    }

}
