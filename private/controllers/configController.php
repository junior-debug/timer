<?php
include(PUBLIC_DIR.'general/session.php');
if($_SESSION['cargo'] == 'OPERADOR'){
	header("location:?view=contador&mode=index");
}else{
	if(empty($_SESSION)){header('location:index.php');}else{
		include_once(MODEL_DIR.'configModel.php');
		$conexion = new database();
		if (isset($_GET['mode'])){
			switch ($_GET['mode']){
				#-------------------------------------------------------------------------------------------
				case 'index_':

			 	break;
			 	#-------------------------------------------------------------------------------------------
			 	#-------------------------------------------------------------------------------------------
				case 'posicion_mes':
					if ( $_SESSION['cargo'] == 'ADMINISTRADOR') { /* 1==> ADMIN, 2==> COORDI_CLIENT_ */
						$consulta2 	= $conexion->servicios(1,"valor");
						$consulta3 	= $conexion->list_posicion_mes(1,"valor");

					}else{
						$consulta2 	= $conexion->servicios(2,$_SESSION['id_servicio']);
						$consulta3 	= $conexion->list_posicion_mes(2,$_SESSION['id_servicio']);
					}
					
					include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'config/posicion_mes.php');
					include(PUBLIC_DIR.'general/footer.html');/**/
			 	break;
			 	#-------------------------------------------------------------------------------------------
			 	case 'registro_posiciones':
			 		$cant_posicion_  	= $_POST['cant_posicion_'];
			 		$servicio_posicion_ = $_POST['servicio_posicion_'];
			 		//$campana_index 		= $_POST['campana_index'];
			 		$mes_  				= $_POST['mes_'];
			 		$anio_  			= $_POST['anio_'];
			 		$fehaHoy =  date("Y-m-d");
					//$horaHoy =	date("H:i:s");
					$varibl1 = explode('?/?', $servicio_posicion_);

					$consulta_ 	= $conexion->selectUltimoRegistr($varibl1[1]);
					//echo $consulta_[0]['idPM'];
					//echo $cant_posicion_. ' ==> '.$servicio_posicion_. ' ==> '.$campana_index. ' ==> '.$mes_. ' ==> '.$anio_.'<br>';

					$registro = $conexion->registroPosiciones($cant_posicion_, $mes_, $anio_, $varibl1[1], $fehaHoy, $_SESSION['id'], $consulta_[0]['idPM']);
					header('location:?view=config&mode=posicion_mes');
			 	break;
			 	#-------------------------------------------------------------------------------------------
			 	case 'validarPosiciones':
			 		//$cantidadP_ = $_POST['cantidad_'];
			 		$servicioP_ = $_POST['servicio_'];
			 		$mesP_ 		= $_POST['mes_'];
			 		$anioP_ 	= $_POST['anio_'];
			 		$varibl1 = explode('?/?', $servicioP_);

					$consulta_ = $conexion->validarPosiciones($varibl1[1], $mesP_, $anioP_);
					
					if ($consulta_) {
						$json['response'] = 'true';
						echo json_encode($json);
					}else{
						$json['response'] = 'false';
						echo json_encode($json);
					}
			 	break;
			 	#-------------------------------------------------------------------------------------------
			 	#-------------------------------------------------------------------------------------------
			 	case 'editarPosiciones':
			 		//$cantidadP_ = $_POST['cantidad_'];
			 		$idPM 		= $_POST['idPM'];

					$consulta_ = $conexion->datosPosiciones($idPM);
					
					if ($consulta_) {
						$json['response'] 		= 'true';
						$json['posiciones_'] 	= $consulta_[0]['posicion_'];
						$json['servicios_'] 	= $consulta_[0]['servicio_'];
						$json['mess_'] 			= $consulta_[0]['mes_'];
						$json['years_'] 		= $consulta_[0]['year_'];

						echo json_encode($json);
					}else{
						$json['response'] = 'false';
						echo json_encode($json);
					}
			 	break;
			 	#-------------------------------------------------------------------------------------------
			 	case 'SiEditarPosiciones':
			 		//$cantidadP_ = $_POST['cantidad_'];
			 		$idPM 			= $_POST['idPM'];
			 		$cantidadPM 	= $_POST['cantidad'];


					$consulta_ = $conexion->datosEditPosiciones($idPM, $cantidadPM);
					
					/*if ($consulta_) {
						$json['response'] 		= 'true';
						echo json_encode($json);
					}else{
						$json['response'] = 'false';
						echo json_encode($json);
					}*/
			 	break;
			 	#-------------------------------------------------------------------------------------------
			 	case 'siBorrarPM':
			 		$idPM 			= $_POST['idPM'];
					$consulta_ = $conexion->borrarPosiciones($idPM);
			 	break;

			 	#-------------------------------------------------------------------------------------------
	#----------------------------------------------------------------------------------------------------------------------
				default:
					header('location:'.HTML_DIR.'error.html');
				break;
			}
		}
	} 
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
);
*/
?>