<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Folclore_saci extends CI_Controller {

    public function index() {
        $this->load->library('utils');
        
        $data = array('url' => base_url());
        $this->utils->loadPage('folclore_saci', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */