<?php
class database{
  private $db;
  private $id;
  private $nombre;

  public function __construct() {
    $this->db = new Conexion();
  }


  public function histo_servicios(){
    $sql = $this->db->query("SELECT * FROM servicios WHERE estatus=2 ORDER BY idServicio DESC");
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

  public function histo_servicios_camapanas(){
    $sql = $this->db->query("SELECT * FROM servicios INNER JOIN campanas ON campanas.id_servicio = servicios.idServicio WHERE campanas.estatus = 2 ORDER BY campanas.id_campana DESC");
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


  public function servicios(){
    $sql = $this->db->query("SELECT * FROM servicios WHERE estatus=1 ORDER BY idServicio DESC");
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

  public function servicios_camapanas(){
    $sql = $this->db->query("SELECT * FROM servicios INNER JOIN campanas ON campanas.id_servicio = servicios.idServicio WHERE servicios.estatus = 1 AND campanas.estatus = 1 ORDER BY campanas.id_campana DESC");
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

  public function validarSerivice($nameServicio){
    //echo "SELECT * FROM servicios WHERE servicios='".$nameServicio."'";
    $sql = $this->db->query("SELECT * FROM servicios WHERE servicios='".$nameServicio."'");
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

  public function guardar_servicios ($nameServicio){
    //echo "INSERT INTO servicios (servicios) VALUES ('".$nameServicio."')";
    $sql = $this->db->query("INSERT INTO servicios (servicios) VALUES ('".$nameServicio."')");
    $respuesta = true;
  }

  //$sql = $this->db->query("SELECT * FROM campanas WHERE name_campana='".$campanass."' AND id_servicio =".$id_servicioo);

  public function validarcampana($id_servicioo, $campanass, $abrev){
    //echo "SELECT * FROM campanas WHERE (name_campana='".$campanass."' OR abrev_campana = '".$abrev."') AND id_servicio =".$id_servicioo. "<br><br>";


    $sql = $this->db->query("SELECT * FROM campanas WHERE (name_campana='".$campanass."' OR abrev_campana = '".$abrev."')");
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

  public function guardar_campanass ($campanass, $abreviCampana, $id_servicioo){
    //echo "INSERT INTO campanas (name_campana, abrev_campana, id_servicio) VALUES ('".$campanass."', '".$abreviCampana."', ".$id_servicioo.")";
    $sql = $this->db->query("INSERT INTO campanas (name_campana, abrev_campana, id_servicio) VALUES ('".$campanass."', '".$abreviCampana."', ".$id_servicioo.")" );
    $respuesta = true;
  }

  public function DatosCampana($idcampanaEdit){
    $sql = $this->db->query("SELECT * FROM servicios INNER JOIN campanas ON campanas.id_servicio = servicios.idServicio WHERE servicios.estatus = 1 AND campanas.id_campana =".$idcampanaEdit);
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

  public function GuardarDatosCampana ($idcampanna, $campanass, $abreviCampana){
    //echo "UPDATE campanas SET name_campana ='".$campanass."', abrev_campana ='".$abreviCampana."' WHERE id_campana = ".$idcampanna;
    
    $sql = $this->db->query("UPDATE campanas SET name_campana ='".$campanass."', abrev_campana ='".$abreviCampana."' WHERE id_campana = ".$idcampanna);
    $respuesta = true;
  }

  public function DatosServicio($idservicioEdit){
    $sql = $this->db->query("SELECT * FROM servicios WHERE servicios.estatus = 1 AND servicios.idServicio=".$idservicioEdit);
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

  public function GuardarDatosServicio ($idservicioo, $servicioo){
   // echo "UPDATE servicios SET servicios ='".$servicioo."' WHERE idServicio = ".$idservicioo;
    $sql = $this->db->query("UPDATE servicios SET servicios ='".$servicioo."' WHERE idServicio = ".$idservicioo);
    $respuesta = true;
  }

  public function DeleteServicio ($idservicioo){
   // echo "UPDATE servicios SET servicios ='".$servicioo."' WHERE idServicio = ".$idservicioo;
    $sql = $this->db->query("UPDATE servicios SET estatus = 2 WHERE idServicio = ".$idservicioo);
    $sql = $this->db->query("UPDATE campanas SET estatus = 2 WHERE id_servicio = ".$idservicioo);
    $respuesta = true;
  }

  public function DeleteCampana ($idcampana){
    echo "UPDATE campanas SET estatus = 2 WHERE id_campana = ".$idcampana;
    $sql = $this->db->query("UPDATE campanas SET estatus = 2 WHERE id_campana = ".$idcampana);
    $respuesta = true;
  }

   public function ActivarServicio ($idservicioo){
   // echo "UPDATE servicios SET servicios ='".$servicioo."' WHERE idServicio = ".$idservicioo;
    $sql = $this->db->query("UPDATE servicios SET estatus = 1 WHERE idServicio = ".$idservicioo);
    $respuesta = true;
  }
  public function ActivarCampana ($idcampana){
    //echo "UPDATE campanas SET estatus = 2 WHERE id_campana = ".$idcampana;
    $sql = $this->db->query("UPDATE campanas SET estatus = 1 WHERE id_campana = ".$idcampana);
    $respuesta = true;
  }



/*

CREATE TABLE posicion_mes (
  idPM int PRIMARY KEY AUTO_INCREMENT,
  posicion_ VARCHAR (20) NOT NULL,
  mes_ VARCHAR (20) NOT NULL,
  year_ VARCHAR (20) NOT NULL,
  servicio_ VARCHAR (20) NOT NULL,
  campana_ VARCHAR (20) NOT NULL,
  fecha_registro_ VARCHAR (11) NOT NULL,
  quien_registro  int  NOT NULL,
  estatus int DEFAULT 1

  */




}
?>