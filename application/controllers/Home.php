<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model('Mgeneral', '', TRUE);
        $this->load->model('productos/M_productos', 'mp', TRUE);
        $this->load->model('M_home', 'mh', TRUE);
        $this->load->helper(array('form', 'html', 'url'));
    }
    public function index()
    {
        $this->inicio();
    }
    public function inicio()
    {
        $this->session->set_userdata('menu', 'inicio');
        $this->blade->render('home/inicio', array(), FALSE);
    }
    public function productos()
    {
        $busqueda = '';
        if(isset($_GET['busqueda'])){
            $busqueda = trim($_GET['busqueda']);
        }
        $this->session->set_userdata('menu', 'productos');
        $data['categorias'] = $this->Mgeneral->get_table('categorias');
        $data['productos'] = $this->mp->buscar_productos($busqueda);
        $data['busqueda'] = $busqueda;
        $this->blade->render('home/productos', $data, FALSE);
    }
    public function ajax_buscar_productos()
    {
        echo $this->mp->buscar_productos();
    }
    public function nosotros()
    {
        $this->session->set_userdata('menu', 'nosotros');
        $this->blade->render('home/nosotros', array(), FALSE);
    }
    public function servicios()
    {
        $this->session->set_userdata('menu', 'servicios');
        $this->blade->render('home/servicios', array(), FALSE);
    }
    public function blog($id_categoria = 0)
    {
        $this->session->set_userdata('menu', 'blog');
        $data['categorias'] = $this->Mgeneral->get_table('categorias');
        $data['blogs'] = $this->mh->getBlogs($id_categoria);
        $this->blade->render('home/blog', $data, FALSE);
    }
    public function detalle_blog($id = '')
    {
        $this->session->set_userdata('menu', 'blog');
        $data['blog'] = $this->mh->getBlogs(0, $id);
        $data['titulo_blog'] = $this->Mgeneral->get_row('id', $id, 'blogs')->titulo;
        $this->blade->render('home/detalle_blog', $data, FALSE);
    }
    public function contacto()
    {
        $this->session->set_userdata('menu', 'contacto');
        $this->blade->render('home/contacto');
    }
    public function enviar_correo()
    {
        $this->load->library('email');
        $this->form_validation->set_rules('name', 'nombre', 'trim|required');
        $this->form_validation->set_rules('email', 'correo electrónico', 'trim|valid_email|required');
        $this->form_validation->set_rules('phone', 'teléfono', 'trim|numeric|exact_length[10]');
        $this->form_validation->set_rules('subject', 'asunto', 'trim|min_length[5]|required');
        $this->form_validation->set_rules('message', 'mensaje', 'trim|min_length[20]|required');
        if ($this->form_validation->run() == true) {
            $datos = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'subject' => $this->input->post('subject'),
                'message' => $this->input->post('message')
            );
            $this->db->insert('contacto_pagina', $datos);
            $datos['contacto'] = $_POST;
            $titulo = "Nuevo comentario";
            $cuerpo = $this->blade->render('home/v_correo', $datos, TRUE);
            enviar_correo("adela_333@hotmail.com", $titulo, $cuerpo, $_POST['email']);
            //adela_333@hotmail.com
            echo 1;
            exit();
        } else {
            $errors = array(
                'name' => form_error('name'),
                'email' => form_error('email'),
                'phone' => form_error('phone'),
                'subject' => form_error('subject'),
                'message' => form_error('message')
            );
            echo json_encode($errors);
        }
    }
    public function suscribir()
    {
        $this->form_validation->set_rules('email_suscribir', 'correo electrónico', 'trim|valid_email|required');
        if ($this->form_validation->run() == true) {
            $existe = $this->Mgeneral->get_row('email', $this->input->post('email_suscribir'), 'suscripciones');

            $datos = array(
                'email' => $this->input->post('email_suscribir'),
            );
            if (!$existe) {
                $datos['created_at'] = date('Y-m-d H:i:s');
                $this->db->insert('suscripciones', $datos);
            } else {
                $datos['updated_at'] = date('Y-m-d H:i:s');
                $this->db->where('email', $datos['email'])->update('suscripciones', $datos);
            }
            echo 1;
            exit();
        } else {
            $errors = array(
                'email_suscribir' => form_error('email_suscribir'),
            );
            echo json_encode($errors);
        }
    }
    public function prueba_correo()
    {
        $datos = array(
            'name' => 'name',
            'email' => 'albertopitava@gmail.com',
            'phone' => 'phone',
            'subject' => 'subject',
            'message' => 'message'
        );
        $datos['contacto'] = $datos;
        $titulo = "Nuevo comentario";
        $cuerpo = $this->blade->render('home/v_correo', $datos, TRUE);
        print_r($cuerpo);
        die();
        enviar_correo("albertopitava@gmail.com", $titulo, $cuerpo, $_POST['email']);
    }
}
