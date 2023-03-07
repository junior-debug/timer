<?php
class database{
  private $db;
  private $id;
  private $nombre;

  public function __construct() {
    $this->db = new Conexion();
  }

  public function casos($estatus){
    $sql = $this->db->query("SELECT a.id_gestion,a.fecha,c.descripcion AS categoria2,b.tiposuscriptor,b.referenciapago,d.descripcion AS banco,b.tipomoneda,b.fechapago,b.montopago, e.nombre, e.apellido, f.descripcion AS estatus FROM gestion a INNER JOIN datospago b ON a.id_gestion = b.id_gestion INNER JOIN categoria2 c ON a.categoria2 = c.id_categoria2 INNER JOIN bancos d ON b.id_banco = d.id_banco INNER JOIN clientes e ON a.id_cliente = e.id_cliente INNER JOIN estatus f ON b.id_estatus = f.id_estatus WHERE b.id_estatus = $estatus");
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

  public function cliente($id){
    $sql = $this->db->query("SELECT a.origenContacto,a.tipocontacto,b.nombre,b.apellido,b.cedula,b.telf_hab,b.telf_cel,b.correo, c.tiposuscriptor,c.referenciapago,c.tipomoneda,c.montopago, d.descripcion AS nombrebanco FROM gestion a INNER JOIN clientes b ON a.id_cliente = b.id_cliente INNER JOIN datospago c ON a.id_gestion = c.id_gestion INNER JOIN bancos d ON c.id_banco = d.id_banco WHERE a.id_gestion = $id");
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

  public function actualizacionCaso($estatus,$observaciones,$idGestion,$fecha,$idUsuario){
    $sql = $this->db->query("INSERT INTO seguimiento (id_gestion,fecha,id_estatus,observacion,id_usuario) VALUES ($idGestion,'$fecha',$estatus,'$observaciones',$idUsuario)"); 
    if($estatus == 3){
      $sql = $this->db->query("UPDATE datospago SET id_estatus = 3 WHERE id_gestion = $idGestion");
    }
    $respuesta = true;
    return $respuesta;
  }

  public function comentario($id){
    $sql = $this->db->query("SELECT a.fecha,a.observacion,b.user,c.descripcion FROM seguimiento a INNER JOIN users b ON a.id_usuario = b.id_user INNER JOIN estatus c ON a.id_estatus = c.id_estatus WHERE a.id_gestion = $id");
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

  public function descargaPendientes(){
    $sql = $this->db->query("SELECT a.id_gestion,a.fecha,a.origenContacto,a.tipocontacto,c.descripcion AS categoria2,b.tiposuscriptor,b.referenciapago,d.descripcion AS banco,b.tipomoneda,b.fechapago,b.montopago, e.nombre, e.apellido, e.cedula, e.telf_hab, e.telf_cel, e.correo, f.descripcion AS estatus FROM gestion a INNER JOIN datospago b ON a.id_gestion = b.id_gestion INNER JOIN categoria2 c ON a.categoria2 = c.id_categoria2 INNER JOIN bancos d ON b.id_banco = d.id_banco INNER JOIN clientes e ON a.id_cliente = e.id_cliente INNER JOIN estatus f ON b.id_estatus = f.id_estatus WHERE b.id_estatus = 1");
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