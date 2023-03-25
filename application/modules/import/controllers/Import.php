<?php
//https://junaidsshaikh.medium.com/import-excel-file-using-phpspreadsheet-library-in-codeigniter-3-using-ajax-261aa35b3068
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Import extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // Load Model
    $this->load->database();
    $this->load->model('Import_model');
    $this->ip_address    = $_SERVER['REMOTE_ADDR'];
    $this->datetime       = date("Y-m-d H:i:s");

    
    if (!isset($_SESSION['id']) || $_SESSION['perfil_id'] != 1) {
      redirect(base_url('login'));
    }
  }

  public function index()
  {
    $data['nombre_usuario'] = "IAN";
    $data['AP_usuario'] = "MARTINEZ";
    $data['AM_usuario'] = "VAZQUEZ";
    $this->blade->render("v_import",$data);
  }

  public function display()
  {
    $data   = [];
    $data["result"] = $this->Import_model->get_all();
    $this->blade->render("v_import");
  }

  public function import_data()
  {
    $path     = 'documents/dataset/';
    $json     = [];

    $this->upload_config($path);
    if (!$this->upload->do_upload('file')) {
      $json = [
        'error_message' => $this->upload->display_errors(),
      ];
    } else {
      $file_data   = $this->upload->data();
      $file_name   = $path . $file_data['file_name'];
      $arr_file   = explode('.', $file_name);
      $extension   = end($arr_file);
      if ('csv' == $extension) {
        $reader   = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
      } else {
        $reader   = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
      }
      $spreadsheet   = $reader->load($file_name);
      $sheet_data   = $spreadsheet->getActiveSheet()->toArray();
      echo '<pre>';print_r($sheet_data);exit;
      $list       = [];
      foreach ($sheet_data as $key => $val) {
        if ($key != 0) {
          $result   = $this->Import_model->get();
          if ($result) {
          } else {
            $list[] = [
              'codigo'          => $val[0],
              'producto'      => $val[1],
              'p_costo'        => str_replace('$', '', $val[2]),
              'p_venta'          => str_replace('$', '', $val[3]),
              'mayoreo'          => $val[4],
              'existencia'       => $val[5],
              'inv_minimo'          => $val[6],
              'inv_maximo'          => $val[7],
              'departamento'          => $val[8],
              'created_at'       => $this->datetime,
            ];
          }
        }
      }
      if (file_exists($file_name))
        unlink($file_name);
      if (count($list) > 0) {
        foreach ($list as $l => $producto) {

          $this->db->insert('productos', [
            'codigo_id'          => $this->Import_model->addOrUpdateCodigo($producto['codigo']),
            'producto'      => $producto['producto'],
            'p_costo'        => $producto['p_costo'],
            'p_venta'          => $producto['p_venta'],
            'mayoreo'          => $producto['mayoreo'],
            'existencia'       => $producto['existencia'],
            'inv_minimo'          => $producto['inv_minimo'],
            'inv_maximo'          => $producto['inv_maximo'],
            'categoria_id'          => $this->Import_model->addOrUpdateCategoria($producto['departamento']),
            'created_at'       => $producto['created_at'],
          ]);
        }
        $result = true;
        if ($result) {
          $json = [
            'exito' => true,
            'message'   => "Todos los productos se importaron con éxito",
          ];
        } else {
          $json = [
            'exito' => false,
            'message'   => "Error al importar, por favor intenta de nuevo"
          ];
        }
      } else {
        $json = [
          'exito' => false,
          'message' => "No hay registros para importar",
        ];
      }
    }
    echo json_encode($json);
  }

  public function upload_config($path)
  {
    if (!is_dir($path))
      mkdir($path, 0777, TRUE);
    $config['upload_path']     = './' . $path;
    $config['allowed_types']   = 'csv|CSV|xlsx|XLSX|xls|XLS';
    $config['max_filename']     = '255';
    $config['encrypt_name']   = TRUE;
    $config['max_size']     = 4096;
    $this->load->library('upload', $config);
  }
}
