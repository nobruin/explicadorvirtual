<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mapas extends CI_Controller {

    public function index() {
        $this->load->library('utils');
        
        $data = array('url' => base_url());
        $this->utils->loadPage('mapas', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */