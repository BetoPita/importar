<?php
class Mgeneral extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
  public function save_register($table, $data)
  {
    $this->db->insert($table, $data);
    return $this->db->insert_id();
  }

  public function delete_row($tabla, $id_tabla, $id)
  {
    $this->db->delete($tabla, array($id_tabla => $id));
  }

  public function get_table($table, $order = '')
  {
    if ($order != '') {
      $this->db->order_by($order, 'asc');
    }
    $data = $this->db->get($table)->result();
    return $data;
  }

  public function get_row($campo, $value, $tabla)
  {
    return $this->db->where($campo, $value)->get($tabla)->row();
  }
  public function get_all($tabla, $orderBy = '',$order='asc')
  {
    if($orderBy){
      $this->db->order_by($orderBy,$order);
    }
    return $this->db->get($tabla)->result();
  }
  public function get_result($campo, $value, $tabla)
  {
    return $this->db->where($campo, $value)->get($tabla)->result();
  }
  public function get_result_condition($where, $tabla)
  {
    return $this->db->where($where)->get($tabla)->result();
  }

  public function update_table_row($tabla, $data, $id_table, $id)
  {
    $this->db->update($tabla, $data, array($id_table => $id));
  }
}
