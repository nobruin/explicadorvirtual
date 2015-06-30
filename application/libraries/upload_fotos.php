<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Upload_Fotos {

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('image_lib');

        set_time_limit(0);
        ini_set('upload_max_filesize', '64M');
        ini_set('post_max_size', '64M');
    }

    public function gerarByGet($pastaFotoUpload, $fotoUpload, $larguraNovaFoto, $alturaNovaFoto, $pastaNovaFoto, $nomeNovaFoto) {

        $config = array();
        //pego as informaçoes 
        $config['image_library'] = 'gd2';
        $config['source_image'] = $pastaFotoUpload . $fotoUpload;
        $config['maintain_ratio'] = TRUE;
        $config['create_thumb'] = false;
        $config['width'] = $larguraNovaFoto;
        $config['height'] = $alturaNovaFoto;
        $config['new_image'] = $pastaNovaFoto . $nomeNovaFoto;
        $config['file_ext'] = ".jpg";


        $this->CI->image_lib->initialize($config);
        //subo a foto
        if (!$this->CI->image_lib->resize()) {
            $this->CI->session->set_flashdata('flashError', $this->CI->image_lib->display_errors());
            return False;
        }
        //testo a rotacao
        $exif = @exif_read_data($pastaFotoUpload . $fotoUpload);
        $orientation = isset($exif['Orientation']) ? $exif['Orientation'] : 1;

        if (isset($orientation) && $orientation != 1) {

            switch ($orientation) {
                case 3: // 180 rotate left
                    $oris[] = '180';
                    break;

                case 6: // 90 rotate right
                    $oris[] = '270';
                    break;

                case 8: // 90 rotate left
                    $oris[] = '90';
                    break;

                default: break;
            }
        }
        // se for o caso rotaciono 
        if (isset($orientation) && isset($oris)) {
            foreach ($oris as $ori) {
                $config['rotation_angle'] = $ori;
                $this->CI->image_lib->initialize($config);
                $this->CI->image_lib->rotate();
            }
        }
        // limpo as informaçoes dos arquivos
        $this->CI->image_lib->clear();
        Return True;
    }

    public function gerar($pastaFotoUpload, $fotoUpload, $larguraNovaFoto, $alturaNovaFoto, $pastaNovaFoto, $nomeNovaFoto) {

        $config = array();
        //pego as informaçoes 
        $config['image_library'] = 'gd2';
        $config['source_image'] = $pastaFotoUpload . $fotoUpload;
        $config['maintain_ratio'] = TRUE;
        $config['create_thumb'] = false;
        $config['width'] = $larguraNovaFoto;
        $config['height'] = $alturaNovaFoto;
        $config['new_image'] = $pastaNovaFoto . $nomeNovaFoto;
        $config['file_ext'] = ".jpg";

        //testo a rotacao
        $exif = @exif_read_data($pastaFotoUpload . $fotoUpload);
        $orientation = isset($exif['Orientation']) ? $exif['Orientation'] : 1;

        if (isset($orientation) && $orientation != 1) {

            switch ($orientation) {
                case 3: // 180 rotate left
                    $oris[] = '180';
                    break;

                case 6: // 90 rotate right
                    $oris[] = '270';
                    break;

                case 8: // 90 rotate left
                    $oris[] = '90';
                    break;

                default: break;
            }
        }
        // se for o caso rotaciono 
        if (isset($orientation) && isset($oris)) {
            foreach ($oris as $ori) {
                $config['rotation_angle'] = $ori;
                $this->CI->image_lib->initialize($config);
                $this->CI->image_lib->rotate();
            }
        } else {
            $this->CI->image_lib->initialize($config);
        }

        //subo a foto
        if (!$this->CI->image_lib->resize()) {
            $this->CI->session->set_flashdata('flashError', $this->CI->image_lib->display_errors());
            return False;
        }

        // limpo as informaçoes dos arquivos
        $this->CI->image_lib->clear();
        Return True;
    }

    public function criarImagem($picPath, $picName) {

        $config = array();

        $config['image_library'] = 'gd2';
        $config['source_image'] = $picPath;
        $config['maintain_ratio'] = TRUE;
        $config['create_thumb'] = FALSE;
        $config['overwrite'] = true;
        $config['max_size'] = 0; // sem limite
        $config['new_image'] = $picName;

        $this->CI->image_lib->initialize($config);

        if (!$this->CI->image_lib->resize()) {
            $this->CI->session->set_flashdata('flashError', $this->CI->image_lib->display_errors());
            return False;
        }
        $this->CI->image_lib->clear();
        Return True;
    }

    public function resize($picPath, $width, $height) { //redefine o tamanho da foto
        $config = Array();

        $config['image_library'] = 'gd2';
        $config['source_image'] = $picPath;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $width;
        $config['height'] = $height;

        $this->CI->image_lib->initialize($config);

        if (!$this->CI->image_lib->resize()) {
            $this->CI->session->set_flashdata('flashError', $this->CI->image_lib->display_errors());
            $this->CI->image_lib->clear();
            return False;
        }

        $this->CI->image_lib->clear();
        Return True;
    }

    public function cortaImagem($caminhoImagemTemp, $x, $y, $x2, $y2, $caminhoImagem) {
        // recor imagens
        $config['image_library'] = 'gd2';
        $config['source_image'] = $caminhoImagemTemp;
        $config['maintain_ratio'] = false;
        $config['x_axis'] = $x;
        $config['y_axis'] = $y;
        $config['width'] = $x2 - $x;
        $config['height'] = $y2 - $y;
        $config['new_image'] = $caminhoImagem;
        $this->CI->image_lib->initialize($config);
        if (!$this->CI->image_lib->crop()) {
            $this->CI->session->set_flashdata('flashError', $this->CI->image_lib->display_errors());
            $this->CI->image_lib->clear();
            return False;
        }
        $this->CI->image_lib->clear();
        Return True;
    }

    public function girarFotoAutomaticamente($caminhoImagem) {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $caminhoImagem;

        $exif = @exif_read_data($caminhoImagem);
        $orientation = isset($exif['Orientation']) ? $exif['Orientation'] : 1;

        if (isset($orientation) && $orientation != 1) {

            switch ($orientation) {
                case 3: // 180 rotate left
                    $oris[] = '180';
                    break;

                case 6: // 90 rotate right
                    $oris[] = '270';
                    break;

                case 8: // 90 rotate left
                    $oris[] = '90';
                    break;

                default: break;
            }
        }
        // se for o caso rotaciono 
        if (isset($orientation) && isset($oris)) {
            foreach ($oris as $ori) {
                $config['rotation_angle'] = $ori;
                $this->CI->image_lib->initialize($config);
                $this->CI->image_lib->rotate();
            }
        }
        // limpo as informaçoes dos arquivos
        $this->CI->image_lib->clear();
        Return True;
    }

}
