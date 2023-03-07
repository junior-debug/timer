<?php
include(PUBLIC_DIR.'general/session.php');
/*if($_SESSION['cargo'] == 'OPERADOR'){
	header("location:?view=contador&mode=index"); 
}else{*/
	if(empty($_SESSION)){header('location:index.php');}else{
		include_once(MODEL_DIR.'usuariosModel.php');
		$conexion = new database();
		if (isset($_GET['mode'])) {
			switch ($_GET['mode']) {
				case 'index':
					$servicioSesion = $_SESSION['id_servicio'];
					$cargoSesion 	= $_SESSION['cargo'];
					$listUser 		= $conexion->listUser($servicioSesion, $_SESSION['id'], $cargoSesion);
					$listSupervisor = $conexion->listSupervisor(); 
					/*echo $servicioSesion. ' --> '. $_SESSION['id'];*/

					include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'usuarios/index.php');
					include(PUBLIC_DIR.'general/footer.html');
				break;
		#----------------------------------------------------------	
		#----------------------------------------------------------	
				case 'cambio_password':
					include(PUBLIC_DIR.'general/header.html'); 
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'usuarios/reset_passwor.php');
					include(PUBLIC_DIR.'general/footer.html');
				break;
		#----------------------------------------------------------	
		#----------------------------------------------------------	
				case 'resertClaveUser':
					$clave1 = $_POST['clave1'];
					$users 	= $_POST['users'];
					$passEncript 	= $conexion->Encrypt($clave1);

					$updatePaswword = $conexion->updatePaswword_($passEncript, $users);
					
					if ($updatePaswword){
						$json['response'] = 'true';
						echo json_encode($json);
					}else{
						$json['response'] = 'false';
						echo json_encode($json);
					}
 
				break;
		#----------------------------------------------------------
		#----------------------------------------------------------	
		#----------------------------------------------------------	 
				case 'new_individual':
					$rotaciones = $conexion->rotacions();
					$servicios = $conexion->servicios();
					$listSupervisor = $conexion->listSupervisor();
					$cargos = $conexion->cargos();
					include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'usuarios/newuser.php');
					include(PUBLIC_DIR.'general/footer.html');
				break;
		#----------------------------------------------------------	
				case 'registro_empleado':
					$nombre 		= $_POST['nombre'];
					$apellido 		= $_POST['apellido'];
					$cedula 		= $_POST['cedula'];
					$genero 		= $_POST['genero'];
					$cargo 			= $_POST['cargo'];
					$fecha_ingreso 	= $_POST['fecha_ingreso'];
					$rotacion 		= strtoupper($_POST['rotacion']);
					$turno 			= strtoupper($_POST['turno']);
					$supervisor 	= $_POST['supervisor'];
					$users 			= $_POST['users'];
					$passEncript 	= $conexion->Encrypt($_POST['passs']);

					//echo "CONTROLLER: ".$nombre. " ==> ".$apellido. " ==> ".$cedula ." ==> ".$genero. " ==> ".$cargo. " ==> ".$fecha_ingreso. " ==> ".$servicio. " ==> ".$campana. " ==> ".$rotacion. " ==> ".$turno. " ==> ".$supervisor. " ==> ".$users. " ==> ".$passs;
					if ( $_POST['radioSuper'] == 1) {
						$servicio 		= strtoupper($_POST['servicio']);
						$campana 		= strtoupper($_POST['campana']);
						
						$registro = $conexion->newEmpleado($nombre,$apellido,$cedula,$genero,$cargo,$fecha_ingreso,$servicio,$campana,$rotacion,$turno,$supervisor,$users, $passEncript);

						if ($registro){
							$json['response'] = 'true';
							echo json_encode($json);
						}else{
							$json['response'] = 'false';
							echo json_encode($json);
						}/**/
					}else{
						$servicio 	= implode(",", $_POST['servicio']);
						$campana 	= implode(",", $_POST['campana']);
						//echo ' tipo: '. $_POST['servicio']. ' *** ' . $servicio. ' *** ' . $campana;

						$registro = $conexion->newEmpleado($nombre,$apellido,$cedula,$genero,$cargo,$fecha_ingreso,$servicio,$campana,$rotacion,$turno,$supervisor,$users, $passEncript);

						if ($registro){
							$json['response'] = 'true';
							echo json_encode($json);
						}else{
							$json['response'] = 'false';
							echo json_encode($json);
						}/**/
					}
					
				break;
		#----------------------------------------------------------	
				case 'new_masivo':
					//$departamento = $conexion->departamento();
					include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'usuarios/newuser_masivo.php');
					include(PUBLIC_DIR.'general/footer.html');
				break;
		#----------------------------------------------------------	
				case 'registroNewMasivo':
					$archivo=$_FILES["archivo"]['name'];
					//$codigoAleatorio=rand(0000000,9999999);
					//$resultado = str_replace(" ", "", $archivo);
					//$array= explode (".",$resultado);
					//$nombre_aleatorio=$array[0]."_".$codigoAleatorio.".".$array[1];	
					$nombrearchivo = "public/archivos/".$archivo;	
					$subida=move_uploaded_file($_FILES["archivo"]["tmp_name"],$nombrearchivo);
					header('location:?view=usuarios&mode=archivoSubir&nombre='.$archivo.'&letra=M');
				break;
		#----------------------------------------------------------	
				case 'archivoSubir':
					$nombre_aleatorio	= $_GET['nombre'];
					$contDupli = 0;
					$contNuevo = 0;
					$contDupliArra = array();
					$contNuevoArra = array();
					//echo "public/archivos/".$nombre_aleatorio;
					if(($fp = fopen("public/archivos/".$nombre_aleatorio, "r"))!== false){									
						$nombre_campo=fgetcsv($fp,0,";");
						$num_campo=count($nombre_campo);	
							while (($datos=fgetcsv($fp,0,";"))!==false){	
								for ($i=0; $i <count($datos) ; $i++) { 
									if (empty($datos[$i])) {
										$datos[$i]=0;
									}
								}

								if(isset($datos[0])){
									if ($datos[3] == 'Masculino') {
										$genero = 'M';

									}else if ($datos[3] == 'Femenino') {
										$genero = 'F';
									}else{
										$genero = '';
									}

									$nombre 			=  utf8_encode(strtoupper($datos[0]));
									$apellido 			=  utf8_encode(strtoupper($datos[1]));
									$cedula 			=  trim($datos[2]);
									$cargo  			=  strtoupper($datos[4]);

									//cambio al formato de fecha que requiero, paso de 4/5/2022 a 2022-04-05
									$aa 				=  strtotime($datos[5]); 
									$fecha_ingreso		=  date("Y-m-d", $aa);
									//END cambio al formato 
									$servicio  			=  strtoupper($datos[6]);

									//Por medio de la campaña, la sustituyo por la ABREV,ie, de COBRANZAS pase a SCO
									$campanaArchi  		=  strtoupper($datos[7]);
									$consult1 			= $conexion->consultaAbrevCamapana($campanaArchi);
										if ($consult1) {
											$campana 	= $consult1[0]['abrev_campana'];
										}else{
											$campana 	= $campanaArchi;
										}
									//END por medio de la campaña

									$rotacion  			=  strtoupper($datos[8]);
									$turno  			=  strtoupper($datos[9]); 

									$dividirApell 		= explode(" ", $apellido);
									$users 				= $cedula;
									$passEncript 		= $conexion->Encrypt('timer12345++');
 									
									$servicio 			= str_replace("_", " ", $servicio);
									$campana 			= str_replace("_", " ", $campana); 

									//echo ' '. $nombre.' ==> '.$apellido.' ==> '.$cedula.' ==> '.$genero.' ==> '.$cargo.' ==> '.$fecha_ingreso.' ==> '.$servicio.' ==> '.$campana.' ==> '.$rotacion.' ==> '.$turno.' ==> '. $users.' ==> '. $passEncript."<br><br>";

									if ( $nombre != '0' AND  $cedula != '0' ) {
										//echo '<br><br>';
										//echo ' *** '. $nombre.' ==> '.$apellido.' ==> '.$cedula.' ==> '.$genero.' ==> '.$cargo.' ==> '.$fecha_ingreso.' ==> '.$servicio.' ==> '.$campana.' ==> '.$rotacion.' ==> '.$turno.' ==> '. $users.' ==> '. $passEncript."<br><br>";
										$registro = $conexion->newEmpleadoMasivo($nombre,$apellido,$cedula,$genero,$cargo,$fecha_ingreso,$servicio,$campana,$rotacion,$turno, $users, $passEncript);
									}
								}		
							}
							fclose($fp);
					}/**/

					//echo count($contDupliArra)." ==> ".count($contNuevoArra);

					$mensaje	=	'exito';
					header('location:?view=usuarios&mode=new_masivo&msj='.$mensaje);/**/
				break;
		#----------------------------------------------------------
				case 'edituser':
					$id_user 	= $_GET['id'];
					$consulta1 	= $conexion->cargos();
					$consulta2 	= $conexion->servicios();
					$consulta3 	= $conexion->rotacions();
					$consulta4 	= $conexion->turnos();
					$consulta5 	= $conexion->campanas();
					$listSuperv = $conexion->listSupervisor();
					
					$registro = $conexion->editUser($id_user);
					foreach ($registro as $u) {
						$id_datos_empleados = $u['id_datos_empleados'];
						$nombre 			= $u['nombre'];
						$apellido 			= $u['apellido'] ;
						$cedula 			= $u['cedula'];
						$genero 			= $u['genero'];
						$cargo 				= $u['cargo'];
						$fecha_ingreso 		= $u['fecha_ingreso'];
						$servicio 			= $u['servicio'];
						$campana 			= $u['campana'];
						$rotacion			= $u['rotacion'];
						$turno 				= $u['turno'];
						$IDsupervidor		= $u['supervisor'];
						$estatus 			= $u['estatus'];

						$users 				= $u['users'];
						$pass 				= $u['passwords'];
					}

					//if($rol == 2){$e='selected';$f="";$g="";}elseif($rol == 3){$f='selected';$e="";$g="";}else{$g='selected';$f="";$e="";}
					//if($status = 'ACTIVO'){$b="";$a="selected";}else{$a="";$b="selected";}
					include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'usuarios/edituser.php');
					include(PUBLIC_DIR.'general/footer.html');
				break;
		#------------------------------------------------------------------------------------------------------------------------------	
				case 'updateEdit':
					$id_datos_empleados = $_POST['id_datos_empleados'];
					$nombreEdit 		= $_POST['nombreEdit'];
					$apellidoEdit 		= $_POST['apellidoEdit'];
					$cedulaEdit 		= $_POST['cedulaEdit']; 
					$genero_edit 		= $_POST['genero_edit'];
					$cargoEdit 			= $_POST['cargoEdit'];
					$servicioEdit 		= $_POST['servicioEdit'];
					$campanaEdit_ 		= $_POST['campanaEdit_'];
					$rotacionEdit 		= $_POST['rotacionEdit'];
					$turnoEdit 			= $_POST['turnoEdit'];
					$supervisorEdit 	= $_POST['supervisorEdit'];

						$valorEdit 				= $_POST['valorEdit'];
						$supervisorEditNuevo 	= $_POST['supervisorEditNuevo'];
						$IdCargoActualEdit 		= $_POST['IdCargoActualEdit'];

					$update 	= $conexion->updateEditUser($id_datos_empleados,$nombreEdit,$apellidoEdit,$cedulaEdit,$genero_edit,$cargoEdit,$servicioEdit,$campanaEdit_,$rotacionEdit,$turnoEdit,$supervisorEdit, $valorEdit, $supervisorEditNuevo, $IdCargoActualEdit);
					
					if ($update){
						$json['response'] = 'true';
						echo json_encode($json);
					}else{
						$json['response'] = 'false';
						echo json_encode($json);
					}/**/
				break;

		#----------------------------------------------------------
				case 'datosUser':
					$consulta1 = $conexion->editUser($_POST['idUser']);
					if ($consulta1){
						$json['response'] = 'true';
						$json['id'] 		= $consulta1[0]['id_datos_empleados'];
						$json['nombre'] 	= $consulta1[0]['nombre'];
						$json['apellido'] 	= $consulta1[0]['apellido'];
						$json['cargo'] 		= $consulta1[0]['cargo'];
						echo json_encode($json);
					}else{
						$json['response'] = 'false';
						echo json_encode($json);
					}	
				break;
		#------------------------------------------------------------------------------------------------------------------------------	
				case 'registroDeleteUser':
					$aa =	$_POST['id'];
					$bb =	$_POST['razon'];
					$cc =	$_POST['observacion'];
					$dd = 	date("Y-m-d");
						$valorEdit 				= $_POST['valorEdit'];
						$supervisorDeletNuevo 	= $_POST['supervisorDeletNuevo'];
						$supervisorDeletActual 	= $_POST['supervisorDeletActual'];

					$delete = $conexion->registroDeleteUser($aa, $bb, $cc, $dd, $valorEdit, $supervisorDeletNuevo);
					
					if ($delete){
						$json['response'] = 'true';
						$json['queryn'] = "UPDATE datos_empleados SET supervisor =".$supervisorDeletNuevo."  WHERE supervisor =".$aa;
						echo json_encode($json);
					}else{
						$json['response'] = 'false';
						$json['queryn'] = "UPDATE datos_empleados SET supervisor =".$supervisorDeletNuevo."  WHERE supervisor =".$aa;
						echo json_encode($json);
					}/**/
				break;
		#------------------------------------------------------------------------------------------------------------------------------	
				case 'UpdatePaswwordUser':
					$aa 		=	$_POST['id'];
					$clave 		=	'86467459b686b3ebd139eae822b4ceab';
					$update_ 	= 	$conexion->ReinicioPasswordUser($aa, $clave);
					
					if ($update_){
						$json['response'] = 'true';
						echo json_encode($json);
					}else{
						$json['response'] = 'false';
						echo json_encode($json);
					}/**/
				break;
		#------------------------------------------------------------------------------------------------------------------------------	
		#------------------------------------------------------------------------------------------------------------------------------	
				case 'indexEgresado':
					$listUserEgrasado = $conexion->listUserEgrasado();
					include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'usuarios/listUserEgrasado.php');
					include(PUBLIC_DIR.'general/footer.html');
				break;
		#-------------------------------------------------------------------------------------------
		#-------------------------------------------------------------------------------------------
				case 'descargaReporteEgresado':	
					header("Content-type: application/vnd.ms-excel");
					header("Content-Disposition: attachment; filename=Egresado.xls");
					
					$listUserEgrasado = $conexion->listUserEgrasado();

					echo '
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
			                    <thead>
			                      <tr>
			                        <th>#</th>
			                        <th>Nombre</th>
			                        <th>Cedula</th>
			                        <th>Cargo</th>
			                        <th>Servicio</th>
			                        <th>Rotacion</th>
			                        <th>Turno</th>
			                        <th>Motivo</th>
			                        <th>Observaciones</th>
			                      </tr>
			                    </thead>
			                    <tbody>';

		            	if ($listUserEgrasado) {
		              		foreach ($listUserEgrasado as $consult) {

			        echo ' 		<tr>
					              <td>'.$consult['id_datos_empleados'].'</td>
					              <td>'.$consult['apellido']. ' '. $consult['nombre']. '</td>
					              <td>'.$consult['cedula'].'</td>
					              <td>'.$consult['cargo'].'</td>
					              <td>'.$consult['servicio'].'</td>
					              <td>'.$consult['rotacion'].'</td>
					              <td>'.$consult['turno'].'</td>
					              <td>'.$consult['motivo'].'</td>
					              <td>'.$consult['observacion'].'</td>
					            </tr>';
		          			} 
		          		}
		        	echo '		</tbody>
		      				</table>';				
		break;
		#----------------------------------------------------------
		#----------------------------------------------------------
				case 'datosUserEgresados':
					$consulta1 = $conexion->EditFormReincorUser($_POST['idUser']);
					if ($consulta1){
						$json['response'] = 'true';
						$json['id'] 		= $consulta1[0]['id_datos_empleados'];
						$json['nombre'] 	= ucwords(strtolower($consulta1[0]['nombre']));
						$json['apellido'] 	= ucwords(strtolower($consulta1[0]['apellido']));
						echo json_encode($json);
					}else{
						$json['response'] = 'false';
						echo json_encode($json);
					}	
				break;
		#-----------------------------------------------------------------------------------------------------------------------
				case 'FormReincorUser':
					$id_user = $_GET['id'];
					$consulta5 	= $conexion->campanas();
					$consulta1  = $conexion->cargos();
					$consulta2  = $conexion->servicios();
					$consulta3  = $conexion->rotacions();
					$consulta4  = $conexion->turnos();
					$listSuperv = $conexion->listSupervisor();

					$registro = $conexion->EditFormReincorUser($id_user);
					if ($registro) {
						foreach ($registro as $u) {
							$id_datos_empleados = $u['id_datos_empleados'];
							$nombre 			= $u['nombre'];
							$apellido 			= $u['apellido'] ;
							$cedula 			= $u['cedula'];
							$genero 			= $u['genero'];
							$cargo 				= $u['cargo'];
							$fecha_ingreso 		= $u['fecha_ingreso'];
							$servicio 			= $u['servicio'];
							$campana 			= $u['campana'];
							$rotacion			= $u['rotacion'];
							$turno 				= $u['turno'];

							$users				= $u['users'];
							$passwords 			= $u['passwords'];
							$IDsupervidor		= $u['supervisor'];
							$estatus 			= $u['estatus'];
						}
					}	
					include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'usuarios/FormReincorUser.php');
					include(PUBLIC_DIR.'general/footer.html');/**/

				break;
		#------------------------------------------------------------------------------------------------------------------------------	
				case 'updateEditReincorpo':
					$id_datos_empleados = $_POST['id_datos_empleados'];
					$nombreEdit 		= $_POST['nombreEdit'];
					$apellidoEdit 		= $_POST['apellidoEdit'];
					$cedulaEdit 		= $_POST['cedulaEdit'];
					$genero_edit 		= $_POST['genero_edit'];
					$cargoEdit 			= $_POST['cargoEdit'];
					$fechaIngreEdit 	= $_POST['fechaIngreEdit'];
					$servicioEdit 		= $_POST['servicioEdit'];
					$campanaEdit_ 		= $_POST['campanaEdit_'];
					$rotacionEdit 		= $_POST['rotacionEdit'];
					$turnoEdit 			= $_POST['turnoEdit'];
					$supervisorEdit 	= $_POST['supervisorEdit'];
					$usersEdit 			= $_POST['usersEdit'];
					$passsEdit 			= $conexion->Encrypt('timer12345++');
					
					$fehaHoy =  date("Y-m-d");
					$horaHoy =	date("H:i:s");
					
					$insertHistRein = $conexion->inserReincorp($id_datos_empleados, $nombreEdit, $apellidoEdit, $cedulaEdit, $genero_edit, $cargoEdit, $fechaIngreEdit, $servicioEdit,$campanaEdit_ , $rotacionEdit, $turnoEdit, $supervisorEdit, $usersEdit, $passsEdit);
						
						if ($insertHistRein){
							$json['response'] = 'true';
							echo json_encode($json);
						}else{
							$json['response'] = 'false';
							echo json_encode($json);
						}
				break;	

			#------------------------------------------------------------------------------------------------------------------------------	
				case 'selectCampanasM':
					$id_servicio =	$_POST['id_servicio'];
					$campanas 	=	$conexion->selectcamapanas($id_servicio);
					if ($campanas) {
				      	echo '
				            	<select required class="form-control campMuch" id="campana_indexM_[]" name="campana_indexM" required>';
				        echo '			<option value="0">Seleccione...</option>';
				                  	foreach ($campanas as $key) {
				        echo '			<option value="'.$key['abrev_campana'].'">'.$key['name_campana'].' ('.$key['abrev_campana'].')</option>';
				                  			}		
				        echo '	</select><br>';
				    }else{  
			      		echo '	<select disabled class="form-control" id="campana_indexM_" name="campana_indexM" required>';
			            echo ' 		<option  value="0">No hay resultados...</option>';
			      		echo '	</select><br>';
			    	}
				break;
			#------------------------------------------------------------------------------------------------------------------------------	
					
		#------------------------------------------------------------------------------------------------------------------------------	
				/*case 'selectCampanas':
					$id_servicio =	$_POST['id_servicio'];
					$campanas 	=	$conexion->selectcamapanas($id_servicio);
					if ($campanas) {
				      	echo '
				            	<select required class="form-control" id="campana_index" name="campana_index" required>';
				        echo '			<option value="0">Seleccione...</option>';
				                  	foreach ($campanas as $key) {
				        echo '			<option value="'.$key['abrev_campana'].'">'.$key['name_campana'].' ('.$key['abrev_campana'].')</option>';
				                  			}		
				        echo '	</select><br>';
				    }else{
			      		echo '	<select disabled class="form-control" id="campana_index" name="campana_index" required>';
			            echo ' 		<option  value="0">No hay resultados...</option>';
			      		echo '	</select><br>';
			    	}
				break;*/
				//ESTEEE
				case 'selectCampanas':
					$id_servicio 	=	$_POST['id_servicio'];
					$nombreService 	=	$_POST['nombreService'];

					$campanas 		=	$conexion->selectcamapanas($id_servicio);
					$supervisors 	=	$conexion->selectSuperv($nombreService);

					if ($campanas) {
				      	$a  =       '   <select required class="form-control" id="campana_index" name="campana_index" required>';
				        $a 	=	$a. '			<option value="0">Seleccione...</option>';
				                  			foreach ($campanas as $key) {
				        $a 	=	$a. '			<option value="'.$key['abrev_campana'].'">'.$key['name_campana'].' ('.$key['abrev_campana'].')</option>';
				                  			}		
				        $a 	=	$a. '	</select><br>';

				        //_____________________________________________
				        $b  ='			<select required class="form-control" id="supervisor_index" name="supervisor_index" required>';
				        $b 	=	$b. '			<option value="0">Seleccione...</option>';
				                  			foreach ($supervisors as $keys) {
				        $b 	=	$b. '			<option value="'.$keys['id_datos_empleados'].'">'.$keys['apellido'].' '.$keys['nombre'].'</option>';
				                  			}		
				        $b 	=	$b. '	</select><br>';

				        //__________________________
				        $json['blockCampana'] 		=	$a;
				        $json['blockSuperviServi'] 	=	$b;

				    }else{
			      		$a  =		'	<select disabled class="form-control" id="campana_index" name="campana_index" required>';
			            $a 	=	$a. ' 		<option  value="0">No hay resultados...</option>';
			      		$a 	=	$a. '	</select><br>';

			      		//_____________________________________________
				        $b  ='			<select required class="form-control" id="supervisor_index" name="supervisor_index" required>';
				        $b 	=	$b. '			<option value="0">Seleccione...</option>';
				                  			foreach ($supervisors as $keys) {
				        $b 	=	$b. '			<option value="'.$keys['id_datos_empleados'].'">'.$keys['apellido'].' '.$keys['nombre'].'</option>';
				                  			}		
				        $b 	=	$b. '	</select><br>';

				        //__________________________
				        $json['blockCampana'] 		=	$a;
				        $json['blockSuperviServi'] 	=	$b;
			    	}

			    	echo json_encode($json);
				break;
			#-------------------------------------------------------------------------------------------------------------------------------
				case 'HistorySesionAgente';
					include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'usuarios/historySesionAgente.php');
					include(PUBLIC_DIR.'general/footer.html');/**/
				break;
				#-------------------------------------------------------------------------------------------	
				case 'busquedaAgenteHistory':
					$servicioSesion = $_SESSION['id_servicio'];
					$cargoUSer 		= $_SESSION['cargo'];
					$texto 			= $_POST['texto'];
					$consultar 		= $conexion->busquedaAgnte($servicioSesion, $cargoUSer, $texto);

					if ($consultar) {

						$json['result'] = '
				    		<select class="form-control" name="agenteBusque_" id="agenteBusque_" required>';
              						foreach ($consultar as $listUsuarios) {
                		$json['result'] = $json['result'].' 	<option value="'.$listUsuarios["id_datos_empleados"].'">'.$listUsuarios["apellido"].' '.$listUsuarios["nombre"].'</option>';
              						} 
            			$json['result'] = $json['result']. '	</select>';

            			$json['response'] = 'true';
						echo json_encode($json);

					}else{ 
						$json['result'] = ' ';
						$json['response'] = 'false';
						echo json_encode($json);
					}
				break;
			#-------------------------------------------------------------------------------------------------------------------------------
				case 'consulta_historySesion':
					$as  = 	$_POST['fecha_d'];   
					$bs  = 	$_POST['fecha_h'];
					$cs  = 	$_POST['agenteBusque_'];

					//echo $as. ' --> '. $bs. ' --> '. $cs.'<br>';
					//$as = $_POST['agente_'];+
					$listSupervisor = $conexion->listSupervisor();
				    $consultar 	= $conexion->consultarxSesionAgente($as, $bs, $cs);

				    if ($consultar) { 
				    	$idEmpleado = $consultar[0]['id_datos_empleados']; 
				    	$apellido   = $consultar[0]['apellido']; 
				    	$name = $consultar[0]['nombre']; 
				    
				    }else{ 
				    	$idEmpleado = '';
				    	$apellido   = '';
				    	$name = '';
				    }
				    
				    include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'usuarios/historySesionAgente2.php');
					include(PUBLIC_DIR.'general/footer.html');	/**/
				break;
			#-------------------------------------------------------------------------------------------
			#-------------------------------------------------------------------------------------------
				case 'descargaReportehistorySesion':	
					header("Content-type: application/vnd.ms-excel");
					header("Content-Disposition: attachment; filename=ReporteHistorySesion.xls");
					
					$as  = 	$_GET['desde'];  
					$bs  = 	$_GET['hasta'];
					$listSupervisor = $conexion->listSupervisor();
					$historySesion = $conexion->HistorySesionGeneral($as, $bs);

					echo '
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
			                    <thead>
			                      <tr>
			                        <th>#</th>
			                        <th>Nombre y Apellido</th>
			                        <th>Cedula</th>
			                        <th>Cargo</th>
			                        <th>Supervisor</th>
			                        <th>Servicio</th>
			                        <th>Campaña</th>
			                        <th>Rotacion</th>
			                        <th>Turno</th>
			                        <th>Hora Inicio Sesion</th>
			                        <th>Hora Fin Sesion</th>
			                        <th>Fecha Sesion</th>
			                      </tr>
			                    </thead>
			                    <tbody>';

		            	if ($historySesion) {
		              		foreach ($historySesion as $consult) {

			        echo ' 		<tr>
					            	<td> <center>'.$consult['id_datos_empleados'].'</center></td>
					              	<td> <center>'.$consult['apellido']. ' '. $consult['nombre'].'</center></td>
					              	<td> <center>'.$consult['cedula'].'</center></td>
					              	<td> <center>'.$consult['cargo'].'</center></td>';
					              	if ($consult['supervisor'] != 0) {
										for ($d=0; $d < count($listSupervisor) ; $d++) { 
											if ( $consult['supervisor'] == $listSupervisor[$d]['id_datos_empleados']) {
					echo 						'<td>'. utf8_decode($listSupervisor[$d]['nombre']).' '.utf8_decode($listSupervisor[$d]['apellido']).'</td>';
											}
										}
									}else{
					echo				'<td> </td>';
									}

					echo           	'
									<td> <center>'.$consult['servicio'].'</center></td>
					              	<td> <center>'.$consult['campana'].'</center></td>
					              	<td> <center>'.$consult['rotacion'].'</center></td>
					              	<td> <center>'.$consult['turno'].'</center></td>
					              	<!--<td> <center>'.$consult['idHistSesion'].'</center></td>-->
					              	<td> <center>'.$consult['horaInicio'].'</center></td>
					              	<td> <center>'.$consult['horaFin'].'</center></td>
					              	<td> <center>'.$consult['fechaHistori'].'</center></td>
					            </tr>';
		          			} 
		          		}
		        	echo '		</tbody>
		      				</table>';				
				break;
			#-------------------------------------------------------------------------------------------
			#-------------------------------------------------------------------------------------------------------------------------------			
				default:
						header('location:'.HTML_DIR.'error.html');
				break;
				}
			}
	}//
//}
?>