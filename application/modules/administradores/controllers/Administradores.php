<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Administradores extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->model('Administradores_model');
    $this->ip_address    = $_SERVER['REMOTE_ADDR'];
    $this->datetime       = date("Y-m-d H:i:s");

    if (!isset($_SESSION['id'])) {
      redirect(base_url('login'));
    }
  }
  function perfil()
  {
    if ($this->input->post()) {

      $this->form_validation->set_rules('imagen', 'imagen', 'trim|required');
      $this->form_validation->set_rules('nombre', 'nombre', 'trim|required');
      $this->form_validation->set_rules('telefono', 'teléfono', 'trim|numeric|required');
      $this->form_validation->set_rules('cedula', 'cédula', 'trim|required');
      $this->form_validation->set_rules('nivel_estudios', 'nivel de estudios', 'trim|required');
      $this->form_validation->set_rules('escuela', 'escuela', 'trim|required');
      if ($this->form_validation->run()) {
        $this->Administradores_model->actualizarGeneralesDr();
      } else {
        $errors = array(
          'imagen' => form_error('imagen'),
          'nombre' => form_error('nombre'),
          'telefono' => form_error('telefono'),
          'cedula' => form_error('cedula'),
          'nivel_estudios' => form_error('nivel_estudios'),
          'escuela' => form_error('escuela'),
        );
        echo json_encode($errors);
        exit();
      }
    }
    $info = $this->Administradores_model->getUserById($_SESSION['id']);
    
    $data['id'] = $_SESSION['id'];
    $data['imagen'] = $info->imagen;
    $data['path_imagen'] = $info->path_imagen;
    $data['firma'] = $info->firma;

    $data['input_email'] = form_input('email', set_value('email', exist_obj($info, 'email')), 'class="form-control" id="email" readonly ');
    $data['input_nombre'] = form_input('nombre', set_value('nombre', exist_obj($info, 'nombre')), 'class="form-control" id="nombre" ');
    $data['input_telefono'] = form_input('telefono', set_value('telefono', exist_obj($info, 'telefono')), 'class="form-control" id="telefono" maxlenght="10" ');
    $data['input_cedula'] = form_input('cedula', set_value('cedula', exist_obj($info, 'cedula')), 'class="form-control" id="cedula" ');
    $data['input_nivel_estudios'] = form_input('nivel_estudios', set_value('nivel_estudios', exist_obj($info, 'nivel_estudios')), 'class="form-control" id="nivel_estudios" ');
    $data['input_escuela'] = form_input('escuela', set_value('escuela', exist_obj($info, 'escuela')), 'class="form-control" id="escuela" ');

    $this->blade->render('v_perfil', $data);
  }
  public function upload_imagen($id = '')
  {
    $result = $this->Administradores_model->upload_imagen('file');
    echo json_encode($result);
  }
  public function upload_delete_imagen()
  {
    $directorio = $this->input->post('path_imagen');
    if (file_exists($directorio)) {
      unlink($directorio);
      $result = array('isok' => true);
    } else {
      $result = array('isok' => true);
    }
    $this->db->where('path_imagen', $directorio)->set('imagen', '')->set('path_imagen', '')->update('codigos_productos');
    echo json_encode($result);
  }
}
