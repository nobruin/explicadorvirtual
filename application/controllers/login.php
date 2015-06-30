<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->model('usuario_model');
        //$this->load->library('utils');
        $this->load->helper('cookie');
    }


    public function index() {

     $login = $this->input->get_post('login');
     $senha = $this->input->get_post('senha');
        $manterConectado = true;
        $msg = '';
        
        if($login != '' && $senha != '')
        {
            $info = $this->usuario_model->getInfoByLoginSenha($login, $senha);
            
            if($info)
            {
                $this->session->set_userdata($info);
                if($manterConectado && $info->usuario_admin_id != null)
                {
                    $enc_id = $this->encrypt->encode($info->usuario_id);
                    $this->input->set_cookie('enc_id', $enc_id, 8650000);
                    
                    echo 1;
                    return;
                }else{
                    
                }
                
               /* if($this->utils->isCliente())
                {
                    header('location:'.base_url().'chamados');
                }
                else
                {*/
                   // header('location:'.base_url().'administracao');
                   //echo  'location:'.base_url().'administracao';
               // }
                
            }
            else
            {
              echo  $msg = 'Usuário/e-mail ou senha inválido.';
              return;
            }
        }else{
            if($login == "" || $login == null)
                echo "Você precisa digitar o Login. \n.";
                
            if($senha == "" || $senha == null)
                echo "Você precisa digitar a Senha. \n.";
        }
        
        $enc_id = $this->input->cookie('enc_id');
        if($enc_id)
        {
           /* $id = $this->encrypt->decode($enc_id);
            $info = $this->usuario_model->getById($id);
            if($info)
            {
                $this->session->set_userdata($info);
                header('location:'.base_url().'administracao/');
                return;
            }*/
        }
        
       /* $data = array(
            'url' => base_url(),
            'login' => $login,
            'senha' => $senha,
            'msg' => $msg
        );
        $this->parser->parse('admin/inicio', $data);*/
    }
    
    public function logout()
    {
        $this->load->helper('cookie');
        
        $this->session->sess_destroy();
        $enc_id = $this->input->cookie('enc_id');
        if($enc_id)
        {
            delete_cookie("enc_id");
        }

        header('location:'.base_url());
    }
    
}