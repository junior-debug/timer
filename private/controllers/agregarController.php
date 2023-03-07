<?php
include(PUBLIC_DIR.'general/session.php');
if($_SESSION['cargo'] == 'OPERADOR'){
	header("location:?view=contador&mode=index");
}else{
	if(empty($_SESSION)){header('location:index.php');}else{
		include_once(MODEL_DIR.'agregarModel.php');
		$conexion = new database();
		if (isset($_GET['mode'])){
			switch ($_GET['mode']){
				#-------------------------------------------------------------------------------------------
				case 'index_':
					$servicios_b2      		= $conexion->servicios();
					$servicios_campana_b2 	= $conexion->servicios_camapanas();

					include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'agregar/new_clientee.php');
					include(PUBLIC_DIR.'general/footer.html');
			 	break;
			 	#-------------------------------------------------------------------------------------------
			 	case 'guardar_servicios':
					$servicios 		= $_POST['name_servicioAgre'];

					if ($servicios) {
						for ($i=0; $i < count($servicios) ; $i++) { 
							$list_service 	= $conexion->validarSerivice($servicios[$i]);
							$contad = 0;
							
							if ($list_service) {
								$contad++;
							}else{
								$consulta 	= $conexion->guardar_servicios($servicios[$i]);
							}
						}
					}

					header('location:?view=agregar&mode=index_');
			 	break;

			 	#-------------------------------------------------------------------------------------------
			 	case 'guardar_campanas':
					$servicios 		= $_POST['servicio_campana'];
					$campanass		= $_POST['name_campanaAgre'];
					$abreviCampana 	= $_POST['abrev_campanaAgre'];

					$contad_ = 0;

					$separa_servicio 	= explode('?/?',$servicios);
					$id_servicioo 		= $separa_servicio[0];
					$name_servicioo 	= $separa_servicio[1];

					

					if ($campanass) {
						for ($i=0; $i < count($campanass) ; $i++) { 
							//echo $campanass[$i]. ' '.$abreviCampana[$i]. ' '.$id_servicioo. ' <br><br>';

							$list_campana 	= $conexion->validarcampana($id_servicioo, $campanass[$i], $abreviCampana[$i]);
							if ($list_campana) {
								$contad_++;

								//echo ' datos duplicados <br>';
							}else{
								$consulta 	= $conexion->guardar_campanass($campanass[$i], $abreviCampana[$i], $id_servicioo);

								//echo ' BIEN <br>';
							}
						}
					}
					if ($contad_ > 0 ) {
						$duplicadous = $contad_;
						$mensaje 	 = 1;
					}else{
						$duplicadous = 0;
						$mensaje 	 = 0;
					}

					header('location:?view=agregar&mode=index_&resultado='.$mensaje.'&resultado1='.$duplicadous);
			 	break;
			 	/*case 'guardar_campanas':
					$servicios 		= $_POST['servicio_campana'];
					$campanass		= $_POST['name_campanaAgre'];
					$abreviCampana 	= $_POST['abrev_campanaAgre'];

					$contad_ = 0;

					$separa_servicio 	= explode('?/?',$servicios);
					$id_servicioo 		= $separa_servicio[0];
					$name_servicioo 	= $separa_servicio[1];

					if ($campanass) {
						for ($i=0; $i < count($campanass) ; $i++) { 
							//echo $campanass[$i]. ' '.$abreviCampana[$i]. ' '.$id_servicioo. ' <br><br>';

							$list_campana 	= $conexion->validarcampana($id_servicioo, $campanass[$i]);
							if ($list_campana) {
								$contad_++;
							}else{
								$consulta 	= $conexion->guardar_campanass($campanass[$i], $abreviCampana[$i], $id_servicioo);
							}
						}
					}
					header('location:?view=agregar&mode=index_');
			 	break;*/
			 	#-------------------------------------------------------------------------------------------
			 	case 'editarCampanass':
					$DatosCampanna    = $conexion->DatosCampana($_GET['id_campana']);

					include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'agregar/edit_campana.php');
					include(PUBLIC_DIR.'general/footer.html');
			 	break;
			 	#-------------------------------------------------------------------------------------------
			 	#-------------------------------------------------------------------------------------------
				case 'informacion_editcampana_':
					//echo $_POST['id_campanaa']. ' --> '.$_POST['name_campanaEdit']. ' --> '.$_POST['abrev_campanaEdit']. ' <br><br>';

					$consulta = $conexion->GuardarDatosCampana($_POST['id_campanaa'], $_POST['name_campanaEdit'], $_POST['abrev_campanaEdit']);

					header('location:?view=agregar&mode=index_');

					/*include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'agregar/edit_campana.php');
					include(PUBLIC_DIR.'general/footer.html');*/
			 	break;
			 	#-------------------------------------------------------------------------------------------
			 	#-------------------------------------------------------------------------------------------
			 	case 'editarServicioos':
					$DatosServicioos    = $conexion->DatosServicio($_GET['id_servicio']);

					include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'agregar/edit_servicio.php');
					include(PUBLIC_DIR.'general/footer.html');
			 	break;
			 	#-------------------------------------------------------------------------------------------
			 	#-------------------------------------------------------------------------------------------
				case 'informacion_editservicio_':
					//echo $_POST['id_service']. ' --> '.$_POST['name_serviceEdit']. ' <br><br>';

					$consulta = $conexion->GuardarDatosServicio($_POST['id_service'], $_POST['name_serviceEdit']);

					header('location:?view=agregar&mode=index_');
			 	break;
			 	#-------------------------------------------------------------------------------------------
			 	#-------------------------------------------------------------------------------------------
			 	case 'borrarServicioss':
					$consulta = $conexion->DeleteServicio($_POST['id_servicio']);
					header('location:?view=agregar&mode=index_');
			 	break;
			 	#-------------------------------------------------------------------------------------------
				case 'borrarCampanass':
					$consulta = $conexion->DeleteCampana($_POST['id_campana']);
					header('location:?view=agregar&mode=index_');
			 	break;

			 	#-------------------------------------------------------------------------------------------
			 	#-------------------------------------------------------------------------------------------
			 	case 'historicoServCampa':
					$hist_servicios_b2      	= $conexion->histo_servicios();
					$hist_servicios_campana_b2 	= $conexion->histo_servicios_camapanas();

					include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'agregar/historicoServCampa.php');
					include(PUBLIC_DIR.'general/footer.html');
			 	break;
			 	#-------------------------------------------------------------------------------------------
			 	case 'activarServicioss':
					$consulta = $conexion->ActivarServicio($_POST['id_servicio']);
					header('location:?view=agregar&mode=index_');
			 	break;
				#-------------------------------------------------------------------------------------------	
			 	case 'activarCampanass':
					$consulta = $conexion->ActivarCampana($_POST['id_campana']);
					header('location:?view=agregar&mode=index_');
			 	break;

				#-------------------------------------------------------------------------------------------
				#-------------------------------------------------------------------------------------------
				#-------------------------------------------------------------------------------------------

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