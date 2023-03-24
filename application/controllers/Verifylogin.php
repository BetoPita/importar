<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('administrador', '', TRUE);
  }

  function index()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', 'usuario', 'trim|required');
    $this->form_validation->set_rules('password', 'contraseña', 'trim|required|callback_check_database');
    if ($this->form_validation->run() == FALSE) {
      $data['mensaje_login'] = "Nombre o contraseña incorrecto";
      $this->blade->render('login/login', $data, FALSE);
    } else {
      redirect('import', 'refresh');
    }
  }

  function check_database($password)
  {
    //Field validation succeeded.  Validate against database
    $username = $this->input->post('username');
    //query the database
    $result = $this->administrador->login($username, $password);
    if ($result) {
      if(!$result[0]->activo){
        $this->form_validation->set_message('check_database', 'El usuario está desactivado, por favor contacta al administrador');
        return false;
      }
      $this->session->set_userdata('id',$result[0]->id);
      $this->session->set_userdata('email',$result[0]->email);
      $this->session->set_userdata('nombre',$result[0]->nombre);
      $this->session->set_userdata('perfil_id',$result[0]->perfil_id);
      return TRUE;
    } else {
      $this->form_validation->set_message('check_database', 'Usuario o contraseña inválidos');
      return false;
    }
  }
  function logout()
  {
    $this->session->destroy();
    redirect('/', 'refresh');
  }
}
