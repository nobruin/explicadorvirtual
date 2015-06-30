<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Curso_setimo_ano_geografia extends CI_Controller {

    public function index() {
        $this->load->library('utils');
        
        $data = array('url' => base_url());
        $this->utils->loadPage('curso_setimo_ano_geografia', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */