<?php
error_reporting(E_ALL);
require_once ("autoload.php");
require_once ("src/Vimeo/Vimeo.php");
use Vimeo\Vimeo;


class Vimeo_Class
{
    
  /*  // explicador virtual
    private $client_id = '63a892788b059b6af905a00ce773458d08f2a2d6';
    private $client_secret = '1r9y3kRdGikKBwOvcgKJ+F575Jp3UbktRR2w4H6dcwlFGVhRBpZPVh4Vn2xBQiou95/msDL9L8HwNCI6Qun7voIxuesQ/CBzqQAU4gptxcKoLuKVu5jVorF1OAhfuQHF';
    private $token = '6d00a6040de93b255175bae6c8587060';
    private $vimeo, $user = null;
   * 
   */
   
    
    
  //localhost
    var $client_id = "8589c09368605106aa2ab843ae1aa781d025ce4e"; 
     var $client_secret = "d292haF/HAxUjoWHFmQ4RfhbK+3jfNHgwhhgKOD6NGGJD6Z6Ra3ahQt589+ay2idc+xXfLyrqzJCYQwex1VaAWWs9S3neiFlWKqK1ZqEj2oSKvsjUkb/PHB5ffNCjqIY";
     var $vimeo;
     var $token = "c795eb9ca14f748ae4fded096ee11e56";
  
     
    function __construct()
    {
        $this->CI = & get_instance();
        $this->CI->load->model('videos_Model');
        $this->vimeo = new Vimeo($this->client_id, $this->client_secret, $this->token);
        $this->user = $this->vimeo->request('/me');
        
      
    }
    
    function upload($file_path){
     $videoId = $this->vimeo->upload($file_path['file_path'], false);
     $this->vimeo->request($videoId, array('name' => $file_path['file_name'], "privacy" => array('view' => 'nobody')), 'PATCH');
        
     $dataInsert = array('video_vimeo_id' => $videoId, 'video_titulo' => $file_path['file_name'], 'video_por' => $this->CI->session->userdata('usuario_id'));
    
     $this->CI->videos_Model->insert($dataInsert);
     
     return $videoId;
    }
    
    function getAllVideos(){
        return $this->vimeo->request('/me/videos');
    }
    
    function getVideos($parms){
        return $this->vimeo->request('/me/videos', $parms);
    }
    
    
    function getInfoUser(){
        return $this->user;
    }
    
    function getVideo($vimeoId, $parms = array(), $method = 'PATCH', $json_body = true){
        return $this->vimeo->request($vimeoId, $parms, $method, $json_body);
    }
     
}
