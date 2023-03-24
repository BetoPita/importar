<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('form', 'html', 'url'));
        $this->load->library('form_validation');
        date_default_timezone_set('America/Mexico_City');
    }

    public function index()
    {
        $this->blade->render('login/login', array(), FALSE);
    }
   
    public function cerrar_sesion()
    {
        $this->session->unset_userdata('id');
        $this->session->sess_destroy();
        redirect('login');
    }
}
