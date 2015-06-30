<?php

class Usuario_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get($where = array(), $fields = array(), $order = "us.usuario_login ASC", $like = null, $limit = null, $offset = null) {
        if (count($fields) > 0) {
            $this->db->select($fields);
        }
        $this->db->from('usuarios us');
        $this->db->join('categorias ca', 'ca.categoria_id = us.categoria_id', 'left');
        $this->db->join('usuarios_admin ua', 'ua.usuario_id = us.usuario_id', 'left');


        if ($like != "" || $like != null) {
            $arrLike = explode(' ', $like);
            for ($i = 0; $i < count($arrLike); $i++) {
                $this->db->where("( us.usuario_email LIKE '%{$arrLike[$i]}%' OR
                                    ca.categoria_nome LIKE '%{$arrLike[$i]}%' OR
                                ua.usuario_admin_nome LIKE '%{$arrLike[$i]}%')");
            }
        }
        $where['us.usuario_apagado'] = 0;

        $this->db->where($where);
        $this->db->order_by($order);

        if ($limit != null) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        return $query->result();
    }
    
    function getQtd($where = array(), $fields = array(), $order = "us.usuario_login ASC", $like = null, $limit = null, $offset = null) {
        if (count($fields) > 0) {
            $this->db->select($fields);
        }
        $this->db->from('usuarios us');
        $this->db->join('categorias ca', 'ca.categoria_id = us.categoria_id', 'left');
        $this->db->join('usuarios_admin ua', 'ua.usuario_id = us.usuario_id', 'left');


        if ($like != "" || $like != null) {
            $arrLike = explode(' ', $like);
            for ($i = 0; $i < count($arrLike); $i++) {
                 $this->db->where("( us.usuario_email LIKE '%{$arrLike[$i]}%' OR
                                    ca.categoria_nome LIKE '%{$arrLike[$i]}%' OR
                                ua.usuario_admin_nome LIKE '%{$arrLike[$i]}%')");
            }
        }
        $where['us.usuario_apagado'] = 0;

        $this->db->where($where);
        $this->db->order_by($order);

        if ($limit != null) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->count_all_results();
       
    }

    function set($where = array(), $update = array()) {
        $this->db->where($where);
        return $this->db->update('usuarios', $update);
    }
    
    function setUsuariosAdmin($where = array(), $update = array()){
        if (count($where) > 0) {
            $this->db->where($where);
        }
        return $this->db->update('usuarios_admin', $update);
    }
    
    function setAdmin($where = array(), $update = array()){
            $updateUsuario = array('usuario_login' => $update['usuario_login'],
                        'usuario_email' => $update['usuario_email'],
                        'usuario_senha' => $update['usuario_senha'],	
                        'categoria_id' => $update['categoria_id'],
                        'usuario_sexo' => $update['usuario_sexo']
                    );
        
        $this->set($where, $updateUsuario);
        
        $updateUsuarioAdmin = array(
            'usuario_admin_nome' => $update['usuario_nome'],
            'usuario_admin_email' => $update['usuario_email'],
            'usuario_admin_telefone1' => $update['usuario_telefone'],
            'usuario_admin_observacao' => $update['usuario_descricao'],
            'cadastrado_por' => $this->session->userdata('usuario_id')
        );
        
        return $this->setUsuariosAdmin($where, $updateUsuarioAdmin);
    }

    function add($data) {
        $this->db->insert('usuarios', $data);
        return $this->db->insert_id();
    }

    function addUsuarioAdmin($data) {
        
        $dataUsuario = array('usuario_login' => $data['usuario_login'],
                        'usuario_email' => $data['usuario_email'],
                        'usuario_senha' => $data['usuario_senha'],	
                        'categoria_id' => $data['categoria_id'],
                        'usuario_sexo'=> $data['usuario_sexo'],
                        'usuario_aprovado' => 1,
                        'usuario_aprovado_data' => date('Y-m-d H:i:s')
                    );
        
        
        $this->add($dataUsuario);
        $idUsuario = $this->db->insert_id();


        $dataUsuarioAdmin = array(
            'usuario_admin_nome' => $data['usuario_nome'],
            'usuario_admin_email' => $data['usuario_email'],
            'usuario_admin_telefone1' => $data['usuario_telefone'],
            'usuario_admin_observacao' => $data['usuario_descricao'],
            'usuario_id' => $idUsuario,
            'cadastrado_por' => $this->session->userdata('usuario_id')
        );
        
        return $this->adicionarUsuarioAdmin($dataUsuarioAdmin);
    }
    
    function adicionarUsuarioAdmin($data){
        $this->db->insert('usuarios_admin', $data);
        return $this->db->insert_id();

    }

    function count($where = array()) {
        $where['us.usuario_apagado'] = 0;

        $this->db->from('usuarios us');
        $this->db->where($where);
        return $this->db->count_all_results();
    }

    function atualizarDepartamentos($usuario_id, $departamentos) {
        // removo os departamentos atuais
        $this->db->where('usuario_id', $usuario_id);
        $this->db->delete('usuarios_departamentos');

        // adiciono os novos
        for ($i = 0; $i < count($departamentos); $i++) {
            $data = array(
                'usuario_id' => $usuario_id,
                'departamento_id' => $departamentos[$i]
            );
            $this->db->insert('usuarios_departamentos', $data);
        }
    }

    function getDepartamentosByUsuarios($usuario_id = null, $apenas_ids = false) {
        $this->db->select(array('u.usuario_id', 'd.departamento_id', 'd.departamento_nome'));
        $this->db->from('usuarios u');
        $this->db->join('usuarios_departamentos ud', 'ud.usuario_id = u.usuario_id', 'left');
        $this->db->join('sys_departamentos d', 'd.departamento_id = ud.departamento_id', 'left');
        $this->db->where('u.usuario_apagado', 0);
        if ($usuario_id != null)
            $this->db->where('u.usuario_id', $usuario_id);
        $this->db->order_by('d.departamento_nome', 'ASC');
        $query = $this->db->get();
        $results = $query->result();
        $list = array();
        for ($i = 0; $i < count($results); $i++) {
            if ($apenas_ids) {
                $list[] = $results[$i]->departamento_id;
            } else if ($results[$i]->departamento_nome == '') {
                $list[$results[$i]->usuario_id] = array();
            } else {
                $list[$results[$i]->usuario_id][] = $results[$i]->departamento_nome;
            }
        }
        return $list;
    }

    function getClientes($where = array(), $fields = array(), $order = "us.usuario_nome ASC", $like = null, $limit = null, $offset = null) {
        if (count($fields) > 0) {
            $this->db->select($fields);
        }
        $this->db->from('usuarios us');
        $this->db->join('sys_categorias ca', 'ca.categoria_id = us.categoria_id');
        $this->db->join('sys_empresas emp', 'emp.empresa_id = us.empresa_id', 'left');



        if ($like != "" || $like != null) {
            $arrLike = explode(' ', $like);
            for ($i = 0; $i < count($arrLike); $i++) {
                $this->db->where("(emp.empresa_nome_fantasia LIKE '%{$arrLike[$i]}%'
                              OR  us.usuario_email LIKE '%{$arrLike[$i]}%'
                              OR  us.usuario_nome LIKE '%{$arrLike[$i]}%')");
            }
        }
        $where['us.usuario_apagado'] = 0;
        $where['emp.empresa_apagado'] = 0;

        $this->db->where($where);
        $this->db->order_by($order);

        if ($limit != null) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        return $query->result();
    }

    function getByIdCliente($id, $fields = array()) {
        $where = array('us.usuario_id' => $id);
        $results = $this->getClientes($where, $fields);
        return $results[0];
    }

    function getById($id, $fields = array()) {
        $where = array('us.usuario_id' => $id);
        $results = $this->get($where, $fields);
        return $results[0];
    }
    
    function getByAdminId($id, $fields = array()) {
        $where = array('ua.usuario_admin_id' => $id);
        $results = $this->get($where, $fields);
        return $results[0];
    }

    function getInfoByLoginSenha($login, $senha) {

        $this->db->from('usuarios us');
        $this->db->join('usuarios_admin ua', 'ua.usuario_id = us.usuario_id', 'left');
        $this->db->where("(usuario_email = '{$login}' OR us.usuario_login = '{$login}')");
        $this->db->where('us.usuario_senha', md5($senha));
        $this->db->where('us.usuario_apagado', 0);
        $this->db->where('us.usuario_aprovado', 1);

        $query = $this->db->get();
        $result = $query->result();
        return count($result) > 0 ? $result[0] : false;
    }

    function getIdsDepartamentos($usuario_id) {
        $this->db->select('departamento_id');
        $this->db->from('usuarios_departamentos');
        $this->db->where('usuario_id', $usuario_id);
        $query = $this->db->get();
        $results = $query->result();
        $deps = array();
        for ($i = 0; $i < count($results); $i++) {
            $deps[] = $results[$i]->departamento_id;
        }
        return $deps;
    }
    
    function adicionarFoto($idUsuario, $img, $caminhoFisico){
        
        return $this->db->update('usuarios', array('usuario_foto' => $img, 'usuario_foto_caminho_fisico' => $caminhoFisico), array('usuario_id' => $idUsuario));
    }

}
