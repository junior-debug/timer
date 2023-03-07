<?php
class database{
  private $db;
  private $id;
  private $nombre;

  public function __construct() {
    $this->db = new Conexion();
  }

  public function servicios($valor, $servicio){
    if ( $valor == 1) {
        //echo $valor. " SELECT * FROM servicios WHERE estatus=1 <br>";
        $sql = $this->db->query("SELECT * FROM servicios WHERE estatus=1");
        if($this->db->rows($sql) > 0 ){
          while($data = $this->db->recorrer($sql)){
            $respuesta[] = $data;
          }
        }
        else{
          $respuesta = false;
        }
        return $respuesta;

    }else{
       //echo $valor. " SELECT * FROM servicios WHERE servicios = '".$servicio."' AND estatus = 1 <br>";
        $sql = $this->db->query("SELECT * FROM servicios WHERE servicios = '".$servicio."' AND estatus=1");
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

  public function registroPosiciones ($posicion_, $mes_, $year_, $servicio_, $fecha_registro_, $quien_registro, $idPM){
      //echo "INSERT INTO posicion_mes (posicion_, mes_, year_, servicio_,fecha_registro_, quien_registro) VALUES ('$posicion_','$mes_','$year_','$servicio_','$fecha_registro_',$quien_registro) <br><br>";
      //echo '<br>'. "UPDATE posicion_mes SET estatus = 2  WHERE idPM = ".$idPM. " AND estatus=1 <br><br>";

      $sql_1 = $this->db->query("UPDATE posicion_mes SET estatus = 2  WHERE idPM = ".$idPM. " AND estatus=1");
      $sql = $this->db->query("INSERT INTO posicion_mes (posicion_, mes_, year_, servicio_,fecha_registro_, quien_registro) VALUES ('$posicion_','$mes_','$year_','$servicio_','$fecha_registro_',$quien_registro)");
      $respuesta = true;
  }

  public function list_posicion_mes($valor, $servicio){
    if ( $valor == 1) {
      $sql = $this->db->query("SELECT * FROM posicion_mes WHERE estatus = 1");
      if($this->db->rows($sql) > 0 ){
        while($data = $this->db->recorrer($sql)){
          $respuesta[] = $data;
        }
      }
      else{
        $respuesta = false;
      }
      return $respuesta;
    }else{
      $sql = $this->db->query("SELECT * FROM posicion_mes WHERE servicio_ = '".$servicio."' AND estatus=1");
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

  public function validarPosiciones($servicioP_, $mesP_, $anioP_){
    //echo "SELECT * FROM posicion_mes WHERE  servicio_ = '".$servicioP_."' AND mes_ = '".$mesP_."' AND year_  = '".$anioP_."' AND estatus=1".'<br>';

    $sql = $this->db->query("SELECT * FROM posicion_mes WHERE  servicio_ = '".$servicioP_."' AND mes_ = '".$mesP_."' AND year_  = '".$anioP_."' AND estatus=1");
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

  public function selectUltimoRegistr($servicioP_){
    //echo "SELECT * FROM posicion_mes WHERE servicio_ = '".$servicioP_."' AND estatus=1 ORDER BY idPM DESC";
    $sql = $this->db->query("SELECT * FROM posicion_mes WHERE servicio_ = '".$servicioP_."' AND estatus=1 ORDER BY idPM DESC");
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

  public function datosPosiciones($idPM){
    //echo "SELECT * FROM posicion_mes WHERE  servicio_ = '".$servicioP_."' AND mes_ = '".$mesP_."' AND year_  = '".$anioP_."' AND estatus=1".'<br>';

    $sql = $this->db->query("SELECT * FROM posicion_mes WHERE idPM = ".$idPM." AND estatus = 1");
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

  public function datosEditPosiciones ( $idPM, $cantidadPM ){
      /*echo "UPDATE posicion_mes SET posicion_=".$cantidadPM." WHERE idPM = ".$idPM. " AND estatus=1";*/

      $sql_1 = $this->db->query("UPDATE posicion_mes SET posicion_=".$cantidadPM." WHERE idPM = ".$idPM. " AND estatus=1");
      $respuesta = true;
  }
  public function borrarPosiciones ($idPM){
      /*echo "UPDATE posicion_mes SET estatus = 2 WHERE idPM = ".$idPM;*/
      
      $sql = $this->db->query("UPDATE posicion_mes SET estatus = 2 WHERE idPM = ".$idPM);
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