<?php
class database{
  
  private $db;
  private $id;
  private $nombre;

  public function __construct() {
    $this->db = new Conexion();
  }

  public function categoria1(){
    $sql = $this->db->query("SELECT * FROM categoria1 ORDER BY descripcion AND estatus = 1");
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

  public function categoria2($id_categoria1){
    $sql = $this->db->query("SELECT * FROM categoria2 WHERE id_categoria1 = $id_categoria1 AND estatus = 1");
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

  public function categoria3($id_categoria2){
    $sql = $this->db->query("SELECT * FROM categoria3 WHERE id_categoria2 = $id_categoria2 ");
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

  public function contactoNoEfectivo(){
    $sql = $this->db->query("SELECT * FROM noefectivo");
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

  public function bancos(){
    $sql = $this->db->query("SELECT * FROM bancos ORDER BY descripcion");
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

  public function registro($origenContacto,$tipoContacto,$tipoEfectivo,$tipoAtencion,$categoria1,$categoria2,$categoria3,$nombre,$apellido,$cedula,$telf_hab,$telf_cel,$correo,$tipoSuscriptor,$referenciaPago,$id_banco,$tipoMoneda,$fechaPago,$montoPago,$serialDeco,$serialSC,$id_usuario,$tipo,$idCliente){
    
    $fecha  = date('Y-m-d');
    $hora   = date('H:i');
    
    if($idCliente == 0){
      //QUERY CLIENTE
      $sql = $this->db->query("INSERT INTO clientes (nombre,apellido,cedula,telf_hab,telf_cel,correo,fecha_registro) VALUES ('$nombre','$apellido','$cedula','$telf_hab','$telf_cel','$correo','$fecha')");

      //QUERY GESTION
      $sql = $this->db->query("INSERT INTO gestion (origenContacto,tipoContacto,tipoEfectivo,tipoAtencion,categoria1,categoria2,categoria3,fecha,hora,id_cliente,id_usuario) VALUES ('$origenContacto','$tipoContacto','$tipoEfectivo','$tipoAtencion',$categoria1,$categoria2,$categoria3,'$fecha','$hora',LAST_INSERT_ID(),$id_usuario)");
    }else{
      //QUERY GESTION
      $sql = $this->db->query("INSERT INTO gestion (origenContacto,tipoContacto,tipoEfectivo,tipoAtencion,categoria1,categoria2,categoria3,fecha,hora,id_cliente,id_usuario) VALUES ('$origenContacto','$tipoContacto','$tipoEfectivo','$tipoAtencion',$categoria1,$categoria2,$categoria3,'$fecha','$hora',$idCliente,$id_usuario)");echo ("INSERT INTO gestion (origenContacto,tipoContacto,tipoEfectivo,tipoAtencion,categoria1,categoria2,categoria3,fecha,hora,id_cliente,id_usuario) VALUES ('$origenContacto','$tipoContacto','$tipoEfectivo','$tipoAtencion',$categoria1,$categoria2,$categoria3,'$fecha','$hora',$idCliente,$id_usuario)");
    }
    if($tipo == 2){
      $sql = $this->db->query("INSERT INTO datospago (tiposuscriptor,referenciapago,id_banco,tipomoneda,fechapago,montopago,id_gestion,id_estatus) VALUES ('$tipoSuscriptor','$referenciaPago','$id_banco','$tipoMoneda','$fechaPago',$montoPago,LAST_INSERT_ID(),1)");

    }
    if($tipo == 3){
      $sql = $this->db->query("INSERT INTO datostecnicos (serialdeco,serialsc,id_gestion) VALUES ($serialDeco,$serialSC,LAST_INSERT_ID())");
    }
  }

  public function buscarCliente($identificacion){
    $sql = $this->db->query("SELECT * FROM clientes WHERE cedula = $identificacion");
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

  public function casoCliente($id_cliente){
    $sql = $this->db->query("SELECT a.id_gestion,a.fecha,c.descripcion AS categoria2,b.tiposuscriptor,b.referenciapago,d.descripcion AS banco,b.tipomoneda,b.fechapago,b.montopago FROM gestion a INNER JOIN datospago b ON a.id_gestion = b.id_gestion INNER JOIN categoria2 c ON a.categoria2 = c.id_categoria2 INNER JOIN bancos d ON b.id_banco = d.id_banco WHERE a.id_cliente = $id_cliente");
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
 
  //_______________________FormularioSimpleTV______________
  public function estados_(){
    $sql = $this->db->query("SELECT * FROM estado ORDER BY estado");
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
  public function ciudad_($id_estado){
    $sql = $this->db->query("SELECT * FROM ciudad WHERE id_estado = $id_estado ORDER BY ciudad");
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
  public function municipio_($id_ciudad){
    $sql = $this->db->query("SELECT * FROM municipio WHERE id_ciudad = $id_ciudad ORDER BY municipio");
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
 

  public function guardarFormSimpleTV($nombre_, $apellido_, $sexo_, $fecha_nacim_, $type_doc_, $num_doc_, $tlf_fijo, $celular, $redsocial1_, $redsocial2_, $email_, $clave_, $estado_, $ciudad_, $municipio_, $sector_, $direccion1_, $direccion2_, $codigo_postal_){
    //echo "INSERT INTO informa_personal (nombre, apellido, genero, fecha_nacimiento, tipo_doc, num_doc, tlf_fijo, celular, instagram, twitter, email, clave, id_estado, id_ciudad, id_municipio, id_sector, direccion1, direccion2, codigo_postal) VALUES ('$nombre_', '$apellido_', '$sexo_', '$fecha_nacim_', '$type_doc_', $num_doc_, $tlf_fijo, $celular, '$redsocial1_', '$redsocial2_', '$email_', '$clave_', $estado_, $ciudad_, $municipio_, $sector_, '$direccion1_', '$direccion2_', $codigo_postal_)";

    $sql = $this->db->query("INSERT INTO informa_personal (nombre, apellido, genero, fecha_nacimiento, tipo_doc, num_doc, tlf_fijo, celular, instagram, twitter, email, clave, id_estado, id_ciudad, id_municipio, id_sector, direccion1, direccion2, codigo_postal) VALUES ('$nombre_', '$apellido_', '$sexo_', '$fecha_nacim_', '$type_doc_', $num_doc_, $tlf_fijo, $celular, '$redsocial1_', '$redsocial2_', '$email_', '$clave_', $estado_, $ciudad_, $municipio_, $sector_, '$direccion1_', '$direccion2_', $codigo_postal_)");
  }

}
?>