<?php 
class database{
  
  private $db;
  private $id;
  private $nombre;

  public function __construct() {
    $this->db = new Conexion();
  }

  	public function Encrypt($string){
		$long = strlen($string); // recorrer cada posicion del string  
	    $str="";
	    for($i=0;$i< $long;$i++){
	      $str.= ($i % 2) != 0 ? md5($string[$i]) : $i; // devolvera 0 u otro numero 
	    }
	    return md5($str);
	}

		public function idServicios($servicio){ 
			//echo "SELECT * FROM servicios WHERE estatus=1 AND servicios = '$servicio' ";

				$sql = $this->db->query("SELECT * FROM servicios WHERE estatus=1 AND servicios = '$servicio' ");
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
 	public function sessionLogin($u){ 
 		//echo "SELECT * FROM datos_empleados WHERE (datos_empleados.estatus=1 OR datos_empleados.estatus=4) AND users = '$u'";
	    $sql = $this->db->query("SELECT * FROM datos_empleados WHERE (datos_empleados.estatus=1 OR datos_empleados.estatus=4) AND users = '$u'");
	    if ($this->db->rows($sql) > 0) {
	      while($data = $this->db->recorrer($sql)){
	        $respuesta[] = $data;  
	      }
	    }
	    else{
	      $respuesta = false;
	    }
	    return  $respuesta;
  	}

  	public function sessionNew($u,$p_md5){ 
  		//echo "SELECT * FROM datos_empleados WHERE (datos_empleados.estatus=1 OR datos_empleados.estatus=4) AND users = '$u' AND passwords = '$p_md5'";
	    $sql = $this->db->query("SELECT * FROM datos_empleados LEFT JOIN servicios ON servicios.servicios = datos_empleados.servicio  WHERE (datos_empleados.estatus=1 OR datos_empleados.estatus=4) AND users = '$u' AND passwords = '$p_md5'");
	    if ($this->db->rows($sql) > 0) {
	      while($data = $this->db->recorrer($sql)){
	        $respuesta[] = $data;  
	      }
	    }
	    else{
	      $respuesta = false;
	    } 
	    return  $respuesta;
  	}

  	
  	public function updateEstatusSesion($idEmpleado){
	    //echo "UPDATE datos_empleados SET estatusSesion = 2  WHERE id_datos_empleados = ".$idUsuario.' ';/**/
	    $sqlDia = $this->db->query("UPDATE datos_empleados SET estatusSesion = 1  WHERE id_datos_empleados = ".$idEmpleado);
	    $respuesta = true;
	    return $respuesta;
	}

	public function updateEstatusSesionDos($idEmpleado){  
	    //echo "UPDATE datos_empleados SET estatusSesion = 2  WHERE id_datos_empleados = ".$idEmpleado; 	/**/
	    $sqlDia = $this->db->query("UPDATE datos_empleados SET estatusSesion = 2  WHERE id_datos_empleados = ".$idEmpleado);
	    $respuesta = true;
	    return $respuesta;
	}
  	
  	public function registroTimerHistori($idUsuario, $fecha, $hora, $valor){
  		
  		if ($valor == 1) {
  			$sqlDia = $this->db->query("INSERT INTO historicoSesion (horaInicio, idUsuario, fechaHistori) VALUES ('$hora', $idUsuario, '$fecha')");
  			
  			$respuesta = true;
    		return $respuesta;

  		}else{
  			$sqlDia = $this->db->query("INSERT INTO historicoSesion (horaInicio, idUsuario, fechaHistori) VALUES ('$hora', $idUsuario, '$fecha')");
		    $sqlDia_ = $this->db->query("INSERT INTO registro (id_usuario, dia, hora_inicio) VALUES ($idUsuario, '$fecha','$hora')");
		    
		    $respuesta = true;
	    	return $respuesta;
  		}
	} 

	 public function consultarRegistro($idUsuario, $fecha){
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

 	public function consultarHistorico($idUsuario, $fecha){

 		//echo "SELECT * FROM historicoSesion  WHERE idUsuario = ".$idUsuario." AND fechaHistori = '".$fecha."' AND estatus = 1 ORDER BY idHistSesion DESC";

	    $sql = $this->db->query("SELECT * FROM historicoSesion  WHERE idUsuario = ".$idUsuario." AND fechaHistori = '".$fecha."' AND estatus = 1 ORDER BY idHistSesion DESC");
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
 	public function updateEstatusSesionHistoriActiva($idHistori, $horaIni, $idUsuario){  
	    //echo "UPDATE historicoSesion SET horaFin = '".$horaIni."', estatus = 2  WHERE idHistSesion = ".$idHistori." AND estatus = 1 AND idUsuario = ".$idUsuario ;/**/
	    $sqlDia = $this->db->query("UPDATE historicoSesion SET horaFin = '".$horaIni."', estatus = 2  WHERE idHistSesion = ".$idHistori." AND estatus = 1 AND idUsuario = ".$idUsuario);
	    $respuesta = true;
	    return $respuesta; 
	}

	public function consultarUserClave($idUsuario){

 		//echo "SELECT * FROM historicoSesion  WHERE idUsuario = ".$idUsuario." AND fechaHistori = '".$fecha."' AND estatus = 1 ORDER BY idHistSesion DESC";

	    $sql = $this->db->query("SELECT estatusClave as estatusClave FROM datos_empleados  WHERE datos_empleados.estatus = 1 AND datos_empleados.id_datos_empleados = ".$idUsuario);
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
	public function updateTimerHistoriFIN($idRegisHis, $hora){
	    //echo "UPDATE historicoSesion SET horaFin = '".$hora."' , estatus = 2 WHERE idHistSesion = ".$idRegisHis;
	    $sqlDia = $this->db->query("UPDATE historicoSesion SET horaFin = '".$hora."' , estatus = 2 WHERE idHistSesion = ".$idRegisHis);
	    $respuesta = true;
	    return $respuesta;
	}
 }