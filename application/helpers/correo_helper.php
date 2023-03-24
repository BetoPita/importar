<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    function enviar_correo($correo,$titulo,$cuerpo,$archivo=array()){
        
        //  $configGmail = array(
        //     'protocol' => 'smtp',
        //     'smtp_host' => 'smtp.gmail.com',
        //     'smtp_port' => 587,
        //     'smtp_user' => CONST_CORREO_SALIDA,
        //     'smtp_pass' => CONST_PASS_CORREO,
        //     'mailtype' => 'html',
        //     'charset' => 'utf-8',
        //     'smtp_crypto'=> 'tls',
        //     'newline' => "\r\n"
        // );
        $configGmail = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.codigo87.com',
            'smtp_port' => 26,
            'smtp_user' => 'contacto@codigo87.com',
            'smtp_pass' => 'codigo87',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        );
        
        if($correo!='notienecorreo@notienecorreo.com.mx'){
            $CI = & get_instance();
            $CI->email->initialize($configGmail); 
            
            $CI->email->from('contacto@codigo87.com', 'Farmacias JBC');
            $CI->email->to($correo);
            
            //si quieres que te envíen una copia a otro correo descomenta abajo y ponlo
            $CI->email->cc('albertopitava@gmail.com'); 
            $CI->email->subject($titulo);
            $CI->email->message($cuerpo);
            $CI->email->send();
        }
        

        //var_dump($CI->email->print_debugger());exit();
    }
    /************Fin correo_helper.php*********************/

