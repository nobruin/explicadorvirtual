<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mapas_estados extends CI_Controller {

    public function index() {
        $this->load->library('utils');
        
        $data = array('url' => base_url());
        $this->utils->loadPage('mapas_estados', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */