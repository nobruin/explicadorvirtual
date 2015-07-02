<?php

class Curso_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function insert($data) {
        $this->db->insert('cursos', $data);
        return $this->db->insert_id();
    }
    
   function get($where = array(), $fields = array(), $order = "c.curso_nome ASC", $like = null, $limit = null, $offset = null) {
        if (count($fields) > 0) {
            $this->db->select($fields);
        }
        $this->db->from('cursos c');
       
        if ($like != "" || $like != null) {
            $arrLike = explode(' ', $like);
            for ($i = 0; $i < count($arrLike); $i++) {
                $this->db->or_where("( c.curso_nome LIKE '%{$arrLike[$i]}%')");
            }
        }
        $where['c.curso_apagado'] = 0;
        if($where != null){
            $this->db->where($where);
        }
        
        if($order != null){
            $this->db->order_by($order);
        }

        if ($limit != null) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        return $query->result();
    }
    
    function getById($id, $fields = array()) {
        $where = array('c.curso_id' => $id);
        $results = $this->get($where, $fields);
        return $results[0];
    }
    
    function set($where = array(), $update = array()) {
        if (count($where) > 0) {
            $this->db->where($where);
        }
        return $this->db->update('cursos', $update);
    }
    
    function adicionarIcone($idcurso, $img, $caminhoFisico) {
        return $this->db->update('cursos', array('curso_icone' => $img, 'curso_icone_caminho_fisico' => $caminhoFisico), array('curso_id' => $idcurso));
    }
    
}
