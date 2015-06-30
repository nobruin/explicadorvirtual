<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Folclore extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('utils');
    }

    public function index() {
        $data = array('url' => base_url());
        $this->utils->loadPage('folclores/folclore', $data);
    }

    public function boitata() {

        $data = array('url' => base_url());
        $this->utils->loadPage('folclores/folclore_boitata', $data);
    }

    public function boto() {

        $data = array('url' => base_url());
        $this->utils->loadPage('folclores/folclore_boto', $data);
    }

    public function curupira() {

        $data = array('url' => base_url());
        $this->utils->loadPage('folclores/folclore_curupira', $data);
    }

    public function iara() {

        $data = array('url' => base_url());
        $this->utils->loadPage('folclores/folclore_iara', $data);
    }

    public function lobisomen() {


        $data = array('url' => base_url());
        $this->utils->loadPage('folclores/folclore_lobisomen', $data);
    }

    public function mulasemCabeca() {


        $data = array('url' => base_url());
        $this->utils->loadPage('folclores/folclore_mulasemcabeca', $data);
    }

    public function negrinho() {


        $data = array('url' => base_url());
        $this->utils->loadPage('folclores/folclore_negrinho', $data);
    }

    public function saci() {


        $data = array('url' => base_url());
        $this->utils->loadPage('folclores/folclore_saci', $data);
    }

    public function vitoriaregia() {


        $data = array('url' => base_url());
        $this->utils->loadPage('folclores/folclore_vitoriaregia', $data);
    }

}