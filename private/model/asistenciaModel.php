<?php
class database{
  
  private $db;
  private $id;
  private $nombre;

  public function __construct() {
    $this->db = new Conexion();
  }

  public function listUser(){
    //$sql = $this->db->query("SELECT users.id_user,users.nombre,users.apellido,users.genero,users.user,users.type_user,users.status,departamentos.descripcion FROM users inner JOIN departamentos on users.id_departamento = departamentos.id_departamento WHERE type_user != 1");

    $sql = $this->db->query("SELECT * FROM datos_empleados WHERE estatus=1");
    if($this->db->rows($sql) > 0 ){
      while($data = $this->db->recorrer($sql)){
        $respuesta[] = $data;
      }
    }
    else{
      $respuesta = false;
    }
    return $respuesta;
  }

}

?>