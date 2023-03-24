<?php
class M_home extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getBlogs($id_categoria = 0, $id_blog = 0)
  {
    if ($id_categoria != 0) {
      $this->db->where('c.id', $id_categoria);
    }
    if ($id_blog != 0) {
      $this->db->where('b.id', $id_blog);
    }
    return $this->db->select('a.nombre,b.*,c.categoria')
      ->join('categorias c', 'c.id = b.id_categoria')
      ->join('administradores a', 'a.id = b.id_usuario')
      ->get('blogs b')
      ->result();
  }
}
