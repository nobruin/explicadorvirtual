<?php
class utils
{
    function __construct()
    {
        $this->CI = & get_instance();
    }
    
    function dbToDate($date)
    {
        $arr = explode('-', $date);
        return $arr[2].'/'.$arr[1].'/'.$arr[0];
    }
    
    function dateToDb($date)
    {
        $arr = explode('/', $date);
        return $arr[2].'-'.$arr[1].'-'.$arr[0];
    }
    
    function getDataByTimestamp($date)
    {
        $arr = explode(' ', $date);
        return $this->dbToDate($arr[0]);
    }
    
    function cutString($string, $size = 100, $end = '...')
    {
        return strlen($string) > $size ? substr($string, 0, $size).$end : $string;
    }
    
    function getHoraByTimestamp($date)
    {
        $arr = explode(' ', $date);
        return $arr[1];
    }
    
    function validateSession()
    {
        $this->CI->load->library('session');
        if(!$this->CI->session->userdata('usuario_id'))
        {
            echo "<script> location.href = '".base_url()."' </script>";
        }
    }
    
    function isCliente()
    {
        return $this->CI->session->userdata('categoria_id') == $this->CI->config->item('categoria_cliente');
    }
    
    function loadPageAdmin($page, $data = array(), $scripts = array())
    {
        //$this->CI->load->model('permissao_model');
  
        $data['scripts'] = $scripts;

        $data['display_inicio'] = $this->isCliente() ? 'none' : 'block';
        $data['url'] = base_url();
        
        $this->CI->parser->parse('admin/cabecalho', $data);
        $this->CI->parser->parse($page, $data);
        $this->CI->parser->parse('admin/rodape', $data);
    }
    
    
    function loadPage($page, $data = array(), $scripts = array())
    {
        //$this->CI->load->model('permissao_model');

        //$url = base_url();
        //$defaultData = array('url' => $url);
        //$data = array_merge($data, $defaultData);
        
        $data['scripts'] = $scripts;

        
        $this->CI->parser->parse('cabecalho', $data);
        $this->CI->parser->parse($page, $data);
        $this->CI->parser->parse('rodape', $data);
    }
    
    function isEmailValido($email)
    {
        return preg_match("/^[a-z0-9\._-]+@+[a-z0-9\._-]+\.+[a-z]{2,3}$/", $email);
    }
    
    function generateHashSenha($id, $email)
    {
        return md5($id.'|'.$email);
    }

    function separarLista($lista, $separador = ", ", $usaE = true)
    {
        $retorno = "";
        for($i = 0; $i < count($lista); $i++)
        {
            if($i == 0)
            {
                $retorno .= $lista[$i];
            }
            else if($i == count($lista) - 1)
            {
                if($usaE) $retorno .= " e " . $lista[$i];
            }
            else
            {
                $retorno .= $separador . $lista[$i];
            }
        }
        return $retorno;
    }
    
    function genericUpload($pathArquivo, $nomeArquivo, $arquivoOriginal, $inputName){
        
        set_time_limit(0);
        ini_set('upload_max_filesize', '64M');
        ini_set('post_max_size', '64M');
        error_reporting(E_ALL);
      
        $pasta_arquivos = $pathArquivo;
        
        $config['upload_path'] = $pasta_arquivos;
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx';
        $config['overwrite'] = true;
        $config['max_size'] = 0; // sem limite
        $nome_original = $arquivoOriginal['name'];
        $partes = explode('.', $nome_original);
        
        
        $nome_banco = $nomeArquivo;
        $extensao = end($partes);
        
        $config['file_name'] = $nome_banco.'.'.$extensao;
        
        $this->CI->load->library('upload', $config);
        if(!$this->CI->upload->do_upload($inputName)){
                $error = array('error' => $this->CI->upload->display_errors());
                print_r($error);
        }
        else
        {
                $arr_image = array('upload_data' => $this->CI->upload->data());
                return $arr_image['upload_data'];
        }
    }

}