<?php

class Aulas_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function insert($data) {
        return $this->db->insert('aulas', $data);
    }
    
   function get($where = array(), $fields = array(), $order = "a.aula_titulo ASC", $like = null, $limit = null, $offset = null) {
        if (count($fields) > 0) {
            $this->db->select($fields);
        }
        $this->db->from('aulas a');
        $this->db->join('usuarios us', 'us.usuario_id = a.aula_por');
        $this->db->join('materias m', 'm.materia_id = a.materia_id');
        $this->db->join('cursos c', 'c.curso_id = a.curso_id');
       
        if ($like != "" || $like != null) {
            $arrLike = explode(' ', $like);
            for ($i = 0; $i < count($arrLike); $i++) {
                $this->db->where("( t.materia_nome LIKE '%{$arrLike[$i]}%')");
            }
        }
        $where['a.aula_apagado'] = 0;
        
        $this->db->where($where);
        $this->db->order_by($order);

        if ($limit != null) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        return $query->result();
    }
}
