<?php
include(PUBLIC_DIR.'general/session.php');
/*if($_SESSION['type_user'] == 2){
	header("location:?view=contador&mode=index");
}else{*/
	if(empty($_SESSION)){header('location:index.php');}else{
		include_once(MODEL_DIR.'contadorModel.php');
		$conexion = new database();
		if (isset($_GET['mode'])){

			function sumarHoras($horas) {
                $total = 0;
                foreach($horas as $h) {
                    $parts = explode(":", $h);
                    $total += $parts[2] + $parts[1]*60 + $parts[0]*3600;        
                }   
                return gmdate("H:i:s", $total); 
           	}

           	function RestarHoras($horaini,$horafin){
    			$f1 = new DateTime($horaini);
    			$f2 = new DateTime($horafin);
    			$d = $f1->diff($f2);
    			return $d->format('%H:%I:%S');
			}

			switch ($_GET['mode']){

				case 'index':
					$idUsuario 		= 	$_SESSION['id'];    //$_POST['idUsuario'];	
					$fecha 			= 	date("Y-m-d");
					$hora 			=	date("H:i:s");

					//$_SESSION['id_servicio']     $_SESSION['campana']
					$servicioUsers 		=	$_SESSION['id_servicio']; //'SIMPLE TV'; 				//$_SESSION['id_servicio'];
					$campanaUsers 		=	$_SESSION['campana']; //'RRSS2'; 				//$_SESSION['campana'];

					$consultarSerCamp 	= 	$conexion->consultarSerCamp($servicioUsers);

					$consultar = $conexion->consultarRegistro(/*1, '2021-05-04'*/$idUsuario, $fecha);

					if ($consultar) {
						$timerReady = $consultar[0]['tiempo_ready']; 

						$timer1 = explode(":", $consultar[0]['tiempo_ready']);
							$h1 = ($timer1[0] != '00' && $timer1[0] < 10) ? $timer1[0] : $timer1[0];  
							$m1 = ($timer1[1] != '00' && $timer1[1] < 10) ? $timer1[1] : $timer1[1];   
							$s1 = ($timer1[2] != '00' && $timer1[2] < 10) ? $timer1[2] : $timer1[2]; 

						$timer2 = explode(":", $consultar[0]['break']);
							$h2 = ($timer2[0] != '00' && $timer2[0] < 10) ? $timer2[0] : $timer2[0]; 
							$m2 = ($timer2[1] != '00' && $timer2[1] < 10) ? $timer2[1] : $timer2[1];   
							$s2 = ($timer2[2] != '00' && $timer2[2] < 10) ? $timer2[2] : $timer2[2];

						$timer3 = explode(":", $consultar[0]['bath']);
							$h3 = ($timer3[0] != '00' && $timer3[0] < 10) ? $timer3[0] : $timer3[0];  
							$m3 = ($timer3[1] != '00' && $timer3[1] < 10) ? $timer3[1] : $timer3[1];   
							$s3 = ($timer3[2] != '00' && $timer3[2] < 10) ? $timer3[2] : $timer3[2];

						$timer4 = explode(":", $consultar[0]['entrenamiento']); 
							$h4 = ($timer4[0] != '00' && $timer4[0] < 10) ? $timer4[0] : $timer4[0];  
							$m4 = ($timer4[1] != '00' && $timer4[1] < 10) ? $timer4[1] : $timer4[1];   
							$s4 = ($timer4[2] != '00' && $timer4[2] < 10) ? $timer4[2] : $timer4[2];

						$timer5 = explode(":", $consultar[0]['feek_back']);
							$h5 = ($timer5[0] != '00' && $timer5[0] < 10) ? $timer5[0] : $timer5[0];  
							$m5 = ($timer5[1] != '00' && $timer5[1] < 10) ? $timer5[1] : $timer5[1];   
							$s5 = ($timer5[2] != '00' && $timer5[2] < 10) ? $timer5[2] : $timer5[2];

						$timer6 = explode(":", $consultar[0]['llamada_saliente']);
							$h6 = ($timer6[0] != '00' && $timer6[0] < 10) ? $timer6[0] : $timer6[0];  
							$m6 = ($timer6[1] != '00' && $timer6[1] < 10) ? $timer6[1] : $timer6[1];   
							$s6 = ($timer6[2] != '00' && $timer6[2] < 10) ? $timer6[2] : $timer6[2];

							/*echo $h1. ' --> '.$m1 .' --> '.$s1.'<br>';
							echo $h2. ' --> '.$m2 .' --> '.$s2.'<br>';
							echo $h3. ' --> '.$m3 .' --> '.$s3.'<br>';
							echo $h4. ' --> '.$m4 .' --> '.$s4.'<br>';
							echo $h5. ' --> '.$m5 .' --> '.$s5.'<br>';
							echo $h6. ' --> '.$m6 .' --> '.$s6.'<br>'; */ 
				
					}else{

						$timerReady = '00:00:00';
						$h1 = $m1 = $s1 = '00';
						$h2 = $m2 = $s2 = '00';
						$h3 = $m3 = $s3 = '00';
						$h4 = $m4 = $s4 = '00';
						$h5 = $m5 = $s5 = '00';
						$h6 = $m6 = $s6 = '00';
					}
					include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'contador/index.php'); 
					include(PUBLIC_DIR.'general/footer.html');/**/

				break;

				#_____________________________________________________________
				case 'registroCronometro':
					$time 		= $_POST['time'];		 	
					$time_Bre 	= $_POST['time_Bre']; 		
					$time_Entr 	= $_POST['time_Entr'];
					$time_FBack = $_POST['time_FBack'];
					$time_Bano 	= $_POST['time_Bano'];
					$time_LLSa 	= $_POST['time_LLSa'];
					$idUsuario 	= $_POST['idUsuario'];   
					$fecha 		= 	date("Y-m-d");
					$hora 		=	date("H:i:s");

					$valorHistoric 	= $_POST['valorHistoric'];
					//______________________________________________
					$campana 		= $_POST['campana'];			
					$hora_inicio 	= $_POST['hora_inicio']; 		
					$hora_final 	= $_POST['hora_final'];
					$duracion 		= RestarHoras($hora_inicio,$hora_final);

					$consultar 	= $conexion->consultarRegistro($idUsuario, $fecha);
					$consultar2 = $conexion->consultarRegistroHistoric($idUsuario, $fecha);

					if ($consultar) {
						$id_registro 	= $consultar[0]['id_registro']; 
						$updateCronometro 	= $conexion->updateCronometro($time, $time_Bre, $time_Entr, $time_FBack, $time_Bano, $time_LLSa, $idUsuario, $fecha, $hora);
                      	if ( $consultar[0]['estatusSesion'] != 2) {
                      		//$estatusSesion_ = $consultar[0]['estatusSesion'];
                      		if ($consultar2) { 
		                      	if ( $consultar2[0]['estatus'] == 1) {

		                      		//$updateCronometro 	= $conexion->updateCronometro($time, $time_Bre, $time_Entr, $time_FBack, $time_Bano, $time_LLSa, $idUsuario, $fecha, $hora);
		                      		$update 			= $conexion->updateTimerHistori($consultar2[0]['idHistSesion'], $hora);
		                      		$json['response'] 		= 'HISTORI';
		                      		$json['idRegisHist'] 	= $consultar2[0]['idHistSesion'];
			                      	echo json_encode($json);

		                      	}
		                      	if ( $consultar2[0]['estatus'] == 2) {
		                      		//$updateCronometro 	= $conexion->updateCronometro($time, $time_Bre, $time_Entr, $time_FBack, $time_Bano, $time_LLSa, $idUsuario, $fecha, $hora);
		                      		$registroHistori 	= $conexion->registroTimerHistori($idUsuario, $fecha, $hora);
		                      		$json['response'] 		= 'HISTORI';
									$json['idRegisHist'] 	= $registroHistori[0]['idUltimoHisto'];
			                      	echo json_encode($json);
		                      	}

							}else{
								//$updateCronometro = $conexion->updateCronometro($time, $time_Bre, $time_Entr, $time_FBack, $time_Bano, $time_LLSa, $idUsuario, $fecha, $hora);
								$registroHistori  = $conexion->registroTimerHistori($idUsuario, $fecha, $hora);

								$json['response'] 		= 'HISTORI';
								$json['idRegisHist'] 	= $registroHistori[0]['idUltimoHisto'];
		                      	echo json_encode($json);
							}

                      	}else{
                      		//$consultar[0]['estatusSesion'] CUANDO es igual a 2, significa cierre de sesion
                      		//echo 'FIN';
                      		//$updateCronometro 	= $conexion->updateCronometro($time, $time_Bre, $time_Entr, $time_FBack, $time_Bano, $time_LLSa, $idUsuario, $fecha, $hora);
                      		$registroHistori  	= $conexion->updateTimerHistoriFIN($valorHistoric, $hora);
                      		$registro_ 			= $conexion->registroPorCambioCampa($campana, $hora_inicio, $hora_final,$duracion, $idUsuario, $id_registro);

                      		$json['response'] = 'FIN';
                      		echo json_encode($json);
                      	}					
					}else{
						$registro = $conexion->registroCronometro($idUsuario, $fecha, $hora);
					}
					
				break;
				#_____________________________________________________________
				/*case 'registroHistori':
					$idUsuario 	= $_POST['idUsuario'];   
					$fecha 		= 	date("Y-m-d");
					$hora 		=	date("H:i:s");
					$valorHistoric 	= $_POST['valorHistoric'];
					
					$consultar2 = $conexion->consultarRegistroHistoric(/1, '2021-06-22'/$idUsuario, $fecha);
					//echo ' estatus '.$consultar2[0]['estatus'].'<br>';
					$consultar = $conexion->consultarRegistro(/1, '2021-05-04'/$idUsuario, $fecha);

					if ($consultar) {	
						if ( $consultar[0]['estatusSesion'] != 2) {
							if ($consultar2) { 
		                      	if ( $consultar2[0]['estatus'] == 1) {
		                      		$update = $conexion->updateTimerHistori($valorHistoric, $hora);

		                      	}
		                      	if ( $consultar2[0]['estatus'] == 2) {
		                      		$registroHistori = $conexion->registroTimerHistori($idUsuario, $fecha, $hora);
		                      		$json['response'] 		= 'HISTORI';
									$json['idRegisHist'] 	= $registroHistori[0]['idUltimoHisto'];
			                      	echo json_encode($json);
		                      	}

							}else{
								$registroHistori = $conexion->registroTimerHistori($idUsuario, $fecha, $hora);
								//$registroHistori = $conexion->updateTimerHistoriFIN($valorHistoric, $hora);

								$json['response'] 		= 'HISTORI';
								$json['idRegisHist'] 	= $registroHistori[0]['idUltimoHisto'];
		                      	echo json_encode($json);
							}
						}
					}
					
				break;*/

				#_____________________________________________________________
				case 'registroCronometroFIN':
					$time 		= $_POST['time'];			 
					$time_Bre 	= $_POST['time_Bre']; 		
					$time_Entr 	= $_POST['time_Entr'];
					$time_FBack = $_POST['time_FBack'];
					$time_Bano 	= $_POST['time_Bano'];
					$time_LLSa 	= $_POST['time_LLSa'];
					$idUsuario 	= $_POST['idUsuario'];   
					$fecha 	= 	date("Y-m-d");  //'2021-05-04';
					$hora 	=	date("H:i:s");
					//______________________________________________

					$campana 		= $_POST['campana'];			
					$hora_inicio 	= $_POST['hora_inicio']; 		
					$hora_final 	= $_POST['hora_final'];
					$duracion 		= RestarHoras($hora_inicio,$hora_final); 		//$_POST['duracion'];
					//$id_registro 	= $_POST['id_registro']; 

					//echo $time. ' --> '.$time_Bre. ' --> '.$time_Entr. ' --> '.$time_FBack. ' --> '.$time_Bano. ' --> '.$time_LLSa. ' --> '.$idUsuario. ' --> '.$fecha. ' --> '.$hora. ' --> '.$idRegisHist. ' --> '.$campana. ' --> '.$hora_inicio. ' --> '.$hora_final. ' --> '.$duracion;

					$consultar = $conexion->consultarRegistro($idUsuario, $fecha); 
					$consultar2 = $conexion->consultarRegistroHistoric($idUsuario, $fecha);

					if ($_POST['idHistori']) {
						$idRegisHist = $_POST['idHistori'];
					}else{
						$idRegisHist = $consultar2[0]['idHistSesion'];
					}

					if ($consultar) {    
						//echo 'update fin'; 
						$id_registro 	= $consultar[0]['id_registro'];                   	
						
						$update = $conexion->updateCronometroFin($time, $time_Bre, $time_Entr, $time_FBack, $time_Bano, $time_LLSa, $idUsuario, $fecha, $hora);
						
						$registro_ = $conexion->registroPorCambioCampa($campana, $hora_inicio, $hora_final,$duracion, $idUsuario, $id_registro);
						
						$registroHistori = $conexion->updateTimerHistoriFIN($idRegisHist, $hora);
						 
					}else{  
						// echo 'registro fin'; 
						//si llega a existir este caso, significa que la funcion de guardar constantenmente, por un momento fallo  
						$registro 		= $conexion->registroCronometro($idUsuario, $fecha, $hora);
						$id_registro 	= $registro[0]['idUltimo']; 

						$registro_ 	= $conexion->registroPorCambioCampa($campana, $hora_inicio, $hora_final,$duracion, $idUsuario, $id_registro);
					}/**/
	
				break;

				#_____________________________________________________________
				case 'registroPorCambioCampa':
					$campana 		= $_POST['campana'];			
					$hora_inicio 	= $_POST['hora_inicio']; 		
					$hora_final 	= $_POST['hora_final'];
					$duracion 		= RestarHoras($hora_inicio,$hora_final); 		//$_POST['duracion'];
					$id_usuario 	= $_POST['id_usuario'];
					//$id_registro 	= $_POST['id_registro']; 
					$fecha 	= 	date("Y-m-d");
					$hora 	=	date("H:i:s");

					//campana:varCampAntiguo, hora_inicio:valorTimeAnterior, hora_final:valorTimeActual, duracion:sumarTime,id_usuario:$('#idUsuario').val(), id_registro:1
					
					$consultar = $conexion->consultarRegistro(/*1, '2021-05-04'*/$id_usuario, $fecha);
					
					if ($consultar) {                 	
						$registro_ = $conexion->registroPorCambioCampa($campana, $hora_inicio, $hora_final,$duracion, $id_usuario, $consultar[0]['id_registro'] /*, $id_registro*/);
						 
					}else{   
						//si llega a existir este caso, significa que la funcion de guardar constantenmente, por un momento fallo
						$registro_ = $conexion->registroPorCambioCampa($campana, $hora_inicio, $hora_final,$duracion, $id_usuario, 99/*, $id_registro*/);
					}
				break;

				#_____________________________________________________________
				case 'CambioStatusAuxiliaress':
					$aux 		= $_POST['auxiliar'];
					$id_usuario = $_POST['idUsuario']; 
					$statusAux  = $_POST['estatus'];
					$fecha 		= date("Y-m-d");	

					if ($aux == 'BR') {
						$sqlUpdate = "UPDATE registro SET estatusBR = ".$statusAux." WHERE registro.id_usuario = ".$id_usuario." AND registro.dia = '".$fecha."'";
					
					}else if ($aux == 'BA') {
						$sqlUpdate = "UPDATE registro SET estatusBA = ".$statusAux." WHERE registro.id_usuario = ".$id_usuario." AND registro.dia = '".$fecha."'";

					}else if ($aux == 'EN') {
						$sqlUpdate = "UPDATE registro SET estatusEN = ".$statusAux." WHERE registro.id_usuario = ".$id_usuario." AND registro.dia = '".$fecha."'";
						
					}else if ($aux == 'FB') {
						$sqlUpdate = "UPDATE registro SET estatusFB = ".$statusAux." WHERE registro.id_usuario = ".$id_usuario." AND registro.dia = '".$fecha."'";
						
					}else if ($aux == 'LL') {
						$sqlUpdate = "UPDATE registro SET estatusLL = ".$statusAux." WHERE registro.id_usuario = ".$id_usuario." AND registro.dia = '".$fecha."'";
						
					}else{

					}

					$consultar = $conexion->Update_statusAuxiliaress($sqlUpdate);  //$aux, $id_usuario, $statusAux
				break;/**/
				
				
			
				#----------------------------------------------------------	
				default:
					header('location:'.HTML_DIR.'error.html');
				break;
			}
		}
	}
//}
?>