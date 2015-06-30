<?php

class Materia_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insert($data) {
        $this->db->insert('materias', $data);
        return $this->db->insert_id();
    }

    function get($where = array(), $fields = array(), $order = "m.materia_nome ASC", $like = null, $limit = null, $offset = null) {
        if (count($fields) > 0) {
            $this->db->select($fields);
        }
        $this->db->from('materias m');

        if ($like != "" || $like != null) {
            $arrLike = explode(' ', $like);
            for ($i = 0; $i < count($arrLike); $i++) {
                $this->db->where("( m.materia_nome LIKE '%{$arrLike[$i]}%')");
            }
        }
        $where['m.materia_apagado'] = 0;

        $this->db->where($where);
        $this->db->order_by($order);

        if ($limit != null) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        return $query->result();
    }

    function getById($id, $fields = array()) {
        $where = array('m.materia_id' => $id);
        $results = $this->get($where, $fields);
        return $results[0];
    }

    function set($where = array(), $update = array()) {
        if (count($where) > 0) {
            $this->db->where($where);
        }
        return $this->db->update('materias', $update);
    }

    function adicionarIcone($idMateria, $img, $caminhoFisico) {

        return $this->db->update('materias', array('materia_icone' => $img, 'materia_icone_caminho_fisico' => $caminhoFisico), array('materia_id' => $idMateria));
    }

}
