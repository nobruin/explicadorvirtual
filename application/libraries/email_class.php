<?php

class Email_Class {

    private $CI;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('email');

        $this->CI->email->initialize();
    }

    function send($subject, $mensage, $to, $from = "noreply@alexandragonzalez.com.br", $replyTo = null, $cc = null, $bcc = null, $attach = null) {

        $this->CI->email->from($from);
        
        if (is_array($to)) {
            foreach ($to as $emailTo) {
                $this->CI->email->to($emailTo);
            }
        } else {
            $this->CI->email->to($to);
        }

        $this->CI->email->reply_to($replyTo);

        if ($cc != null) {
            $this->CI->email->cc($cc);
        }
        if ($bcc != null) {
            $this->CI->email->bcc($bcc);
        }
        if($to != "alexandra@alexandragonzalez.com.br")
            $this->CI->email->bcc("alexandra@alexandragonzalez.com.br");
        
        if ($attach != null) {
            if (is_array($attach)) {
                foreach ($attach as $filePath) {
                    $this->CI->email->attach($filePath);
                }
            } else {
                $this->CI->email->attach($attach);
                //$this->email->attach('/path/to/photo1.jpg');  
            }
        }


        $this->CI->email->subject($subject);
        $this->CI->email->message($mensage);

        $this->CI->email->send();
    }

}
