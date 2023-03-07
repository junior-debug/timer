<?php
class database{
  private $db;
  private $id;
  private $nombre;

  public function __construct() {
    $this->db = new Conexion();
  }

  public function cantidadPosicionMES($servicioP_, $mesP_, $anioP_, $rol_cargo){ //echo $servicioP_.'<br>';   
      if ( $rol_cargo  == 'ADMIN') {
        //echo ' cantidadPosicionMES *** ADMIN ==> '."SELECT * FROM posicion_mes WHERE  ".$servicioP_." mes_ = '".$mesP_."' AND year_  = '".$anioP_."' AND estatus=1 AND servicio_ != ''".'<br><br>';

        if ( $servicioP_ != 0 OR $servicioP_ != '0') {
          $sql = $this->db->query("SELECT * FROM posicion_mes WHERE  servicio_ = '".$servicioP_."' AND mes_ = '".$mesP_."' AND year_  = '".$anioP_."' AND estatus=1 AND servicio_ != '' ");
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

      }else if ( $rol_cargo  == 'SUP') {
        //echo ' cantidadPosicionMES *** SUPvirSOR ==> '."SELECT * FROM posicion_mes WHERE  ".$servicioP_." AND mes_ = '".$mesP_."' AND year_  = '".$anioP_."' AND estatus=1 AND servicio_ != ''".'<br><br>';

        if ( $servicioP_ != 0 OR $servicioP_ != '0') {
          $sql = $this->db->query("SELECT * FROM posicion_mes WHERE  ".$servicioP_." AND mes_ = '".$mesP_."' AND year_  = '".$anioP_."' AND estatus=1 AND servicio_ != '' ");
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
      }else{}
  }

  public function TotalDesconectados($fechaHoy, $servicio , $valorCargo, $totalService){
    if ( $_SESSION['cargo'] == 'ADMINISTRADOR' || $_SESSION['cargo'] == 'GERENTE' ) { //echo '<br> TotalDesconectados --> ADMINISTRADOR <br>';
      $restoQuery = " ";

    }else if ( $_SESSION['cargo'] == 'COORDINADOR' ) { //echo '<br> TotalDesconectados --> COORDINADOR <br>';
      $restoQuery = " AND datos_empleados.cargo != '".$_SESSION['cargo']."'  AND datos_empleados.cargo != 'CLIENTE' AND datos_empleados.cargo != 'ADMINISTRADOR' AND datos_empleados.cargo != 'GERENTE' ";

    }else if ( $_SESSION['cargo'] == 'CLIENTE' ) {   //echo '<br> TotalDesconectados --> CLIENTE <br>';   
      $valorCargo = "";
      $restoQuery = " AND datos_empleados.cargo = 'OPERADOR' ";
    
    }else { //echo '<br> TotalDesconectados --> SUPERVISOR <br>';
      $restoQuery = " AND datos_empleados.cargo != '".$_SESSION['cargo']."'  AND datos_empleados.cargo != 'CLIENTE' AND datos_empleados.cargo != 'ADMINISTRADOR' AND datos_empleados.cargo != 'GERENTE' AND datos_empleados.cargo != 'COORDINADOR' ";
    }


    if ( $totalService > 1) {
      $querySentencia = "SELECT count(*) as contDesconect,  datos_empleados.servicio FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados INNER JOIN campanas ON campanas.abrev_campana = datos_empleados.campana WHERE  registro.dia ='".$fechaHoy."' ".$servicio." AND campanas.estatus = 1 AND datos_empleados.estatusSesion = 2 AND datos_empleados.estatus = 1 AND registro.estatus = 1  ".$valorCargo."  ".$restoQuery. " GROUP BY datos_empleados.servicio";

          //$querySentencia = "SELECT count(*) as contConect,  datos_empleados.servicio FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados INNER JOIN campanas ON campanas.abrev_campana = datos_empleados.campana WHERE registro.dia ='".$fechaHoy."' ".$servicio." AND campanas.estatus = 1 AND datos_empleados.estatusSesion = 1 AND datos_empleados.estatus = 1 AND registro.estatus = 1  ".$valorCargo."  ".$restoQuery. " GROUP BY datos_empleados.servicio";

    }else{
      $querySentencia = "SELECT count(*) as contDesconect FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados INNER JOIN campanas ON campanas.abrev_campana = datos_empleados.campana WHERE  registro.dia ='".$fechaHoy."' ".$servicio." AND campanas.estatus = 1 AND datos_empleados.estatusSesion = 2 AND datos_empleados.estatus = 1 AND registro.estatus = 1  ".$valorCargo."  ".$restoQuery;
    }

    //echo ' <br><br><br> TotalDesconectados:  '.$querySentencia.'<br><br><br>';
    $sql = $this->db->query($querySentencia);
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

  public function TotalPlantilla($fechaHoy, $servicio , $valorCargo, $totalService){
    if ( $_SESSION['cargo'] == 'ADMINISTRADOR' || $_SESSION['cargo'] == 'GERENTE' ) { //echo '<br> TotalPlantilla --> ADMINISTRADOR <br>';
      $restoQuery = " ";

    }else if ( $_SESSION['cargo'] == 'COORDINADOR' ) { //echo '<br> TotalPlantilla --> COORDINADOR <br>';
      $restoQuery = " AND datos_empleados.cargo != '".$_SESSION['cargo']."'  AND datos_empleados.cargo != 'CLIENTE' AND datos_empleados.cargo != 'ADMINISTRADOR' AND datos_empleados.cargo != 'GERENTE' ";

    }else if ( $_SESSION['cargo'] == 'CLIENTE' ) {   //echo '<br> TotalPlantilla --> CLIENTE <br>';   
      $valorCargo = "";
      $restoQuery = " AND datos_empleados.cargo = 'OPERADOR' ";
    
    }else { //echo '<br> TotalPlantilla --> SUPERVISOR <br>';
      $restoQuery = " AND datos_empleados.cargo != 'CLIENTE' AND datos_empleados.cargo != 'ADMINISTRADOR' AND datos_empleados.cargo != 'GERENTE' AND datos_empleados.cargo != 'COORDINADOR' ";
    }


    if ( $totalService > 1) {
      $querySentencia =  $querySentencia = "SELECT count(*) as contPlantill,  datos_empleados.servicio FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados INNER JOIN campanas ON campanas.abrev_campana = datos_empleados.campana WHERE registro.dia ='".$fechaHoy."' ".$servicio." AND campanas.estatus = 1 AND datos_empleados.estatus = 1 AND registro.estatus = 1  ".$valorCargo."  ".$restoQuery . " GROUP BY datos_empleados.servicio";

          //$querySentencia = "SELECT count(*) as contConect,  datos_empleados.servicio FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados INNER JOIN campanas ON campanas.abrev_campana = datos_empleados.campana WHERE registro.dia ='".$fechaHoy."' ".$servicio." AND campanas.estatus = 1 AND datos_empleados.estatusSesion = 1 AND datos_empleados.estatus = 1 AND registro.estatus = 1  ".$valorCargo."  ".$restoQuery. " GROUP BY datos_empleados.servicio";

    }else{
       $querySentencia = "SELECT count(*) as contPlantill FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados INNER JOIN campanas ON campanas.abrev_campana = datos_empleados.campana WHERE registro.dia ='".$fechaHoy."' ".$servicio." AND campanas.estatus = 1 AND datos_empleados.estatus = 1 AND registro.estatus = 1  ".$valorCargo."  ".$restoQuery;
    }


   
    
   // echo ' <br><br><br> TotalPlantilla:  '.$querySentencia.'<br><br><br>';
    $sql = $this->db->query($querySentencia);
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

  public function TotalConectados($fechaHoy, $servicio, $valorCargo, $totalService){
    if ( $_SESSION['cargo'] == 'ADMINISTRADOR' || $_SESSION['cargo'] == 'GERENTE' ) { //echo '<br> TotalConectados --> ADMINISTRADOR <br>';
      $restoQuery = " ";

    }else if ( $_SESSION['cargo'] == 'COORDINADOR' ) { //echo '<br> TotalConectados --> COORDINADOR <br>';
      $restoQuery = " AND datos_empleados.cargo != '".$_SESSION['cargo']."'  AND datos_empleados.cargo != 'CLIENTE' AND datos_empleados.cargo != 'ADMINISTRADOR' AND datos_empleados.cargo != 'GERENTE' ";

    }else if ( $_SESSION['cargo'] == 'CLIENTE' ) {   //echo '<br> TotalConectados --> CLIENTE <br>';   
      $valorCargo = "";
      $restoQuery = " AND datos_empleados.cargo = 'OPERADOR' ";
    
    }else { //echo '<br> TotalConectados --> SUPERVISOR <br>';
      $restoQuery = " AND datos_empleados.cargo != 'CLIENTE' AND datos_empleados.cargo != 'ADMINISTRADOR' AND datos_empleados.cargo != 'GERENTE' AND datos_empleados.cargo != 'COORDINADOR' ";
    }


    if ( $totalService > 1) {
      $querySentencia = "SELECT count(*) as contConect,  datos_empleados.servicio FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados INNER JOIN campanas ON campanas.abrev_campana = datos_empleados.campana WHERE registro.dia ='".$fechaHoy."' ".$servicio." AND campanas.estatus = 1 AND datos_empleados.estatusSesion = 1 AND datos_empleados.estatus = 1 AND registro.estatus = 1  ".$valorCargo."  ".$restoQuery. " GROUP BY datos_empleados.servicio";

    }else{
      $querySentencia = "SELECT count(*) as contConect FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados INNER JOIN campanas ON campanas.abrev_campana = datos_empleados.campana WHERE registro.dia ='".$fechaHoy."' ".$servicio." AND campanas.estatus = 1 AND datos_empleados.estatusSesion = 1 AND datos_empleados.estatus = 1 AND registro.estatus = 1  ".$valorCargo."  ".$restoQuery;
    }


    
    
  //  echo ' <br><br><br>  TotalConectados: ===>   '.$querySentencia.'<br>';
    $sql = $this->db->query($querySentencia);
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
  
  public function Total_TimeAuxiliares_cadaUno($fechaHoy, $servicio, $valorCargo){
    if ( $_SESSION['cargo'] == 'ADMINISTRADOR' || $_SESSION['cargo'] == 'GERENTE' ) { //echo '<br> Total_TimeAuxiliares_cadaUno --> ADMINISTRADOR <br>';
      $restoQuery = " ";

    }else if ( $_SESSION['cargo'] == 'COORDINADOR' ) { //echo '<br> Total_TimeAuxiliares_cadaUno --> COORDINADOR <br>';
      $restoQuery = " AND datos_empleados.cargo != '".$_SESSION['cargo']."'  AND datos_empleados.cargo != 'CLIENTE' AND datos_empleados.cargo != 'ADMINISTRADOR' AND datos_empleados.cargo != 'GERENTE' ";

    }else if ( $_SESSION['cargo'] == 'CLIENTE' ) {   //echo '<br> Total_TimeAuxiliares_cadaUno --> CLIENTE <br>';   
      $valorCargo = "";
      $restoQuery = " AND datos_empleados.cargo = 'OPERADOR' ";
    
    }else { //echo '<br> Total_TimeAuxiliares_cadaUno --> SUPERVISOR <br>';
      $restoQuery = " AND datos_empleados.cargo != 'CLIENTE' AND datos_empleados.cargo != 'ADMINISTRADOR' AND datos_empleados.cargo != 'GERENTE' AND datos_empleados.cargo != 'COORDINADOR' ";
    }

    $querySentencia = "SELECT count(*) as contConect FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados INNER JOIN campanas ON campanas.abrev_campana = datos_empleados.campana WHERE registro.dia ='".$fechaHoy."' ".$servicio." AND campanas.estatus = 1 AND datos_empleados.estatusSesion = 1 AND registro.break != '00:00:00' AND registro.estatusBR = 1 AND datos_empleados.estatusSesion = 1 AND datos_empleados.estatus = 1 AND registro.estatus = 1  ".$valorCargo."  ".$restoQuery." UNION ALL
    SELECT count(*) as contConect FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados INNER JOIN campanas ON campanas.abrev_campana = datos_empleados.campana WHERE registro.dia ='".$fechaHoy."' ".$servicio." AND campanas.estatus = 1 AND datos_empleados.estatusSesion = 1 AND registro.bath != '00:00:00' AND registro.estatusBA = 1 AND datos_empleados.estatusSesion = 1 AND datos_empleados.estatus = 1 AND registro.estatus = 1   ".$valorCargo."  ".$restoQuery." 
       UNION ALL
    SELECT count(*) as contConect FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados INNER JOIN campanas ON campanas.abrev_campana = datos_empleados.campana WHERE registro.dia ='".$fechaHoy."' ".$servicio." AND campanas.estatus = 1 AND datos_empleados.estatusSesion = 1 AND registro.entrenamiento != '00:00:00' AND registro.estatusEN = 1 AND datos_empleados.estatusSesion = 1 AND datos_empleados.estatus = 1 AND registro.estatus = 1   ".$valorCargo."  ".$restoQuery." 
       UNION ALL
    SELECT count(*) as contConect FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados INNER JOIN campanas ON campanas.abrev_campana = datos_empleados.campana WHERE registro.dia ='".$fechaHoy."' ".$servicio." AND campanas.estatus = 1 AND datos_empleados.estatusSesion = 1 AND registro.feek_back != '00:00:00' AND registro.estatusFB = 1 AND datos_empleados.estatusSesion = 1 AND datos_empleados.estatus = 1 AND registro.estatus = 1   ".$valorCargo."  ".$restoQuery." 
      UNION ALL
    SELECT count(*) as contConect FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados INNER JOIN campanas ON campanas.abrev_campana = datos_empleados.campana WHERE registro.dia ='".$fechaHoy."' ".$servicio." AND campanas.estatus = 1 AND datos_empleados.estatusSesion = 1 AND registro.llamada_saliente != '00:00:00' AND registro.estatusLL = 1 AND datos_empleados.estatusSesion = 1 AND datos_empleados.estatus = 1 AND registro.estatus = 1   ".$valorCargo."  ".$restoQuery;

   // echo ' <br><br><br> Total_TimeAuxiliares_cadaUno: <br> '.$querySentencia.'<br><br><br>';
    $sql = $this->db->query($querySentencia);
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
 

  public function TotalHistoric($fechaHoy, $idusers_agente){
   // echo '<br><br>'."SELECT * FROM historicoSesion WHERE historicoSesion.fechaHistori = '".$fechaHoy."' AND historicoSesion.idUsuario= ".$idusers_agente.'<br><br>';

    $sql = $this->db->query("SELECT * FROM historicoSesion WHERE historicoSesion.fechaHistori = '".$fechaHoy."' AND historicoSesion.idUsuario= ".$idusers_agente);
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


  public function consultarSupervisores($servicio){
    //echo "<br> SELECT registro.id_usuario, registro.dia, registro.$auxiliar, registro.hora_inicio, registro.hora_fin, users.id_user, users.nombre, users.apellido FROM registro INNER JOIN users ON users.id_user = registro.id_usuario WHERE registro.dia BETWEEN '$fecha1' AND '$fecha2' ".'<br><br>';
    //echo "SELECT * FROM registro INNER JOIN users ON users.id_user = registro.id_usuario WHERE registro.dia BETWEEN '$fecha1' AND '$fecha2'";

    $sql = $this->db->query("SELECT * FROM datos_empleados  WHERE (cargo = 'SUPERVISOR' OR cargo = 'COORDINADOR') AND datos_empleados.estatus = 1 ".$servicio);
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

  public function consultarxauxiliar($fecha1, $fecha2){
    //echo "<br> SELECT registro.id_usuario, registro.dia, registro.$auxiliar, registro.hora_inicio, registro.hora_fin, users.id_user, users.nombre, users.apellido FROM registro INNER JOIN users ON users.id_user = registro.id_usuario WHERE registro.dia BETWEEN '$fecha1' AND '$fecha2' ".'<br><br>';
    //echo "SELECT * FROM registro INNER JOIN users ON users.id_user = registro.id_usuario WHERE registro.dia BETWEEN '$fecha1' AND '$fecha2'";

    $sql = $this->db->query("SELECT * FROM registro INNER JOIN datos_empleados ON datos_empleados.id_datos_empleados = registro.id_usuario INNER JOIN campanas ON campanas.abrev_campana = datos_empleados.campana WHERE registro.dia BETWEEN '$fecha1' AND '$fecha2'");
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

  public function listSupervisor(){//(cargo='SUPERVISOR' OR cargo='COORDINADOR')
    $sql = $this->db->query("SELECT * FROM datos_empleados WHERE (cargo='SUPERVISOR') /* OR cargo='COORDINADOR'*/ AND estatus=1");
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

  public function listUsuarios(){
    $sql = $this->db->query("SELECT * FROM datos_empleados WHERE estatus = 'ACTIVO'");
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

  public function consultarxagente($fecha1, $fecha2, $idusers_agente){
   // echo "SELECT * FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados WHERE registro.id_usuario =".$idusers_agente." AND (registro.dia BETWEEN '".$fecha1."' AND '".$fecha2."')" .'<br><br>';
    $sql = $this->db->query("SELECT * FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados WHERE registro.id_usuario =".$idusers_agente." AND (registro.dia BETWEEN '".$fecha1."' AND '".$fecha2."')");
    if($this->db->rows($sql) > 0 ){
      while($data = $this->db->recorrer($sql)){
        $respuesta[] = $data;
      }
    }
    else{
      $respuesta = false;
    }
    return $respuesta;/**/
  }

  public function consultarxagenteCambioCampana($fecha1, $fecha2, $idusers_agente){
    //echo "SELECT registro_cambio_camapana.id_table2, registro_cambio_camapana.campana,registro_cambio_camapana.horaInicio, registro_cambio_camapana.horaFinal, registro_cambio_camapana.duracion, registro_cambio_camapana.id_usuario, registro_cambio_camapana.id_registro FROM registro_cambio_camapana INNER JOIN registro ON registro.id_registro = registro_cambio_camapana.id_registro WHERE registro.id_usuario =".$idusers_agente." AND (registro.dia BETWEEN '".$fecha1."' AND '".$fecha2."')" .'<br><br>';


    $sql = $this->db->query("SELECT registro_cambio_camapana.id_table2, registro_cambio_camapana.campana,registro_cambio_camapana.horaInicio, registro_cambio_camapana.horaFinal, registro_cambio_camapana.duracion, registro_cambio_camapana.id_usuario, registro_cambio_camapana.id_registro, registro.dia FROM registro_cambio_camapana INNER JOIN registro ON registro.id_registro = registro_cambio_camapana.id_registro WHERE registro.id_usuario =".$idusers_agente." AND (registro.dia BETWEEN '".$fecha1."' AND '".$fecha2."')");
    if($this->db->rows($sql) > 0 ){
      while($data = $this->db->recorrer($sql)){
        $respuesta[] = $data;
      }  
    }
    else{
      $respuesta = false;
    }
    return $respuesta;/**/
  } 

  public function consultarxtimerealDiaAdmin($fechaHoy, $servicio, $cargoSesion, $valorCargo){
    if ( $cargoSesion == 'ADMINISTRADOR' || $cargoSesion == 'GERENTE' ) {
      $restoQuery = " ORDER BY datos_empleados.estatusSesion DESC, datos_empleados.id_datos_empleados ASC";

    }else if ( $cargoSesion == 'COORDINADOR' ) {
      $restoQuery = " AND datos_empleados.cargo != '".$cargoSesion."'  AND datos_empleados.cargo != 'CLIENTE' AND datos_empleados.cargo != 'ADMINISTRADOR' AND datos_empleados.cargo != 'GERENTE' ORDER BY datos_empleados.estatusSesion DESC, datos_empleados.id_datos_empleados ASC";

    }else if ( $cargoSesion == 'CLIENTE' ) {     
      $valorCargo = "";
      $restoQuery = " AND datos_empleados.cargo = 'OPERADOR'  ORDER BY datos_empleados.estatusSesion DESC, datos_empleados.id_datos_empleados ASC";;
    
    }else {}

    $querySentencia = "SELECT * FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados INNER JOIN campanas ON campanas.abrev_campana = datos_empleados.campana WHERE datos_empleados.estatus = 1 AND campanas.estatus = 1 AND registro.estatus = 1  AND registro.dia ='".$fechaHoy."' ".$servicio." ".$valorCargo."  ".$restoQuery;

    //echo $querySentencia.'<br>';
    $sql = $this->db->query($querySentencia);
    if($this->db->rows($sql) > 0 ){
      while($data = $this->db->recorrer($sql)){
        $respuesta[] = $data;
      }
    }
    else{
      $respuesta = false;
    }
    return $respuesta;/**/
  }

  public function consultarxtimerealDiaSuperv($fechaHoy, $idSession, $servicio, $cargoSesion, $valorCargo){
    //echo "<br> "SELECT * FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados WHERE supervisor = ".$idSession." AND registro.dia ='".$fechaHoy."' AND datos_empleados.supervisor !=0 ORDER BY datos_empleados.estatusSesion DESC, datos_empleados.id_datos_empleados ASC .'<br><br>';
    
    //"SELECT * FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados INNER JOIN campanas ON campanas.abrev_campana = datos_empleados.campana WHERE registro.estatus = 1 AND datos_empleados.servicio ='".$_SESSION['id_servicio']."' AND registro.dia ='".$fechaHoy."' AND datos_empleados.supervisor !=0 ORDER BY datos_empleados.estatusSesion DESC, datos_empleados.id_datos_empleados ASC"


    //echo "consultarxtimerealDiaSuperv <br><br> SELECT * FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados INNER JOIN campanas ON campanas.abrev_campana = datos_empleados.campana WHERE registro.estatus = 1 ".$servicio." ".$valorCargo." AND registro.dia ='".$fechaHoy."' AND campanas.estatus = 1  ORDER BY datos_empleados.estatusSesion DESC, datos_empleados.id_datos_empleados ASC". '<br><br>';

    $sql = $this->db->query("SELECT * FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados INNER JOIN campanas ON campanas.abrev_campana = datos_empleados.campana WHERE datos_empleados.estatus = 1 AND registro.estatus = 1 ".$servicio." ".$valorCargo." AND registro.dia ='".$fechaHoy."' AND campanas.estatus = 1  ORDER BY datos_empleados.estatusSesion DESC, datos_empleados.id_datos_empleados ASC");
    if($this->db->rows($sql) > 0 ){
      while($data = $this->db->recorrer($sql)){
        $respuesta[] = $data;
      }
    }
    else{
      $respuesta = false;
    }
    return $respuesta;/**/
  }

    public function consultarxCambioCampanaRealDia($fechaHoy){
    //echo "<br> SELECT * FROM users INNER JOIN registro ON registro.id_usuario = users.id_user WHERE registro.dia ='".$fechaHoy."'" .'<br><br>';
    
    $sql = $this->db->query("SELECT registro_cambio_camapana.id_table2, registro_cambio_camapana.campana,registro_cambio_camapana.horaInicio, registro_cambio_camapana.horaFinal, registro_cambio_camapana.duracion, registro_cambio_camapana.id_usuario, registro_cambio_camapana.id_registro FROM registro_cambio_camapana INNER JOIN registro ON registro.id_registro = registro_cambio_camapana.id_registro WHERE registro.dia ='".$fechaHoy."'");
    if($this->db->rows($sql) > 0 ){
      while($data = $this->db->recorrer($sql)){
        $respuesta[] = $data;
      }
    }
    else{
      $respuesta = false;
    }
    return $respuesta;/**/
  } 

  public function busquedaAgnte($busqueda){
    //echo "SELECT * FROM users WHERE nombre LIKE '%$busqueda%' OR apellido LIKE '%$busqueda%';".'<br><br>';
    $sql = $this->db->query("SELECT * FROM datos_empleados WHERE (estatus = 1) AND (cargo = 'OPERADOR') AND (nombre LIKE '%$busqueda%' OR apellido LIKE '%$busqueda%');" );
    if($this->db->rows($sql) > 0 ){
      while($data = $this->db->recorrer($sql)){
        $respuesta[] = $data;
      }
    }
    else{
      $respuesta = false;
    }
    return $respuesta;
  }/**/

  public function updateSesion($idEmpleado){
    //echo "UPDATE datos_empleados SET estatusSesion = 2  WHERE id_datos_empleados = ".$idUsuario.'<br><br>';/**/

    $sqlDia = $this->db->query("UPDATE datos_empleados SET estatusSesion = 2  WHERE id_datos_empleados = ".$idEmpleado);
    $respuesta = true;
    return $respuesta;
  }

  public function servicios($valor){
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

    }
  }

  public function cargosList($valorCargo){ //echo "SELECT * FROM cargos WHERE estatus = 1 ".$valorCargo;
      $sql = $this->db->query("SELECT * FROM cargos WHERE estatus = 1 ".$valorCargo);
        if($this->db->rows($sql) > 0 ){
          while($data = $this->db->recorrer($sql)){
            $respuesta[] = $data;
          }
        }else{
          $respuesta = false;
        }
      return $respuesta;    
  }

  public function supervisoresList(){ //echo "  ";
      $sql = $this->db->query("SELECT * FROM datos_empleados WHERE estatus = 1 AND (cargo = 'SUPERVISOR' OR cargo = 'COORDINADOR') ");
        if($this->db->rows($sql) > 0 ){
          while($data = $this->db->recorrer($sql)){
            $respuesta[] = $data;
          }
        }else{
          $respuesta = false;
        }
      return $respuesta;    
  }

  public function idServicio($service){
    $sql = $this->db->query("SELECT * FROM servicios WHERE servicios = '".$service."' AND estatus=1");
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
  public function campanasDelService($idService){
    $sql = $this->db->query("SELECT * FROM campanas WHERE id_servicio = $idService AND estatus = 1");
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
  public function contCampanaxService($sqlQuery){
    //echo $sqlQuery;
    $sql = $this->db->query($sqlQuery);
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

   public function selectSuperxServi($idService){
    //echo "SELECT DISTINCT(datos_empleados.supervisor) as idSuper FROM datos_empleados INNER JOIN servicios ON servicios.servicios = datos_empleados.servicio WHERE servicios.idServicio = ".$idService." AND servicios.estatus = 1 AND datos_empleados.supervisor != 0".'<br>';

    //SELECT * FROM datos_empleados INNER JOIN servicios ON servicios.servicios = datos_empleados.servicio WHERE servicios.idServicio = 12 AND datos_empleados.estatus = 1 AND  servicios.estatus = 1 AND datos_empleados.cargo = 'SUPERVISOR'
    //echo "SELECT * FROM datos_empleados INNER JOIN servicios ON servicios.servicios = datos_empleados.servicio WHERE servicios.idServicio = ".$idService." AND datos_empleados.estatus = 1 AND  servicios.estatus = 1 AND datos_empleados.cargo = 'SUPERVISOR'";

   // echo ' MODEL_ '. "SELECT * FROM datos_empleados INNER JOIN servicios ON servicios.servicios = datos_empleados.servicio WHERE datos_empleados.estatus = 1 AND  servicios.estatus = 1 AND datos_empleados.cargo = 'SUPERVISOR' ".$idService.'<br><br>';

    $sql = $this->db->query("SELECT * FROM datos_empleados INNER JOIN servicios ON servicios.servicios = datos_empleados.servicio WHERE datos_empleados.estatus = 1 AND  servicios.estatus = 1 AND datos_empleados.cargo = 'SUPERVISOR' ".$idService);
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


}?>
