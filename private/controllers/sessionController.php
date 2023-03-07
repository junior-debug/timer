<?php
include_once(MODEL_DIR.'sessionModel.php');
$conexion   = new database();
if (isset($_GET['mode'])) {
	switch ($_GET['mode']) {
		case 'login': 
			$u = $_POST['user'];
			$c = $conexion->sessionLogin($u);  
			if (!empty($c)) {
				$user = $c[0][4];
				echo 1;
			}
			else{
				echo 2;
			}
		break;
	#_______________________________________________________________
		case 'login_':
		$u = $_POST['user'];
		$p = $_POST['pass'];
		$p_md5 	= $conexion->Encrypt($p);

		$fecha 		= 	date("Y-m-d");
		$hora 		=	date("H:i:s");
		//$p_generico = 123456;
		//$p_md5 = md5($p);
 		//echo $u. '--> '.$p.' <br> ';

		$c = $conexion->sessionNew($u,$p_md5);
		if (!empty($c)) {
			if($c[0][8] == 'INACTIVO'){
				echo 3;
			}else{
				session_start();
				$_SESSION['id']				= $c[0][0];
				$_SESSION['nombre'] 		= $c[0][1];
				$_SESSION['apellido']		= $c[0][2];
				$_SESSION['genero']			= $c[0][4];
				$_SESSION['user'] 			= $c[0][12];
				$_SESSION['cargo']			= $c[0][5];
				$_SESSION['id_servicio']	= $c[0][8]; //realmente es servicio ose nombre
				$_SESSION['campana']		= $c[0][9]; 
				$_SESSION['estatusClave']	= $c[0][16]; 
				$_SESSION['IdServices']		= $c[0][17];  // es el ID, el numero

				$divisorService = explode(",", $_SESSION['id_servicio']);
					$_SESSION['totalService'] = count($divisorService);

				if ( count($divisorService) === 3) {

					$arregloServs = array($divisorService[0],$divisorService[1],$divisorService[2]);
					for ($i=0; $i < count($arregloServs) ; $i++) { 
						//echo ' sssssi '. count($arregloServs) . '  --> '.$arregloServs[$i].' <--- <br>';
						$consulta1   = $conexion->idServicios($arregloServs[$i]);
						$idsServic[] = $consulta1[0]['idServicio'];
					}
					
					$_SESSION['serviceP1'] = $divisorService[0];
					$_SESSION['serviceP2'] = $divisorService[1];
					$_SESSION['serviceP3'] = $divisorService[2];

					$_SESSION['idServi1'] = $idsServic[0];
					$_SESSION['idServi2'] = $idsServic[1];
					$_SESSION['idServi3'] = $idsServic[2];

					//echo ' Controller: '.count($divisorService). ' ==>** '. $divisorService[0]. ' --> '.$divisorService[1]. ' --> '.$divisorService[2];



				}else if ( count($divisorService) === 2) {
					$arregloServs = array($divisorService[0],$divisorService[1],$divisorService[2]);
					for ($i=0; $i < count($arregloServs) ; $i++) { 
						//echo ' sssssi '. count($arregloServs) . '  --> '.$arregloServs[$i].' <--- <br>';
						$consulta1   = $conexion->idServicios($arregloServs[$i]);
						$idsServic[] = $consulta1[0]['idServicio'];
					}

					$_SESSION['idServi1'] = $idsServic[0];
					$_SESSION['idServi2'] = $idsServic[1];
					$_SESSION['idServi3'] = 0;

					$_SESSION['serviceP1'] = $divisorService[0];
					$_SESSION['serviceP2'] = $divisorService[1]; 
					$_SESSION['serviceP3'] = 0;
					//echo ' Controller: '.count($divisorService). ' ==>** '. $divisorService[0]. ' --> '.$divisorService[1];

				}else if ( count($divisorService) === 1) {
					$arregloServs = array($divisorService[0],$divisorService[1],$divisorService[2]);
					for ($i=0; $i < count($arregloServs) ; $i++) { 
						//echo ' sssssi '. count($arregloServs) . '  --> '.$arregloServs[$i].' <--- <br>';
						$consulta1   = $conexion->idServicios($arregloServs[$i]);
						$idsServic[] = $consulta1[0]['idServicio'];
					}
					
					$_SESSION['idServi1'] = $idsServic[0];
					$_SESSION['idServi2'] = 0;
					$_SESSION['idServi3'] = 0;

					$_SESSION['serviceP1'] = $divisorService[0];
					$_SESSION['serviceP2'] = 0;
					$_SESSION['serviceP3'] = 0;
					//echo ' Controller: '.count($divisorService). ' ==>** '. $divisorService[0];

				}else{
					$totalService = 0;
					$serviceP1 = 0;
					$serviceP2 = 0;
					$serviceP3 = 0;
					$idServi1 = 0;
					$idServi2 = 0;
					$idServi3 = 0;
				}
	
	
				if($p == '123456'){
					echo 3;
				}else{
					$consultarClaveCambio   = $conexion->consultarUserClave($_SESSION['id']);
 
					if ($consultarClaveCambio){
						if ($consultarClaveCambio[0]['estatusClave'] == 0) { //cambio de clave
							echo 99;

						}else{/**/
							$consult = $conexion->updateEstatusSesion($_SESSION['id']);
							//ESTO ES PARA REGISTRO EN HISTORICO DE SESION
							if($_SESSION['cargo'] == 'ADMINISTRADOR' OR $_SESSION['cargo'] == 'CLIENTE' OR $_SESSION['cargo'] == 'SUPERVISOR' OR $_SESSION['cargo'] == 'ANALISTA' OR $_SESSION['cargo'] == 'COORDINADOR' OR $_SESSION['cargo'] == 'GERENTE'){
								$consultar_2 = $conexion->consultarHistorico($_SESSION['id'], $fecha);
								if ($consultar_2) {
									$consult__ = $conexion->updateEstatusSesionHistoriActiva($consultar_2[0]['idHistSesion'], $consultar_2[0]['horaInicio'], $_SESSION['id']);
								}else{
									$registroHistori 	= $conexion->registroTimerHistori($_SESSION['id'], $fecha, $hora,1);
								}
 
							}

							//ESTO ES PARA SABER A QUE VISTA REDIRECCIONAR
							if($_SESSION['cargo'] == 'ADMINISTRADOR' OR $_SESSION['cargo'] == 'CLIENTE' OR $_SESSION['cargo'] == 'COORDINADOR' OR $_SESSION['cargo'] == 'GERENTE'){
								echo 1; 

							}else if($_SESSION['cargo'] == 'OPERADOR'){
								$consultar   = $conexion->consultarRegistro($_SESSION['id'], $fecha);
								$consultar_2 = $conexion->consultarHistorico($_SESSION['id'], $fecha);

								if ($consultar_2) {
									$consult__ = $conexion->updateEstatusSesionHistoriActiva($consultar_2[0]['idHistSesion'], $hora, $_SESSION['id']);
								}

								if ($consultar) {						
									$registroHistori 	= $conexion->registroTimerHistori($_SESSION['id'], $fecha, $hora,1);
									echo 4;
								}else{
									$registroHistori 	= $conexion->registroTimerHistori($_SESSION['id'], $fecha, $hora,2);
									echo 4;
								}
								
							}else if( $_SESSION['cargo'] == 'SUPERVISOR' ){
								echo 5;
							
							}else if( $_SESSION['cargo'] == 'ANALISTA'){
								echo 6;
							}else{
								//echo 1;
							}
						}
					}	
				}
			}
		}else{
			echo 2;
		}
		break;
	#_________________________________________________________________________________
		case 'disconect':
			include(PUBLIC_DIR.'general/session.php');
			$idUsuario  = $_SESSION['id'];
			$fecha      = date("Y-m-d");
			$hora 		= date("H:i:s");

			$consultar2  = $conexion->consultarRegistroHistoric($idUsuario, $fecha);
			$idRegisHist =$consultar2[0]['idHistSesion'];
			$registroHistori = $conexion->updateTimerHistoriFIN($idRegisHist, $hora);
			$consult = $conexion->updateEstatusSesionDos($idUsuario);
			session_destroy();
			header('location:index.php');
		break;
	#_________________________________________________________________________________
	#________________________________________________________________________________
		case 'disconect_passwords_':
			include(PUBLIC_DIR.'general/session.php');
			$idUsuario  = $_SESSION['id'];
			$consult = $conexion->updateEstatusSesionDos($idUsuario);

			session_destroy();
			header('location:index.php');
		break;
	#________________________________________________________________________________
	#________________________________________________________________________________

		default:
			header('location:'.HTML_DIR.'error.html');
		break;
		}
}
else{
	include(HTML_DIR.'login/index.php');
}