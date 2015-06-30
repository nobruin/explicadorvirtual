<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('utils');
        $this->load->model('usuario_model');
        $this->load->model('permissao_model');
        $this->utils->validateSession();
        $id = $this->session->userdata('usuario_id');
        if ($id) {
            $this->load->model('permissao_model');
            if (!$this->permissao_model->hasPermissao($id, 1)) { // 1 = Cadastro de usuarios
                echo "<script> location.href = '" . base_url() . "administracao' </script>";
            }
        }
    }

    public function index() {
        $this->load->library('utils');
        $this->load->library('pagination');
        $this->load->helper('cookie');
        $busca = $this->input->get_post('busca');
        $limit = 20;
        $arrFields = array();
        $offset = $this->uri->segment(3);

        $arrWhere = array('us.usuario_id <>' => $this->session->userdata('usuario_id'), 'usuario_admin_id is not null' => null);
        $usuarios = $this->usuario_model->get($arrWhere, $arrFields, "us.usuario_login ASC", $busca, $limit, $offset);

        $config['base_url'] = base_url() . 'usuarios/index';
        $config['total_rows'] = $this->usuario_model->getQtd($arrWhere, $arrFields, "us.usuario_login ASC", $busca);
        $config['per_page'] = $limit;
        $config['first_link'] = 'Primeira';
        $config['last_link'] = '&Uacute;ltima';
        $this->pagination->initialize($config);

        $data = array('url' => base_url(),
            'busca' => $busca,
            'usuarios' => $usuarios,
            'paginacao' => $this->pagination->create_links());
        $this->utils->loadPageAdmin('usuario/lista_usuarios_admin', $data);
    }

    public function cadastrar() {
        $this->load->model('categoria_model');
        $usuarioId = $this->input->post('usuarioId'); // testar envio do submit
        $erros = array();
        $qtdErros = 0;

        $descricao = $foto = $nomeFoto = $checkedFeminino = $tituloErros = $categoria = $usuario = $email = $nome = $telefone = $password = $passwordCopia = "";
        $cookieImagem = $this->input->cookie('urlImagem');
        if ($cookieImagem != "") {
            $foto = "src='{$this->input->cookie('urlImagem')}'";
            $nomeFoto = $this->input->cookie('nomeFoto');
        }else if($this->input->post('nomeFoto') != ""){
            $nomeFoto = $this->input->post('nomeFoto');
            $foto = "src='{$this->config->item('usuario_path')}{$nomeFoto}'";            
        }
        
        $checkedMasculino = "checked";
        if ($usuarioId) {

            $usuario = $this->input->post('usuario');
            $nome = $this->input->post('nome');
            $email = $this->input->post('email');
            $telefone = $this->input->post('telefone');
            $password = $this->input->post('password');
            $passwordCopia = $this->input->post('passwordCopia');
            $categoria = $this->input->post('categoria');
            $sexo = $this->input->post('sexo');
            $descricao = $this->input->post('descricao');
            $nomeFoto = $this->input->post('nomeFoto');

            if ($sexo == 'F') {
                $checkedFeminino = "checked";
            } else {
                $checkedMasculino = "checked";
            }

            if (trim($nome) == '') {
                $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o digitou o <b>Nome</b>;";
            }

            if (trim($telefone) == '') {
                $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o digitou nenhum <b>Telefone</b>;";
            }

            if (trim($categoria) == '') {
                $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o selecionou a <b>Categoria</b>;";
            }

            if (trim($email) == '') {
                $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o digitou o <b>E-mail</b>;";
            } else if (!$this->utils->isEmailValido($email)) {
                $erros[]['mensagem'] = "<b>E-mail</b> Inv&aacute;lido;";
            } else if ($this->usuario_model->count(array('us.usuario_email' => $email)) > 0) {
                $erros[]['mensagem'] = "<b>E-mail</b> j&aacute; cadastrado;";
            }

            if (trim($usuario) == '') {
                $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o digitou o <b>Login</b>;";
            } else if ($this->usuario_model->count(array('us.usuario_login' => $usuario)) > 0) {
                $erros[]['mensagem'] = "<b>Login</b> j&aacute; cadastrado;";
            }

            if (trim($password) == '') {
                $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o digitou a <b>Senha</b>;";
            } else if (strlen($password) < 6) {
                $erros[]['mensagem'] = "A <b>Senha</b> deve conter no m&iacute;nimo <b>6 caracteres</b>;";
            } else if ($password != $passwordCopia) {
                $erros[]['mensagem'] = "Os campos <b>Senha</b> e <b>Confirma&ccedil;&atilde;o</b> n&atilde;o conferem;";
            }

            $qtdErros = count($erros);

            if ($qtdErros > 0) {
                $tituloErros = $qtdErros == 1 ? 'O seguinte erro ocorreu:' : 'Os seguintes erros ocorreram:';
            } else {


                $data = array(
                    'usuario_nome' => $nome,
                    'categoria_id' => $categoria,
                    'usuario_telefone' => $telefone,
                    'usuario_email' => $email,
                    'usuario_login' => $usuario,
                    'foto' => $foto,
                    'usuario_sexo' => $sexo,
                    'usuario_descricao' => $descricao,
                    'usuario_senha' => md5($password)
                );
                $UsuarioAdminId = $this->usuario_model->addUsuarioAdmin($data);
                $usuario = $this->usuario_model->getByAdminId($UsuarioAdminId, 'us.usuario_id');
                    
                $caminhoFoto = $this->config->item('usuario_path')."img_usuario{$usuario->usuario_id}.jpg";
                
                rename($this->config->item('usuario_path').$nomeFoto, $caminhoFoto);
                $urlImagem = base_url() . "image/usuarios/img_usuario{$usuario->usuario_id}.jpg";
                
                $this->usuario_model->adicionarFoto($usuario->usuario_id, $urlImagem, $caminhoFoto);
                
                header('location:' . base_url() . 'usuarios');
            }
        }

        // Categorias
        $categorias = array();
        if ($categoria == '') {
            $first = new stdClass();
            $first->categoria_id = '';
            $first->categoria_nome = 'Selecione';
            $first->categoria_selected = 'selected';
            $categorias = array($first);
        }

        $where = array('ca.categoria_id <>' => $this->config->item('categoria_cliente'));
        $fields = array('ca.categoria_id', 'ca.categoria_nome');
        $lista = $this->categoria_model->get($where, $fields);
        for ($i = 0; $i < count($lista); $i++) {
            $lista[$i]->categoria_selected = $lista[$i]->categoria_id == $categoria ? 'selected' : '';
            $categorias[] = $lista[$i];
        }

        $data = array('url' => base_url(),
            'usuario' => $usuario,
            'nome' => $nome,
            'email' => $email,
            'foto' => $foto,
            'nomeFoto' => $nomeFoto,
            'checkedFeminino' => $checkedFeminino,
            'checkedMasculino' => $checkedMasculino,
            'telefone' => $telefone,
            'descricao' => $descricao,
            'usuarioId' => $this->session->userdata('usuario_id'),
            'categorias' => $categorias,
            'tituloErros' => $tituloErros,
            'vis_erros' => $qtdErros == 0 ? 'none' : 'block',
            'erros' => $erros
        );
        $this->utils->loadPageAdmin('usuario/cadastrar_usuario', $data);
    }

    function remover() {
        $id = $this->uri->segment(3);

        $where = array('usuario_id' => $id);
        $update = array('usuario_apagado' => 1);

        $this->usuario_model->set($where, $update);

        header("location:" . base_url() . "usuarios");
    }

    function alterar() {
        $this->load->model('categoria_model');
        $this->load->model('permissao_model');

        $this->load->library('utils');

        $id = $this->uri->segment(3);

        $url = base_url();
        $usuarioId = $this->input->post('usuarioId'); // testar envio do submit
        $permissaoAlterarSenha = $this->permissao_model->hasPermissao($this->session->userdata('usuario_id'), 2);
        $alterarSenha = $this->input->post('alterarSenha');


        $erros = array();
        $qtdErros = 0;
        $descricao =  $tituloErros = $checkedMasculino = $checkedFeminino = '';
        if ($usuarioId) { // submeteu o form
            $id = $this->input->post('id');
            $usuario = $this->input->post('usuario');
            $nome = $this->input->post('nome');
            $email = $this->input->post('email');
            $telefone = $this->input->post('telefone');
            $password = $this->input->post('password');
            $passwordCopia = $this->input->post('passwordCopia');
            $categoria = $this->input->post('categoria');
            $descricao = $this->input->post('descricao');
            $foto = $this->input->post('foto');
            $sexo = $this->input->post('sexo');

            if ($sexo == 'F') {
                $checkedFeminino = "checked";
            } else {
                $checkedMasculino = "checked";
            }


            if (trim($nome) == '') {
                $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o digitou o <b>Nome</b>;";
            }

            if (trim($telefone) == '') {
                $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o digitou nenhum <b>Telefone</b>;";
            }

            if (trim($categoria) == '') {
                $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o selecionou a <b>Categoria</b>;";
            }

            if (trim($email) == '') {
                $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o digitou o <b>E-mail</b>;";
            } else if (!$this->utils->isEmailValido($email)) {
                $erros[]['mensagem'] = "<b>E-mail</b> Inv&aacute;lido;";
            } else if ($this->usuario_model->count(array('us.usuario_email' => $email, 'us.usuario_id <>' => $id)) > 0) {
                $erros[]['mensagem'] = "<b>E-mail</b> j&aacute; cadastrado;";
            }

            if (trim($usuario) == '') {
                $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o digitou o <b>Login</b>;";
            } else if ($this->usuario_model->count(array('us.usuario_login' => $usuario, 'us.usuario_id <>' => $id)) > 0) {
                $erros[]['mensagem'] = "<b>Login</b> j&aacute; cadastrado;";
            }

            if (trim($password) == '') {
                $erros[]['mensagem'] = "Voc&ecirc; n&atilde;o digitou a <b>Senha</b>;";
            } else if (strlen($password) < 6) {
                $erros[]['mensagem'] = "A <b>Senha</b> deve conter no m&iacute;nimo <b>6 caracteres</b>;";
            } else if ($password != $passwordCopia) {
                $erros[]['mensagem'] = "Os campos <b>Senha</b> e <b>Confirma&ccedil;&atilde;o</b> n&atilde;o conferem;";
            }

            $qtdErros = count($erros);
            if ($qtdErros > 0) {
                $tituloErros = $qtdErros == 1 ? 'O seguinte erro ocorreu:' : 'Os seguintes erros ocorreram:';
            } else {
                $data = array(
                    'usuario_nome' => $nome,
                    'categoria_id' => $categoria,
                    'usuario_telefone' => $telefone,
                    'usuario_email' => $email,
                    'usuario_login' => $usuario,
                    'usuario_sexo' => $sexo,
                    'usuario_descricao' => $descricao,
                    'usuario_senha' => md5($password)
                );

                /* if ($permissaoAlterarSenha && $alterarSenha == 1) {
                  $data['usuario_senha'] = md5($senha);
                  } */

                $where = array('usuario_id' => $id);
                $this->usuario_model->setAdmin($where, $data);

                header('location:' . $url . 'usuarios');
                return;
            }
        } else {
            $data = $this->usuario_model->getById($id);

            $nome = $data->usuario_admin_nome;
            $categoria = $data->categoria_id;
            $telefone = $data->usuario_admin_telefone1;
            $email = $data->usuario_email;
            $usuario = $data->usuario_login;
            $descricao = $data->usuario_admin_observacao;



            if ($data->usuario_sexo == 'F') {
                $foto = base_url() . "image/usuarios/foto_mulher.png";
                $checkedFeminino = "checked";
            } else {
                $foto = base_url() . "image/usuarios/foto_homem.png";
                $checkedMasculino = "checked";
            }

            if (!empty($data->usuario_foto)) {
                $foto = $data->usuario_foto;
            }
        }

        // categoria
        $categorias = array();
        if ($categoria == '') {
            $first = new stdClass();
            $first->categoria_id = '';
            $first->categoria_nome = 'Selecione';
            $first->categoria_selected = 'selected';
            $categorias = array($first);
        }

        $where = array('ca.categoria_id <>' => 4);
        $fields = array('ca.categoria_id', 'ca.categoria_nome');
        $lista = $this->categoria_model->get($where, $fields);
        for ($i = 0; $i < count($lista); $i++) {
            $lista[$i]->categoria_selected = $lista[$i]->categoria_id == $categoria ? 'selected' : '';
            $categorias[] = $lista[$i];
        }

        $data = array('url' => base_url(),
            'id' => $id,
            'usuario' => $usuario,
            'nome' => $nome,
            'email' => $email,
            'telefone' => $telefone,
            'usuarioId' => $this->session->userdata('usuario_id'),
            'descricao' => $descricao,
            'categorias' => $categorias,
            'tituloErros' => $tituloErros,
            'vis_erros' => $qtdErros == 0 ? 'none' : 'block',
            'erros' => $erros,
            'checkedFeminino' => $checkedFeminino,
            'checkedMasculino' => $checkedMasculino,
            'foto' => $foto
        );

        if ($permissaoAlterarSenha) { // 2 = alterar senha dos usuarios
            $data['displayPermissao'] = "";
        } else {
            $data['displayPermissao'] = "none";
        }

        $this->utils->loadPageAdmin('usuario/form-alterar', $data);
    }

    public function cadastrarFotoOutroUsuario() {

        $config['url'] = base_url();

        $config['rotBtAddFoto'] = "Adicionar Foto";
        $config['visBtRemover'] = "none";
        $config['idUsuario'] = "";

        $this->load->library('parser');
        $this->parser->parse('usuario/alterarfoto', $config);
    }

    public function alterarFoto() {
        error_reporting(E_ALL);
        $idUsuario = $this->input->get_post('idUsuario');

        // Inicio o Modelo
        $this->load->model("usuario_model");

        // Pego as Informacoes do Corretor
        $usuario = $this->usuario_model->getById($idUsuario);
        $config['url'] = base_url();

        $config['idUsuario'] = $usuario->usuario_id;
        $config['rotBtAddFoto'] = "Adicionar Foto";
        $config['visBtRemover'] = "none";
        if ($usuario->usuario_foto != "") {
            $config['rotBtAddFoto'] = "Alterar Foto";
            $config['visBtRemover'] = "block";
        }

        $this->load->library('parser');
        $this->parser->parse('usuario/alterarfoto', $config);
    }

    function alterar_foto_passo2() {
        $idUsuario = $this->input->get_post('idUsuario');

        $this->load->library("upload_fotos");
        $this->load->library('parser');

        $formValidos = array("image/jpeg", "image/jpg", "image/pjpeg", "image/png");
        if (!in_array($_FILES['foto']['type'], $formValidos)) {
            $this->parser->parse('usuario/formato_img_invalido', array('urlFoto' => $urlFoto));
        } else {

            $this->upload_fotos->criarImagem($_FILES['foto']['tmp_name'], $this->config->item('usuario_path') . 'tmp_img_usuario' . $idUsuario . ".jpg", 500, 375);
            $rand = rand(0, 100000000);
            $urlFoto = base_url() . "image/usuarios/tmp_img_usuario{$idUsuario}.jpg?{$rand}";

            $this->parser->parse('usuario/cortar_foto', array('urlFoto' => $urlFoto, 'idUsuario' => $idUsuario));
        }

        if (file_exists($_FILES['foto']['tmp_name'])) {
            unlink($_FILES['foto']['tmp_name']);
        }

        $this->load->view('usuario/voltar_botao_escolher');
    }

    public function alterar_foto_fim() {
        error_reporting(E_ALL);
        // Recebo as informacoes do FORM
        $this->load->library("upload_fotos");
        $idUsuario = $this->input->get_post('idUsuario');
        $x = $this->input->post('x');
        $y = $this->input->post('y');
        $x2 = $this->input->post('x2');
        $y2 = $this->input->post('y2');
        $w = $this->input->post('w');
        $h = $this->input->post('h');

        // Inicio o Modelo
        $this->load->model("usuario_model");

        // pego a foto temporaria
        $caminhoImagemTemp = $this->config->item('usuario_path') . "tmp_img_usuario{$idUsuario}.jpg";
        // se for alteracao
        if (!empty($idUsuario)) {
            //faco a nova foto
            $caminhoImagem = $this->config->item('usuario_path') . "img_usuario{$idUsuario}.jpg";
            $this->upload_fotos->cortaImagem($caminhoImagemTemp, $x, $y, $x2, $y2, $caminhoImagem);

            $urlImagem = base_url() . "image/usuarios/img_usuario{$idUsuario}.jpg";
            $caminhoFisico = $caminhoImagem;
        } else {
            //pego a pasta temporaria caso a pessoa deslogue em algum momento o garbage colector apaga a foto
            $this->load->helper('cookie');
            
            $temp = md5(date());
            $caminhoImagem =  $this->config->item('usuario_path') . "tmp_img_usuario{$temp}.jpg";

            $this->upload_fotos->cortaImagem($caminhoImagemTemp, $x, $y, $x2, $y2, $caminhoImagem);
            $rand = rand(0, 100000000);
            $urlImagem = base_url() . "image/usuarios/tmp_img_usuario{$temp}.jpg";
            $nomeFoto = "tmp_img_usuario{$temp}.jpg";
            
            $this->input->set_cookie('urlImagem', $urlImagem, 1500);
            $this->input->set_cookie('nomeFoto', $nomeFoto, 1500);
        }
        
        unlink($caminhoImagemTemp);

        if (!empty($idUsuario) && $this->usuario_model->adicionarFoto($idUsuario, $urlImagem, $caminhoFisico)) {
            $rand = rand(0, 100000000);
            $novaURL = $urlImagem . $rand;

            $this->parser->parse('usuario/atualizar_foto', array('urlFoto' => $novaURL, 'cadastro' => FALSE));
        } else {
            $this->parser->parse('usuario/atualizar_foto1', array('urlFoto' => $urlImagem, 'cadastro' => TRUE));
        }
    }

    function pergarFotoTemp() {
        $this->load->helper('cookie');
        echo $this->input->cookie('urlImagem');
    }

}
