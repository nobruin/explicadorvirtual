<?php
class Permissao_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function get($where = array(), $fields = array())
    {
        if(count($fields) > 0) $this->db->select($fields);
        $this->db->from('usuarios us');
        $this->db->join('categorias ca', 'us.categoria_id = ca.categoria_id');
        $this->db->join('categorias_acoes caa', 'caa.categoria_id = ca.categoria_id');
        $this->db->join('acoes a', 'a.acao_id = caa.acao_id');
        if(count($where) > 0) $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    
    function hasPermissao($id, $acao)
    {
        $this->db->from('usuarios us');
        $this->db->join('categorias ca', 'us.categoria_id = ca.categoria_id');
        $this->db->join('categorias_acoes caa', 'caa.categoria_id = ca.categoria_id');
        $this->db->where(array('us.usuario_id' => $id, 'caa.acao_id' => $acao));
        return $this->db->count_all_results() > 0;
    }
    
    function getAcoes($idCategoria)
    {
        $this->db->select(array('ac.acao_id', 'ac.acao_nome', 'ca.categoria_id'));
        $this->db->from('acoes ac');
        $this->db->join('categorias_acoes ca', "ca.acao_id = ac.acao_id AND ca.categoria_id = {$idCategoria}", 'left');
        $query = $this->db->get();
        return $query->result();
    }

    function limparAcoes($categoria)
    {
        $this->db->where('categoria_id', $categoria);
        return $this->db->delete('categorias_acoes');
    }

    function insert($categoria, $acao)
    {
        $data = array(
            'categoria_id' => $categoria,
            'acao_id' => $acao
        );
        return $this->db->insert('categorias_acoes', $data);
    }
}