<?php

class Categoria_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insert($data) {
        return $this->db->insert('categorias', $data);
    }

    function set($where = array(), $update = array()) {
        if (count($where) > 0) {
            $this->db->where($where);
        }
        return $this->db->update('categorias', $update);
    }

    function get($where = array(), $fields = array(), $order = 'ca.categoria_nome ASC') {
        if (!array_key_exists('ca.categoria_apagado', $where)) {
            $where['ca.categoria_apagado'] = 0;
        }

        if (count($fields) > 0) {
            $this->db->select($fields);
        }
        $this->db->from('categorias ca');
        $this->db->where($where);
        $this->db->order_by($order);
        $query = $this->db->get();
        return $query->result();
    }

    function getById($id, $fields = array()) {
        $where = array('ca.categoria_id' => $id);
        $results = $this->get($where, $fields);
        return $results[0];
    }

    function getInfoByLoginSenha($login, $senha) {
        $fields = array(
            'us.usuario_id',
            'us.usuario_nome',
            'us.usuario_email',
            'us.usuario_login'
        );
        $this->db->select($fields);
        $this->db->from('sys_usuarios us');
        $this->db->where("(usuario_email = '{$login}' OR us.usuario_login = '{$login}')");
        $this->db->where('us.usuario_senha', md5($senha));
        $this->db->where('us.usuario_apagado', 0);

        $query = $this->db->get();
        $result = $query->result();
        return count($result) > 0 ? $result[0] : false;
    }

}
