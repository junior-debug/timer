<?php
class database{
  
  private $db;
  private $id;
  private $nombre;

  public function __construct() {
    $this->db = new Conexion();
  }

  public function consultarRegistro($idUsuario, $fecha){
    //echo "SELECT * FROM registro WHERE id_usuario = ".$idUsuario." AND dia = '".$fecha."'".'<br><br>';

    //echo "SELECT * FROM registro INNER JOIN datos_empleados ON datos_empleados.id_datos_empleados = registro.id_usuario WHERE id_usuario = ".$idUsuario." AND dia = '".$fecha."'".'<br>';

    $sql = $this->db->query("SELECT * FROM registro INNER JOIN datos_empleados ON datos_empleados.id_datos_empleados = registro.id_usuario WHERE id_usuario = ".$idUsuario." AND dia = '".$fecha."'");
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

  public function updateCronometro($time, $time_Bre, $time_Entr, $time_FBack, $time_Bano, $time_LLSa, $idUsuario, $fecha, $hora){
   // echo "UPDATE registro SET tiempo_ready = '".$time."' , break = '".$time_Bre."', bath = '".$time_Bano."', entrenamiento = '".$time_Entr."', feek_back = '".$time_FBack."', llamada_saliente = '".$time_LLSa."' WHERE id_usuario = ".$idUsuario." AND dia = '".$fecha."'".'<br><br>';/**/

    $sqlDia = $this->db->query("UPDATE registro SET tiempo_ready = '".$time."' , break = '".$time_Bre."', bath = '".$time_Bano."', entrenamiento = '".$time_Entr."', feek_back = '".$time_FBack."', llamada_saliente = '".$time_LLSa."', hora_fin = '".$hora."' WHERE id_usuario = ".$idUsuario." AND dia = '".$fecha."'");
    $respuesta = true;
    return $respuesta;
  }

  public function registroCronometro($idUsuario, $fecha, $hora){
    //echo "INSERT INTO registro (id_usuario, dia, hora_inicio) VALUES ($idUsuario, '$fecha','$hora')".'<br><br>';/**/
    $sqlSesion = $this->db->query("UPDATE datos_empleados SET estatusSesion = 1  WHERE id_datos_empleados = ".$idUsuario); 
    /*estatusSesion = 0 POR DEFECTO ESTA EN CERO
      estatusSesion = 1 estatus de inicio de sesion
      estatusSesion = 2 INDICATIVO PARA CIERRE DE SESION*/
    $sqlDia = $this->db->query("INSERT INTO registro (id_usuario, dia, hora_inicio) VALUES ($idUsuario, '$fecha','$hora')");
    $sql = $this->db->query("SELECT MAX(id_registro) AS idUltimo FROM registro");
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

  public function consultarRegistroHistoric($idUsuario, $fecha){
    $sql = $this->db->query("SELECT * FROM historicoSesion WHERE idUsuario = ".$idUsuario." AND fechaHistori = '".$fecha."' ORDER BY idHistSesion DESC");
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



  public function registroTimerHistori($idUsuario, $fecha, $hora){
    //echo "INSERT INTO historicoSesion (horaInicio, idUsuario, fecha) VALUES ('$hora', $idUsuario, '$fecha')";
    //echo '<br><br>';
    //echo "SELECT MAX(idHistSesion) AS idUltimoHisto FROM historicoSesion";
    //echo '<br><br>';

    $sqlDia = $this->db->query("INSERT INTO historicoSesion (horaInicio, idUsuario, fechaHistori) VALUES ('$hora', $idUsuario, '$fecha')");
    
    $sqlHist = $this->db->query("SELECT MAX(idHistSesion) AS idUltimoHisto FROM historicoSesion");
    if($this->db->rows($sqlHist) > 0 ){
      while($data = $this->db->recorrer($sqlHist)){
        $respuesta[] = $data;
      }
    }
    else{
      $respuesta = false;
    }
    return $respuesta;
  }

  public function updateTimerHistori($idRegisHis, $hora){
    //echo "UPDATE historicoSesion SET horaFin = '".$hora."' WHERE idHistSesion = ".$idRegisHis;
    $sqlDia = $this->db->query("UPDATE historicoSesion SET horaFin = '".$hora."' WHERE idHistSesion = ".$idRegisHis);
    $respuesta = true;
    return $respuesta;
  }

  public function updateTimerHistoriFIN($idRegisHis, $hora){
    //echo "UPDATE historicoSesion SET horaFin = '".$hora."' , estatus = 2 WHERE idHistSesion = ".$idRegisHis;
    $sqlDia = $this->db->query("UPDATE historicoSesion SET horaFin = '".$hora."' , estatus = 2 WHERE idHistSesion = ".$idRegisHis);
    $respuesta = true;
    return $respuesta;
  }

  public function updateCronometroFin($time, $time_Bre, $time_Entr, $time_FBack, $time_Bano, $time_LLSa, $idUsuario, $fecha, $hora){
   //echo "UPDATE registro SET tiempo_ready = '".$time."' , break = '".$time_Bre."', bath = '".$time_Bano."', entrenamiento = '".$time_Entr."', feek_back = '".$time_FBack."', llamada_saliente = '".$time_LLSa."' WHERE id_usuario = ".$idUsuario." AND dia = '".$fecha."'".'<br><br>';/**/

    $sqlDia = $this->db->query("UPDATE registro SET tiempo_ready = '".$time."' , break = '".$time_Bre."', bath = '".$time_Bano."', entrenamiento = '".$time_Entr."', feek_back = '".$time_FBack."', llamada_saliente = '".$time_LLSa."', hora_fin = '".$hora."', estatusBR = 0, estatusBA = 0, estatusEN = 0, estatusFB = 0, estatusLL = 0 WHERE id_usuario = ".$idUsuario." AND dia = '".$fecha."'");

    $sqlDia = $this->db->query("UPDATE datos_empleados SET estatusSesion = 2  WHERE id_datos_empleados = ".$idUsuario);
    $respuesta = true;
    return $respuesta;
  }

  public function consultarSerCamp($servicio){
    //echo "SELECT campanas.id_campana, campanas.abrev_campana FROM servicios INNER JOIN campanas ON campanas.id_servicio = servicios.idServicio WHERE servicios.servicios = '".$servicio."'".'<br>';

    $sql = $this->db->query("SELECT campanas.id_campana, campanas.abrev_campana FROM servicios INNER JOIN campanas ON campanas.id_servicio = servicios.idServicio WHERE servicios.servicios = '".$servicio."'");
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

  public function registroPorCambioCampa($campana, $hora_inicio, $hora_final,$duracion, $id_usuario, $id_registro){
    /*echo "INSERT INTO registro_cambio_camapana (campana, horaInicio, horaFinal, duracion, id_usuario, id_registro) VALUES ('$campana', '$hora_inicio', '$hora_final','$duracion', $id_usuario, $id_registro)".'<br><br>';*/
    
    $sqlDia = $this->db->query("INSERT INTO registro_cambio_camapana (campana, horaInicio, horaFinal, duracion, id_usuario, id_registro) VALUES ('$campana', '$hora_inicio', '$hora_final','$duracion', $id_usuario, $id_registro)");
    $respuesta = true;
    return $respuesta;/**/
  }


  //___________________
  public function Update_statusAuxiliaress($sqlUpdate){
    //echo $sqlUpdate;
    $sqlDia = $this->db->query($sqlUpdate);
    $respuesta = true;
    return $respuesta;/**/
  }

  /*public function Update_statusPause($idUsuario, $fecha){
    $sqlDia = $this->db->query("UPDATE registro SET estatusBR = 2 WHERE registro.id_usuario = ".$idUsuario." AND registro.dia = '".$fecha."'");
    $respuesta = true;
    return $respuesta;
  }estatusBA
estatusEN
estatusFB
estatusLL
  //___________________*/





}
?>