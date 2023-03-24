<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administradores_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->table = 'administradores';
	}
	public function getUserById($user_id = '')
	{
		return $this->db->select('id,email,nombre,imagen,path_imagen,cedula,nivel_estudios,escuela,telefono,firma')->where('id', $user_id)->get($this->table)->row();
	}
	public function upload_imagen($myfile = '')
	{
		$result = array();
		if (isset($_FILES[$myfile])) {
			ini_set('max_file_uploads', '600');
			ini_set('post_max_size', '50M');
			ini_set('upload_max_filesize', '50M');
			$config['upload_path'] = './assets_admin/images/logos_dres/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '21200';
			$config['encrypt_name']  = true;
			$this->load->library('Upload2', $config);
			if (!$this->upload2->do_upload('file')) {
				$result[0] = array('isok' => false, 'client_name' => '', 'error' => $this->upload2->display_errors());
			} else {
				$ret = array();
				$contadorFILES = 0;
				$dataTMPARR = $this->upload2->data();
				foreach ($dataTMPARR as $indice => $dataTMP) {


					$result[$contadorFILES]['isok'] = $dataTMP['isok'];
					if ($dataTMP['isok']) {
						$result[$contadorFILES]['client_name'] = $dataTMP['client_name'];
						$result[$contadorFILES]['file_name'] = $dataTMP['file_name'];
						$result[$contadorFILES]['path'] = $dataTMP['full_path'];
					} else {

						$result[$contadorFILES]['client_name'] = $dataTMP['file_name'];
						$result[$contadorFILES]['error'] = $this->upload2->display_errors($indice);
					}
					$contadorFILES++;
				}
			}
		}
		return $result;
	}
	public function actualizarGeneralesDr()
	{
		$datos = array(
			'imagen' => $this->input->post('imagen'),
			'path_imagen' => $this->input->post('path_imagen'),
			'imagen' => $this->input->post('imagen'),
			'nombre' => $this->input->post('nombre'),
			'telefono' => $this->input->post('telefono'),
			'cedula' => $this->input->post('cedula'),
			'nivel_estudios' => $this->input->post('nivel_estudios'),
			'escuela' => $this->input->post('escuela'),
			'firma' => ($this->input->post('firma') != '') ? $this->input->post('firma') : null,
		);

		$exito = $this->db->where('id', $_SESSION['id'])->update('administradores', $datos);
		if ($exito) {
			echo 1;
		} else {
			echo 0;
		}
		exit();
	}
}
