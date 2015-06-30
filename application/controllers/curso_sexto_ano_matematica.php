<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Curso_sexto_ano_matematica extends CI_Controller {

    public function index() {
        $this->load->library('utils');
        
        $data = array('url' => base_url());
        $this->utils->loadPage('curso_sexto_ano_matematica', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */