<?php
include(PUBLIC_DIR.'general/session.php');
//if(empty($_SESSION)){header('location:index.php');}else{
	include_once(MODEL_DIR.'formularioModel.php');
	$conexion = new database();
	if (isset($_GET['mode'])) {
		switch ($_GET['mode']) {
			case 'index':
				$noefectivo = $conexion->contactoNoEfectivo();
				$categoria1	= $conexion->categoria1();
				$categoria2	= $conexion->categoria2($categoria1[0][0]);
				$categoria3 = $conexion->categoria3($categoria2[0][0]);
				$bancos		= $conexion->bancos();
				include(PUBLIC_DIR.'general/header.html');
				if($_SESSION['type_user'] != 2 ){
					include(PUBLIC_DIR.'general/sidebar.php');
				}
				include(PUBLIC_DIR.'general/navbar.php');
				include(HTML_DIR.'formulario/index.php');
				include(PUBLIC_DIR.'general/footer.html');
			break;
#---------------------------------------------------------------------------------
			case 'buscarCliente':
				$cliente = $conexion->buscarCliente($_POST['identificacion']);
				if($cliente){
					foreach ($cliente as $c) {
						$json['response'] 		= 	'true';
						$json['nombre'] 		= 	$c['nombre'];
						$json['apellido'] 		= 	$c['apellido'];
						$json['cedula'] 		=	$c['cedula'];
						$json['telf_hab'] 		=	$c['telf_hab'];
						$json['telf_cel'] 		=	$c['telf_cel'];
						$json['correo'] 		=	$c['correo'];
						$json['id_cliente'] 	=	$c['id_cliente'];
						$json['nombreCliente']	= 	'<div class="form-group"><span>Nombre del cliente</span><div class="row"><div class="col-4"><label><strong class="text-primary"><h5>'.$c['nombre'].' '.$c['apellido'].'</h5></strong></label></div></div></div>';

					}
					$casoCliente = $conexion->casoCliente($c['id_cliente']);
					if($casoCliente){
						$json['tablaCasos'] = '<div class="form-group"><div class="table-responsive"><table class="table table-striped" id="" cellspacing="0"><thead><tr><th>Caso</th><th>Fecha creación</th><th>Categoria</th><th>Estatus</th></tr></thead><tbody>';
						foreach($casoCliente as $cc){
							$json['response2']		= "true";
							$json['id_gestion'] 	= $cc['id_gestion'];
							$json['fecha'] 			= $cc['fecha'];
							$json['categoria2'] 	= $cc['categoria2'];
							$json['tiposuscriptor'] = $cc['tiposuscriptor'];
							$json['referenciapago'] = $cc['referenciapago'];
							$json['banco'] 			= $cc['banco'];
							$json['tipomoneda'] 	= $cc['tipomoneda'];
							$json['fechapago'] 		= $cc['fechapago'];
							$json['montopago'] 		= $cc['montopago'];
							$json['tablaCasos']		= $json['tablaCasos'].'<tr><th scope="row">'.$cc['id_gestion'].'</th><td>'.$cc['fecha'].'</td><td>'.$cc['categoria2'].'</td><td><a href="#" class="btn btn-sm btn-warning" id="btn-consultar" value=11"><span class="glyphicon glyphicon-remove"></span> Ver</a</td></tr>';
							#$json['tablaCasos']		= $json['tablaCasos'].'<tr><th scope="row">'.$cc['id_gestion'].'</th><td>'.$cc['fecha'].'</td><td>'.$cc['categoria2'].'</td><td><a href="?view=formulario&mode=modal&id='.$cc['id_gestion'].'" class="btn btn-sm btn-warning" id="btn-consultar" value=11"><span class="glyphicon glyphicon-remove"></span> Ver</a</td></tr>';
						}
						$json['tablaCasos'] = $json['tablaCasos'].'</tbody></table></div></div>';
					}else{
						$json['response2']	=	'false';
					}
				}else{
					$json['response'] = 'false';
				}
				echo json_encode($json);

			break;

			case 'modal':
				echo '<script>alert("'.$_GET['id'].'")';
			break;
#---------------------------------------------------------------------------------
			case 'guardar':
		/*	PARAMETROS RECIBIDOS EN EL POST
			$_POST['tipoContacto'],
			$_POST['tipoEfectivo'],
			$_POST['categoria1'],
			$_POST['categoria2'],			
			$_POST['categoria3'],
			$_POST['nombre'],
			$_POST['apellido'],
			$_POST['cedula'],
			$_POST['telh_hab'],
			$_POST['telf_cel'],
			$_POST['correo'],
			$_POST['tipoSuscriptor'],
			$_POST['referenciaPago'],
			$_POST['banco'],
			$_POST['tipoMoneda'],
			$_POST['fechaPago'],
			$_POST['montoPago'],
			$_POST['serialDeco'],
			$_POST['serialSC'],
			$_POST['telf_cel_no'],
			$_POST['idCliente'],
			$_POST['origenContacto']
			$_POST['tipoAtencion']
		*/
			$origenContacto			=	$_POST['origenContacto']; 	//LLAMADA O CHAT
			$tipoContacto 			=	$_POST['tipoContacto'];		//LLAMADA O CHAT
			
			if(empty($_POST['tipoEfectivo'])){
				$tipoEfectivo 		= 0;
			}else{
				$tipoEfectivo 		=	$_POST['tipoEfectivo'];	//SI O NO
			}

			if(empty($_POST['tipoAtencion'])){
				$tipoAtencion 		= 0;
			}else{
				$tipoAtencion 		=	$_POST['tipoAtencion'];	//SI O NO
			}

			if(empty($_POST['categoria1'])){
				$categoria1 		= 0;
			}else{
				$categoria1 		=	$_POST['categoria1'];
			}
			
			if(empty($_POST['categoria2'])){
				$categoria2 		= 0;
			}else{
				$categoria2 		=	$_POST['categoria2'];
			}

			if(empty($_POST['categoria3'])){
				$categoria3 		= 0;
			}else{
				$categoria3 		=	$_POST['categoria3'];
			}

			$nombre 				=	$_POST['nombre'];
			$apellido 				=	$_POST['apellido'];
			$cedula 				=	$_POST['cedula'];
			$telf_hab 				=	$_POST['telf_hab'];
			$telf_cel 				=	$_POST['telf_cel'];
			$correo 				=	$_POST['correo'];
			
			if(empty($_POST['tipoSuscriptor'])){
				$tipoSuscriptor 	= 	0;
			}else{
				$tipoSuscriptor 	=	$_POST['tipoSuscriptor'];
			}

			if(empty($_POST['referenciaPago'])){
				$referenciaPago 	= 	0;
			}else{
				$referenciaPago 	=	$_POST['referenciaPago'];
			}

			if(empty($_POST['banco'])){
				$banco 				= 	0;
			}else{
				$banco 				=	$_POST['banco'];
			}

			if(empty($_POST['tipoMoneda'])){
				$tipoMoneda 		= 	0;
			}else{
				$tipoMoneda 		=	$_POST['tipoMoneda'];
			}

			if(empty($_POST['fechaPago'])){
				$fechaPago 			= 	0;
			}else{
				$fechaPago 			=	$_POST['fechaPago'];
			}

			if(empty($_POST['montoPago'])){
				$montoPago 			= 	0;
			}else{
				$montoPago 			=	$_POST['montoPago'];
			}

			if(empty($_POST['serialDeco'])){
				$serialDeco 		= 	0;
			}else{
				$serialDeco 		=	$_POST['serialDeco'];
			}

			if(empty($_POST['serialSC'])){
				$serialSC 			= 	0;
			}else{
				$serialSC 			=	$_POST['serialSC'];
			}

			if(empty($_POST['telf_cel_no'])){
				$telf_cel_no 		= 	0;
			}else{
				$telf_cel_no 		=	$_POST['telf_cel_no'];
			}
			
			if(empty($_POST['idCliente'])){
				$idCliente	 	= 	0;							//CLIENTE NO EXISTE
			}else{
				$idCliente 	=	$_POST['idCliente'];			//CLIENTE EXISTE
			}
			// TIPO DE CONTACTO
			$tipo = 1; 												//GENERAL
			if($categoria2 == 18){$tipo = 2;} 						//RECARGA NO APLICADA
			if($categoria2 == 23 || $categoria2 == 30){$tipo = 3;} 	//INCONVENIENTE TÉCNICO

			$registroClienteLlamada	= $conexion->registro($origenContacto,$tipoContacto,$tipoEfectivo,$tipoAtencion,$categoria1,$categoria2,$categoria3,$nombre,$apellido,$cedula,$telf_hab,$telf_cel,$correo,$tipoSuscriptor,$referenciaPago,$banco,$tipoMoneda,$fechaPago,$montoPago,$serialDeco,$serialSC,$_SESSION['id'],$tipo,$idCliente);
			
			header("Location:?view=formulario&mode=index");

			break;
#---------------------------------------------------------------------------------
			case 'categoria2':
				$id_categoria1 = $_POST['id_categoria1'];
				$categoria2 = $conexion->categoria2($id_categoria1);
				$json['categoria2'] = "";
				if ($categoria2) {
					foreach ($categoria2 as $c2) {
						$json['response'] 	= 	'true';
						$json['categoria2'] = $json['categoria2'] . $c2['id_categoria2'] . "," . $c2['descripcion'] . "|";
					}
				}
				else{
					$json['response'] 	= 	'false';
				}
				echo json_encode($json);
			break;
#---------------------------------------------------------------------------------
			case 'categoria3':
				$id_categoria2 = $_POST['id_categoria2'];
				$categoria3 = $conexion->categoria3($id_categoria2);
				$json['categoria3'] = "";
				if ($categoria3) {
					foreach ($categoria3 as $c3) {
						$json['response'] 	= 	'true';
						$json['categoria3'] = $json['categoria3'] . $c3['id_categoria3'] . "," . $c3['descripcion'] . "|";
					}
				}
				else{
					$json['response'] 	= 	'false';
				}
				echo json_encode($json);
			break;
#---------------------------------------------------------------------------------
			case 'municipio':
				$id_ciudad = $_POST['id_ciudad'];
				$id_estado = $_POST['id_estado'];
				if($_POST['servicio'] == 'bc' || $_POST['servicio'] == 'ps' ){
					#echo ("SELECT * FROM municipio WHERE id_ciudad = ".$id_estado);

					$municipio = $conexion->municipio_($id_estado);
					$json['municipio'] = "";
					if ($municipio) {
						foreach ($municipio as $m) {
							$json['response']  = 'true';
							$json['municipio'] = $json['municipio'] . $m['id_municipio'] . "," . $m['municipio'] . "|";
						}
					}
					else{
						$json['response'] 	= 	'false';
					}
					echo json_encode($json);	
				}else{
					$municipio = $conexion->municipio($id_ciudad,$id_estado);
					$json['municipio'] = "";
					if ($municipio) {
						foreach ($municipio as $m) {
							$json['response']  = 'true';
							$json['municipio'] = $json['municipio'] . $m['id_municipio'] . "," . $m['municipio'] . "|";
						}
					}
					else{
						$json['response'] 	= 	'false';
					}
					echo json_encode($json);
				}
			break;
#---------------------------------------------------------------------------------
#---------------------------------------------------------------------------------
#---------------------------------------------------------------------------------
#-------------------Formulario SimpleTV Solimar--------------------------------------------------------------
			case 'formSimpletv':
				$estados = $conexion->estados_();
				include(PUBLIC_DIR.'general/header.html');
				if($_SESSION['type_user'] != 2 ){
					include(PUBLIC_DIR.'general/sidebar.php');
				}
				include(PUBLIC_DIR.'general/navbar.php');
				include(HTML_DIR.'formulario/registroSimpleTV.php');
				include(PUBLIC_DIR.'general/footer.html');
			break;
#--------------------------------------------------------------------------------
			case 'ciudad':
				$id_estado = $_POST['id_estado_'];
				$ciudad_ = $conexion->ciudad_($id_estado);			
				$json['ciudad_'] = "";

				if ($ciudad_) {
					foreach ($ciudad_ as $city) {
						$json['response'] 	= 	'true';
						$json['ciudad_'] = $json['ciudad_'] . $city['id_ciudad'] . "," . $city['ciudad'] . "|";
					}
				}
				else{
					$json['response'] 	= 	'false';
				}
				echo json_encode($json);/**/

			break;
#--------------------------------------------------------------------------------
			case 'municipioo':
				$id_ciudad = $_POST['id_ciudad_'];
				$municipio_ = $conexion->municipio_($id_ciudad);			
				$json['municipio_'] = "";

				if ($municipio_) {
					foreach ($municipio_ as $city) {
						$json['response'] 	= 	'true';
						$json['municipio_'] = $json['municipio_'] . $city['id_municipio'] . "," . $city['municipio'] . "|";
					}
				}
				else{
					$json['response'] 	= 	'false';
				}
				echo json_encode($json);/**/
			break;
#--------------------------------------------------------------------------------
			case 'guardarFormSimpleTV':
				$nombre_  		=  $_POST['nombre_']; 
				$apellido_  	=  $_POST['apellido_']; 
				$sexo_  		=  $_POST['sexo_']; 
				$fecha_nacim_  	=  $_POST['fecha_nacim_']; 
				$type_doc_  	=  $_POST['type_doc_']; 
				$num_doc_  		=  $_POST['num_doc_']; 
				$tlf_fijo_  	=  $_POST['tlf_fijo_']; 
				$num_fijo_  	=  $_POST['num_fijo_']; 
				$celular_  		=  $_POST['celular_']; 
				$num_celular_  	=  $_POST['num_celular_']; 	
				$email_  		=  $_POST['email_'];
				$clave_  		=  $_POST['clave_'];  
				$estado_  		=  $_POST['estado_']; 
				$ciudad_  		=  $_POST['ciudad_']; 
				$municipio_  	=  $_POST['municipio_']; 
				//$sector_  		=  $_POST['sector_']; 
				$direccion1_  	=  $_POST['direccion1_']; 
				//$direccion2_  	=  $_POST['direccion2_']; 
				//$codigo_postal_ =  $_POST['codigo_postal_']; 

				if ($_POST['redsocial1_'] == "") {
					$redsocial1_  	=  0; 
				}else{
					$redsocial1_  	=  $_POST['redsocial1_']; 
				}

				if ($_POST['redsocial2_'] == "") {
					$redsocial2_  	=  0; 
				}else{
					$redsocial2_  	=  $_POST['redsocial2_']; 
				}

				if ($_POST['sector_'] == "") {
					$sector_  	=  0; 
				}else{
					$sector_  	=  $_POST['sector_']; 
				}

				if ($_POST['direccion2_'] == "") {
					$direccion2_  	=  0; 
				}else{
					$direccion2_  	=  $_POST['direccion2_']; 
				}

				if ($_POST['codigo_postal_'] == "") {
					$codigo_postal_  	=  0; 
				}else{
					$codigo_postal_  	=  $_POST['codigo_postal_']; 
				}

				$tlf_fijo = $tlf_fijo_.$num_fijo_;
				$celular  = $celular_.$num_celular_;

				$r = $conexion->guardarFormSimpleTV($nombre_, $apellido_, $sexo_, $fecha_nacim_, $type_doc_, $num_doc_, $tlf_fijo, $celular, $redsocial1_, $redsocial2_, $email_, $clave_, $estado_, $ciudad_, $municipio_, $sector_, $direccion1_, $direccion2_, $codigo_postal_);
			break;



#--------------------------------------------------------------------------------

#-------------------END Formulario SimpleTV Solimar--------------------------------------------------------------









#---------------------------------------------------------------------------------
		default:
			header('location:'.HTML_DIR.'error.html');
		break;
		}	
	}
//}
?>