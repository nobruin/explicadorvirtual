<?php

class Resquest_Videos extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('permissao_model');
        $this->load->model('videos_model');
        $this->load->library('vimeo_class');
    }

    public function index() {
        error_reporting(E_ALL);
        ini_set('mysql.connect_timeout', 12000000);
        ini_set('default_socket_timeout', 12000000);
        set_time_limit(120000000);


        $pageNumber = 100;
        $infoVideos = $this->vimeo_class->getVideos(array('per_page' => 1));
        $total = $infoVideos['body']['total'];
        $totalPages = ceil($total / $pageNumber);


        for ($i = 1; $i <= $totalPages; $i++) {
            $allVideos = $this->vimeo_class->getVideos(array('per_page' => $pageNumber, 'page' => $i));


            foreach ($allVideos['body']['data'] as $video) {

                if (!$this->videos_model->isvideoCadastrado($video['uri'])) {

                    $this->vimeo_class->getVideo($video['uri'], array("privacy" => array('view' => 'disable'),
                        'download' => FALSE,
                        'description' => 'cadastrado no banco'));

                    $dataInsert = array('video_vimeo_id' => $video['uri'],
                        'video_titulo' => $video['name'],
                        'vimeo_url' => $video['embed']['html'],
                        'vimeo_picture_uri' => $video['pictures']['uri'],
                        'vimeo_add_date' => substr($video['created_time'], 0, -15),
                        'video_por' => 1
                    );

                    $this->videos_model->insert($dataInsert);

                    echo "o video : {$video['name']} foi cadastrado no banco com sucesso  <br />";
                }
            }
        }
    }

    public function mudarTipo() {
        error_reporting(E_ALL);
        ini_set('mysql.connect_timeout', 12000000);
        ini_set('default_socket_timeout', 12000000);
        set_time_limit(120000000);


        $pageNumber = 100;
        $infoVideos = $this->vimeo_class->getVideos(array('per_page' => 1));
        $total = $infoVideos['body']['total'];
        $totalPages = ceil($total / $pageNumber);


        for ($i = 1; $i <= $totalPages; $i++) {
            $allVideos = $this->vimeo_class->getVideos(array('per_page' => $pageNumber, 'page' => $i));


            foreach ($allVideos['body']['data'] as $video) {

                $this->vimeo_class->getVideo($video['uri'], array("privacy" => array('view' => 'disable'),
                    'download' => FALSE,
                    'description' => 'cadastrado no banco'));

                echo "o video : {$video['name']} mudou para publico  <br />";
                
            }
        }
    }

}
