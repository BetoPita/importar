<?php
Class Administrador extends CI_Model
{
 function login($email, $password)
 {
   $this -> db -> select('id, email, nombre, perfil_id,activo');
   $this -> db -> from('administradores');
   $this -> db -> where('email', $email);
   $this -> db -> where('password', MD5($password));
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
}
