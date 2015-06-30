<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administracao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('utils');
        $this->utils->validateSession();
    
    }
    
    public function index() {
       $data = array('url' => base_url());
       $this->utils->loadPageAdmin('admin/panel', $data);
    }
    
}
