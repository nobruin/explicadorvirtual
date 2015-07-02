<?php

class Videos_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insert($data) {
        return $this->db->insert('videos', $data);
    }

    function get($where = array(), $fields = array(), $order = "v.video_titulo ASC", $likeOR = null, $limit = null, $offset = null, $likeAND = null) {
        if (count($fields) > 0) {
            $this->db->select($fields);
        }
        $this->db->from('videos v');
        $this->db->join('usuarios us', 'us.usuario_id = v.video_por', 'left');

        if ($likeOR != "" || $likeOR != null) {
            $arrLike = explode(' ', $likeOR);
            for ($i = 0; $i < count($arrLike); $i++) {
                $this->db->or_where("( v.video_titulo LIKE '%{$arrLike[$i]}%')");
            }
        }
        if ($likeAND != "" || $likeAND != null) {
            $arrLike = explode(' ', $likeAND);
            for ($i = 0; $i < count($arrLike); $i++) {
                $this->db->where("( v.video_titulo LIKE '%{$arrLike[$i]}%')");
            }
        }
        $where['v.video_apagado'] = 0;
        if (!empty($where)) {
            $this->db->where($where);
        }
        
        if (!empty($order)) {
            $this->db->order_by($order);
        }

        if ($limit != null) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        echo $this->db->last_query();
        return $query->result();
    }
    
    function getSearch($where = array(), $fields = array(), $order = "v.video_titulo ASC", $likeOR = null, $limit = null, $offset = null, $likeAND = null) {
        if (count($fields) > 0) {
            $this->db->select($fields);
        }
        $this->db->from('videos v');
        $this->db->join('usuarios us', 'us.usuario_id = v.video_por', 'left');

        if ($likeOR != "" || $likeOR != null) {
            $arrLike = explode('-', $likeOR);
            for ($i = 0; $i < count($arrLike); $i++) {
                $this->db->or_where("( v.video_titulo LIKE '%{$arrLike[$i]}%')");
            }
        }
        if ($likeAND != "" || $likeAND != null) {
            $arrLike = explode('-', $likeAND);
            for ($i = 0; $i < count($arrLike); $i++) {
                $this->db->where("( v.video_titulo LIKE '%{$arrLike[$i]}%')");
            }
        }
        $where['v.video_apagado'] = 0;
        if (!empty($where)) {
            $this->db->where($where);
        }
        
        if (!empty($order)) {
            $this->db->order_by($order);
        }

        if ($limit != null) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        echo $this->db->last_query();
        return $query->result();
    }

    function get2($where = array(), $fields = array(), $order = "v.video_titulo ASC", $like = null, $limit = null, $offset = null) {
        if (count($fields) > 0) {
            $this->db->select($fields);
        }   
        $this->db->from('videos v');
        $this->db->join('usuarios us', 'us.usuario_id = v.video_por', 'left');

        if ($like != "" || $like != null) {
            $arrLike = explode(' ', $like);
            for ($i = 0; $i < count($arrLike); $i++) {
                $this->db->or_where("( v.video_titulo LIKE '%{$arrLike[$i]}%')");
            }
        }
        $where['v.video_apagado'] = 0;
        
        if (!empty($where)) {
            $this->db->where($where);
        }
        
        if (!empty($order)) {
            $this->db->order_by($order);
        }

        if ($limit != null) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        return $query;
    }

    function getQtd($where = array(), $fields = array(), $order = "v.video_titulo ASC", $like = null, $limit = null, $offset = null) {
        if (count($fields) > 0) {
            $this->db->select($fields);
        }
        $this->db->from('videos v');
        $this->db->join('usuarios us', 'us.usuario_id = v.video_por', 'left');

        if ($like != "" || $like != null) {
            $arrLike = explode(' ', $like);
            for ($i = 0; $i < count($arrLike); $i++) {
                $this->db->where("( v.video_titulo LIKE '%{$arrLike[$i]}%')");
            }
        }
        $where['v.video_apagado'] = 0;

        $this->db->where($where);
        $this->db->order_by($order);

        if ($limit != null) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->count_all_results();
        
    }

    function isvideoCadastrado($vimeoId) {
        $return = $this->get2(array('video_vimeo_id' => $vimeoId));
        return $return->num_rows > 0;
    }
    
    function set($where = array(), $update = array()) {
        $this->db->where($where);
        $this->db->update('videos', $update);
        echo $this->db->last_query();
        return 1;
    }

}
