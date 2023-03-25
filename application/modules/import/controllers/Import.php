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
    $this->blade->render("v_import", $data);
  }

  public function display()
  {
    $data   = [];
    $data["result"] = $this->Import_model->get_all();
    $this->blade->render("v_import");
  }
  public function phpinfo(){
    echo phpinfo();
  }
  public function import_data()
  {
    $path     = 'documents/dataset/';
    $json     = [];

    $this->upload_config($path);
    if (!$this->upload->do_upload('file')) {
      echo $this->upload->display_errors();
      exit;
      $json = [
        'error_message' => $this->upload->display_errors(),
      ];
    } else {
      echo 'entre 2';
      exit;
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
      $list       = [];
      foreach ($sheet_data as $key => $val) {
        if ($key != 0) {
          $list[] = [
            'id' => $val[0],
            'name' => $val[1],
            'album' => $val[2],
            'album_id' => $val[3],
            'artists' => $val[4],
            'artist_ids' => $val[5],
            'track_number' => $val[6],
            'disc_number' => $val[7],
            'explicit' => $val[8],
            'danceability' => $val[9],
            'energy' => $val[10],
            'key' => $val[11],
            'loudness' => $val[12],
            'mode' => $val[13],
            'speechiness' => $val[14],
            'acousticness' => $val[15],
            'instrumentalness' => $val[16],
            'liveness' => $val[17],
            'valence' => $val[18],
            'tempo' => $val[19],
            'duration_ms' => $val[20],
            'time_signature' => $val[21],
            'year' => $val[22],
            'release_date' => $val[23],
          ];
        }
      }
      if (file_exists($file_name))
        unlink($file_name);
      if (count($list) > 0) {
        //Borrar la inforación anterior
        $this->db->where('1=1')->delete('music');
        foreach ($list as $l => $producto) {

          $this->db->insert('music', [

            'id' => $producto['id'],
            'name' => $producto['name'],
            'album' => $producto['album'],
            'album_id' => $producto['album_id'],
            'artists' => $producto['artists'],
            'artist_ids' => $producto['artist_ids'],
            'track_number' => $producto['track_number'],
            'disc_number' => $producto['disc_number'],
            'explicit' => $producto['explicit'],
            'danceability' => $producto['danceability'],
            'energy' => $producto['energy'],
            'key' => $producto['key'],
            'loudness' => $producto['loudness'],
            'mode' => $producto['mode'],
            'speechiness' => $producto['speechiness'],
            'acousticness' => $producto['acousticness'],
            'instrumentalness' => $producto['instrumentalness'],
            'liveness' => $producto['liveness'],
            'valence' => $producto['valence'],
            'tempo' => $producto['tempo'],
            'duration_ms' => $producto['duration_ms'],
            'time_signature' => $producto['time_signature'],
            'year' => $producto['year'],
            'release_date' => $producto['release_date'],
          ]);
        }
        $result = true;
        if ($result) {
          $json = [
            'exito' => true,
            'message'   => "Todos los datos se importaron con éxito",
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
    $config['max_size']     = 0;
    $this->load->library('upload', $config);
  }
  public function informacion(){
    $data['informacion'] = $this->Import_model->get_all();
    $this->blade->render("informacion",$data);
  }
}
