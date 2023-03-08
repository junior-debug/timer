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

  public function updatePaswword_($passEncript, $users){
    /*echo "UPDATE datos_empleados SET passwords = '".$passEncript."', estatusClave = 1 WHERE id_datos_empleados = ".$users;*/
    
    $sql = $this->db->query("UPDATE datos_empleados SET passwords = '".$passEncript."', estatusClave = 1 WHERE id_datos_empleados = ".$users);
    $respuesta = true;
    return $respuesta;
  }

  public function ReinicioPasswordUser($users, $passEncript){
    /*echo "UPDATE datos_empleados SET passwords = '".$passEncript."', estatusClave = 1 WHERE id_datos_empleados = ".$users;*/
    
    $sql = $this->db->query("UPDATE datos_empleados SET passwords = '".$passEncript."', estatusClave = 0 WHERE id_datos_empleados = ".$users);
    $respuesta = true;
    return $respuesta;
  }
  
  public function selectcamapanas($id_servicio){
    $sql = $this->db->query("SELECT * FROM campanas INNER JOIN servicios ON servicios.idServicio=campanas.id_servicio WHERE campanas.id_servicio =".$id_servicio." AND campanas.estatus=1");
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

  public function campanas(){
    $sql = $this->db->query("SELECT * FROM campanas WHERE estatus=1");
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

  public function consultaAbrevCamapana($nameCampana){
    $sql = $this->db->query("SELECT * FROM campanas WHERE name_campana= '".$nameCampana."' AND estatus=1");
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
  
  public function rotacions(){
    $sql = $this->db->query("SELECT * FROM rotacions WHERE estatus=1");
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
  public function turnos(){
    $sql = $this->db->query("SELECT * FROM turnos WHERE estatus=1");
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
  public function cargos(){
    $sql = $this->db->query("SELECT * FROM cargos WHERE estatus=1");
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

  public function newEmpleado($nombre,$apellido,$cedula,$genero,$cargo,$fecha_ingreso,$servicio,$campana,$rotacion,$turno,$supervisor,$users, $passEncript){

    //echo "MODELO: "."SELECT * FROM datos_empleados WHERE cedula = '$cedula'";
    //echo "MODELO: ". "INSERT INTO datos_empleados (nombre,apellido,cedula,genero,cargo,fecha_ingreso,supervisor,servicio,campana,rotacion,turno,users,passwords) VALUES ('$nombre','$apellido','$cedula','$genero','$cargo','$fecha_ingreso',$supervisor,'$servicio','$campana','$rotacion','$turno','$users', '$passEncript')";

  	$sql = $this->db->query("SELECT * FROM datos_empleados WHERE cedula = '$cedula'");
  	if($this->db->rows($sql) == 0 ){
  		$sql = $this->db->query("INSERT INTO datos_empleados (nombre,apellido,cedula,genero,cargo,fecha_ingreso,supervisor,servicio,campana,rotacion,turno,users,passwords) VALUES ('$nombre','$apellido','$cedula','$genero','$cargo','$fecha_ingreso',$supervisor,'$servicio','$campana','$rotacion','$turno','$users', '$passEncript')");
  		$respuesta = true;
  	
    }else{
  		$respuesta = false;
  	}
  	return $respuesta;/**/
  }

  public function newEmpleadoMasivo($nombre,$apellido,$cedula,$genero,$cargo,$fecha_ingreso,$servicio,$campana,$rotacion,$turno,$users, $passEncript){

    //echo "MODELO: "."SELECT * FROM datos_empleados WHERE cedula = '$cedula'";
    //echo "MODELO: ". "INSERT INTO datos_empleados (nombre,apellido,cedula,genero,cargo,fecha_ingreso,supervisor,servicio,campana,rotacion,turno,users,passwords) VALUES ('$nombre','$apellido','$cedula','$genero','$cargo','$fecha_ingreso',$supervisor,'$servicio','$campana','$rotacion','$turno','$users', '$passEncript')";

    $sql = $this->db->query("SELECT * FROM datos_empleados WHERE cedula = '$cedula'");
    
    if($this->db->rows($sql) == 0 ){
      $sql = $this->db->query("INSERT INTO datos_empleados (nombre,apellido,cedula,genero,cargo,fecha_ingreso,servicio,campana,rotacion,turno,users,passwords) VALUES ('$nombre','$apellido','$cedula','$genero','$cargo','$fecha_ingreso','$servicio','$campana','$rotacion','$turno','$users', '$passEncript')");
      $respuesta = true;
    
    }else{
      $respuesta = false;
    }
    return $respuesta;/**/
  }

    public function listUser($servicioSesion, $idSession, $cargoSesion){
    //$sql = $this->db->query("SELECT users.id_user,users.nombre,users.apellido,users.genero,users.user,users.type_user,users.status,departamentos.descripcion FROM users inner JOIN departamentos on users.id_departamento = departamentos.id_departamento WHERE type_user != 1");

   /* echo '<br>';
    echo "SELECT * FROM datos_empleados WHERE supervisor = ".$idSession." AND estatus=1 AND datos_empleados.servicio='".$servicioSesion."'";
    
    ******* CARGOS *************
          ADMINISTRADOR --
          COORDINADOR ---
          ANALISTA
          OPERADOR
          SUPERVISOR ----
          0
          CLIENTE -----
          GERENTE --
    */
    if ($cargoSesion == 'ADMINISTRADOR' || $cargoSesion == 'GERENTE') {
        $sql = $this->db->query("SELECT * FROM datos_empleados WHERE estatus=1 AND datos_empleados.cargo != 'ADMINISTRADOR' AND datos_empleados.cargo != 'GERENTE'");
        if($this->db->rows($sql) > 0 ){
          while($data = $this->db->recorrer($sql)){
            $respuesta[] = $data;
          }
        }
        else{
          $respuesta = false;
        }
        return $respuesta;

    }else if ($cargoSesion == 'COORDINADOR') {
        $sql = $this->db->query("SELECT * FROM datos_empleados WHERE datos_empleados.estatus=1 AND datos_empleados.servicio = '".$servicioSesion."'  AND datos_empleados.cargo != '".$cargoSesion."'  AND datos_empleados.cargo != 'CLIENTE' ");
        if($this->db->rows($sql) > 0 ){
          while($data = $this->db->recorrer($sql)){
            $respuesta[] = $data;
          }
        }
        else{
          $respuesta = false;
        }
        return $respuesta;

    }else if ($cargoSesion == 'SUPERVISOR') {
          //echo '<br>';
          //echo 'TOTAL: '. count($servicioSesion). ' Servicios: '. $servicioSesion.'<br>';
          $separacion = explode(',', $servicioSesion);

          if ( count($separacion) == 1) {
            $sqlService = 'AND (datos_empleados.servicio = "'.$servicioSesion.'")';
            
          }else if ( count($separacion) == 2) {
            $sqlService = 'AND (datos_empleados.servicio = "'.$separacion[0].'" OR datos_empleados.servicio = "'.$separacion[1].'")';
          
          }else{
            $sqlService = 'AND (datos_empleados.servicio = "'.$separacion[0].'" OR datos_empleados.servicio = "'.$separacion[1].'" OR datos_empleados.servicio = "'.$separacion[2].'")';
          }

        $sql = $this->db->query("SELECT * FROM datos_empleados WHERE datos_empleados.estatus=1 ".$sqlService."  AND datos_empleados.cargo != '".$cargoSesion."' AND datos_empleados.cargo != 'COORDINADOR'  AND datos_empleados.cargo != 'CLIENTE' ");
        if($this->db->rows($sql) > 0 ){
          while($data = $this->db->recorrer($sql)){
            $respuesta[] = $data;
          }
        }
        else{
          $respuesta = false;
        }
        return $respuesta;

    }else if ($cargoSesion == 'CLIENTE') {
        $sql = $this->db->query("SELECT * FROM datos_empleados WHERE datos_empleados.estatus=1 AND datos_empleados.servicio = '".$servicioSesion."' AND datos_empleados.cargo = 'OPERADOR'");
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

      /*$sql = $this->db->query("SELECT * FROM datos_empleados WHERE supervisor = ".$idSession." AND estatus=1 AND datos_empleados.servicio='".$servicioSesion."'");
        if($this->db->rows($sql) > 0 ){
          while($data = $this->db->recorrer($sql)){
            $respuesta[] = $data;
          }
        }
        else{
          $respuesta = false;
        }
        return $respuesta;*/
    }
  }



  public function editUser($id_user){
    //$sql = $this->db->query("SELECT a.nombre,a.apellido,a.user,a.type_user,a.status,b.descripcion,b.id_departamento FROM users a LEFT JOIN departamentos b ON a.id_departamento = b.id_departamento WHERE a.id_user = $id_user");
    $sql = $this->db->query("SELECT * FROM datos_empleados WHERE id_datos_empleados=$id_user AND estatus=1");
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

  public function updateEditUser($id_datos_empleados,$nombreEdit,$apellidoEdit,$cedulaEdit,$genero_edit,$cargoEdit,$servicioEdit,$campanaEdit_,$rotacionEdit,$turnoEdit,$supervisorEdit,  $valorEdit, $supervisorEditNuevo, $IdCargoActualEdit){ 
    /*echo "UPDATE datos_empleados SET nombre = '$nombreEdit', apellido = '$apellidoEdit', cedula = '$cedulaEdit', cargo = '$cargoEdit', servicio = '$servicioEdit', rotacion = '$rotacionEdit', turno = '$turnoEdit', id_supervisor = '$supervisorEdit' WHERE id_datos_empleados = ".$id_datos_empleados;*/
    
    /*
       ES ESTEEE*/
    if ( $valorEdit == 2) {
      $sql = $this->db->query("UPDATE datos_empleados SET supervisor =".$supervisorEditNuevo."  WHERE supervisor =".$IdCargoActualEdit);

      $sql = $this->db->query("UPDATE datos_empleados SET nombre = '$nombreEdit', apellido = '$apellidoEdit', cedula = '$cedulaEdit', genero = '$genero_edit', cargo = '$cargoEdit', servicio = '$servicioEdit', campana = '$campanaEdit_', rotacion = '$rotacionEdit', turno = '$turnoEdit', supervisor = '$supervisorEdit' WHERE id_datos_empleados = ".$id_datos_empleados);
      $respuesta = true;
      return $respuesta;


    }else{
      $sql = $this->db->query("UPDATE datos_empleados SET nombre = '$nombreEdit', apellido = '$apellidoEdit', cedula = '$cedulaEdit', genero = '$genero_edit', cargo = '$cargoEdit', servicio = '$servicioEdit', campana = '$campanaEdit_', rotacion = '$rotacionEdit', turno = '$turnoEdit', supervisor = '$supervisorEdit' WHERE id_datos_empleados = ".$id_datos_empleados);
      $respuesta = true;
      return $respuesta;

    }    
  }

  public function EditFormReincorUser($id_user){
    $sql = $this->db->query("SELECT * FROM datos_empleados WHERE id_datos_empleados=$id_user AND estatus=2");
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








//AQUIIIIIIIIIIII



  public function registroDeleteUser($aa, $bb, $cc, $dd, $valorEdit, $supervisorDeletNuevo){
    /*$sql = $this->db->query("SELECT * FROM egresoempleados WHERE idDatosEmpleado=$aa AND estatus=1");
    if($this->db->rows($sql) > 0 ){
      while($data = $this->db->recorrer($sql)){
        $respuesta[] = $data;
      }
    }
    else{
      $respuesta = false;
    }

    if ($respuesta) {
      $sql0 = $this->db->query("UPDATE egresoempleados SET estatus = 2 WHERE idEgreso = ".$respuesta[0]['idEgreso']);
      $sql = $this->db->query("INSERT INTO egresoempleados (idDatosEmpleado,motivo, observacion,fecha) VALUES ($aa,'$bb','$cc', '$dd')");
      $sql2 = $this->db->query("UPDATE datos_empleados SET estatus = 2 WHERE id_datos_empleados = ".$aa);
      
        $respuesta = true;
        return $respuesta;
    }else{

      $sql = $this->db->query("INSERT INTO egresoempleados (idDatosEmpleado,motivo, observacion,fecha) VALUES ($aa,'$bb','$cc', '$dd')");
      $sql2 = $this->db->query("UPDATE datos_empleados SET estatus = 2 WHERE id_datos_empleados = ".$aa);
        $respuesta = true;
        return $respuesta;
    }*/ 

   /* ES ESTEEE*/

   $sql = $this->db->query("SELECT * FROM egresoempleados WHERE idDatosEmpleado=$aa AND estatus=1");
    if($this->db->rows($sql) > 0 ){
      while($data = $this->db->recorrer($sql)){
        $respuesta[] = $data;
      }
    }
    else{
      $respuesta = false;
    }

    if ($respuesta) {
      if ( $valorEdit == 2) {
        $sql__ = $this->db->query("UPDATE datos_empleados SET supervisor =".$supervisorDeletNuevo."  WHERE supervisor =".$aa);
      }

        $sql0 = $this->db->query("UPDATE egresoempleados SET estatus = 2 WHERE idEgreso = ".$respuesta[0]['idEgreso']);
        $sql = $this->db->query("INSERT INTO egresoempleados (idDatosEmpleado,motivo, observacion,fecha) VALUES ($aa,'$bb','$cc', '$dd')");
        $sql2 = $this->db->query("UPDATE datos_empleados SET estatus = 2 WHERE id_datos_empleados = ".$aa);
        $respuesta = true;
        return $respuesta;
     

    }else{
      if ( $valorEdit == 2) {
        $sql__ = $this->db->query("UPDATE datos_empleados SET supervisor =".$supervisorDeletNuevo."  WHERE supervisor =".$aa);
      }

        $sql = $this->db->query("INSERT INTO egresoempleados (idDatosEmpleado,motivo, observacion,fecha) VALUES ($aa,'$bb','$cc', '$dd')");
        $sql2 = $this->db->query("UPDATE datos_empleados SET estatus = 2 WHERE id_datos_empleados = ".$aa);
        $respuesta = true;
        return $respuesta;
    }      
  }

  public function listUserEgrasado(){
    $sql = $this->db->query("SELECT  DISTINCT(datos_empleados.id_datos_empleados),egresoempleados.idEgreso, egresoempleados.fecha, egresoempleados.estatus, datos_empleados.nombre, datos_empleados.apellido, datos_empleados.cedula, datos_empleados.cargo, datos_empleados.servicio, datos_empleados.rotacion, datos_empleados.turno, egresoempleados.motivo, egresoempleados.observacion  FROM egresoempleados LEFT JOIN datos_empleados ON datos_empleados.id_datos_empleados = egresoempleados.idDatosEmpleado WHERE datos_empleados.estatus=2 AND egresoempleados.estatus=1");
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

  public function inserReincorp($id_datos_empleados, $nombreEdit, $apellidoEdit, $cedulaEdit, $genero_edit, $cargoEdit, $fechaIngreEdit, $servicioEdit,$campanaEdit_ , $rotacionEdit, $turnoEdit, $supervisorEdit, $usersEdit, $passsEdit){
    //"INSERT INTO datos_empleados (nombre,apellido,cedula,cargo,fecha_ingreso,servicio,rotacion,turno,id_supervisor) VALUES ('$nombreEdit','$apellidoEdit','$cedulaEdit','$cargoEdit','$fechaIngreEdit','$servicioEdit','$rotacionEdit','$turnoEdit',$supervisorEdit)"

    $sql = $this->db->query("UPDATE datos_empleados SET estatus = 3 WHERE id_datos_empleados = ".$id_datos_empleados);
    $sqlDia = $this->db->query("INSERT INTO datos_empleados (nombre,apellido,cedula,genero,cargo,fecha_ingreso,supervisor,servicio,campana,rotacion,turno, users, passwords) VALUES ('$nombreEdit','$apellidoEdit','$cedulaEdit','$genero_edit','$cargoEdit','$fechaIngreEdit',$supervisorEdit,'$servicioEdit','$campanaEdit_','$rotacionEdit','$turnoEdit','$usersEdit','$passsEdit')");
    $respuesta = true;
    return $respuesta;
  }

  public function busquedaAgnte($servicioSesion, $cargoUSer, $busqueda){
    //echo "SELECT * FROM users WHERE nombre LIKE '%$busqueda%' OR apellido LIKE '%$busqueda%';".'<br><br>';
    if ($cargoUSer == 'ADMINISTRADOR' OR $cargoUSer == 'COORDINADOR' ) {
        $sql = $this->db->query("SELECT * FROM datos_empleados WHERE (estatus = 1) AND (nombre LIKE '%".$busqueda."%' OR apellido LIKE '%".$busqueda."%');" );
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
        $sql = $this->db->query("SELECT * FROM datos_empleados WHERE (estatus = 1) AND (cargo = 'OPERADOR') AND (servicio = '".$servicioSesion."') AND (nombre LIKE '%".$busqueda."%' OR apellido LIKE '%".$busqueda."%');" );
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

  public function consultarxSesionAgente($fecha1, $fecha2, $idusers_agente){
    $sql = $this->db->query("SELECT * FROM datos_empleados INNER JOIN historicoSesion ON historicoSesion.idUsuario = datos_empleados.id_datos_empleados WHERE historicoSesion.idUsuario =".$idusers_agente." AND (historicoSesion.fechaHistori BETWEEN '".$fecha1."' AND '".$fecha2."')");
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
  //__________________________________________________________________________________________________
  //___________________________________
  public function HistorySesionGeneral($fecha1, $fecha2){
  //  echo "SELECT datos_empleados.id_datos_empleados, datos_empleados.nombre, datos_empleados.apellido, datos_empleados.cedula, datos_empleados.servicio, datos_empleados.campana, datos_empleados.rotacion, datos_empleados.turno, historicoSesion.idHistSesion, historicoSesion.horaInicio, historicoSesion.horaFin, historicoSesion.fechaHistori FROM datos_empleados INNER JOIN historicoSesion ON historicoSesion.idUsuario = datos_empleados.id_datos_empleados WHERE (historicoSesion.fechaHistori BETWEEN '".$fecha1."' AND '".$fecha2."') <br><br>";

    $sql = $this->db->query("SELECT datos_empleados.id_datos_empleados, datos_empleados.nombre, datos_empleados.apellido, datos_empleados.cedula, datos_empleados.cargo, datos_empleados.supervisor, datos_empleados.servicio, datos_empleados.campana, datos_empleados.rotacion, datos_empleados.turno, historicoSesion.idHistSesion, historicoSesion.horaInicio, historicoSesion.horaFin, historicoSesion.fechaHistori FROM datos_empleados INNER JOIN historicoSesion ON historicoSesion.idUsuario = datos_empleados.id_datos_empleados WHERE (historicoSesion.fechaHistori BETWEEN '".$fecha1."' AND '".$fecha2."')");
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
  // SELECT * FROM datos_empleados WHERE servicio = '".$nameService."' AND cargo = 'SUPERVISOR' AND estatus=1
  public function selectSuperv($nameService){
    $sql = $this->db->query("SELECT * FROM datos_empleados WHERE cargo = 'SUPERVISOR' AND estatus=1 AND servicio LIKE '%".$nameService."%';");
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
