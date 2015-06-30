<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teste extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $data = array('url' => base_url());
        
        
        $this->parser->parse('teste', $data);
    }

}
