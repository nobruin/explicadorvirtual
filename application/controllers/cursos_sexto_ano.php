<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cursos_sexto_ano extends CI_Controller {

    public function index() {
        $this->load->library('utils');
        
        $data = array('url' => base_url());
        $this->utils->loadPage('cursos_sexto_ano', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */