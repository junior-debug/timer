<?php
include(PUBLIC_DIR.'general/session.php');
if($_SESSION['type_user'] == 2){
	header("location:?view=formulario&mode=index");
}else{
	if(empty($_SESSION)){header('location:index.php');}else{
		include_once(MODEL_DIR.'bandejaModel.php');
		$conexion = new database();
		if (isset($_GET['mode'])){
			switch ($_GET['mode']){
				case 'index':
					if(empty($_POST['f_estatus'])){
						$estatus 	= 1;
					}else{
						$estatus 	= $_POST['f_estatus'];
					}
					$casos = $conexion->casos($estatus);
					include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'bandeja/index.php');
					include(PUBLIC_DIR.'general/footer.html');
				break;

				case 'caso':
					$cliente = $conexion->cliente($_GET['id']);
					foreach ($cliente as $c) {
						$origenContacto 	= $c['origenContacto'];
						$tipocontacto 		= $c['tipocontacto'];
						$nombre 			= $c['nombre'];
						$apellido 			= $c['apellido'];
						$cedula 			= $c['cedula'];
						$telf_hab 			= $c['telf_hab'];
						$telf_cel 			= $c['telf_cel'];
						$correo 			= $c['correo'];
						$tiposuscriptor 	= $c['tiposuscriptor'];
						$referenciapago 	= $c['referenciapago'];
						$tipomoneda 		= $c['tipomoneda'];
						$montopago 			= $c['montopago'];
						$nombrebanco 		= $c['nombrebanco'];
					}

					$comentario = $conexion->comentario($_GET['id']);

					include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'bandeja/caso.php');
					include(PUBLIC_DIR.'general/footer.html');
				break;

				case 'actualizar':
					$estatus 		= $_POST['estatus'];
					$observaciones 	= $_POST['observaciones'];
					$idGestion 		= $_POST['idGestion'];
					$idUsuario		= $_POST['idUsuario'];
					$fecha			= date('Y-m-d H:i');

					$actualizacionCaso = $conexion->actualizacionCaso($estatus,$observaciones,$idGestion,$fecha,$idUsuario);
					if($actualizacionCaso){
						$json['response'] 	= 	'true';
					}else{
						$json['response'] 	= 	'false';
					}
					echo json_encode($json);

				break;

				case 'descargar':
					header("Content-type: application/vnd.ms-excel;charset=utf8");
					header("Content-Disposition: attachment; filename=reporteCasosPendientes".date('dmY').".xls");
					$descarga = $conexion->descargaPendientes();
					echo utf8_decode('
							<div class="row">
						    <div class="col-md-12">
				            <table class="table table-responsive table-hover table-condensed">
			                    <thead>
			                        <tr>
			                          <th style="text-align: center;"><strong># Caso</strong></th>
			                          <th style="text-align: center;"><strong>Fecha</strong></th>
			                          <th style="text-align: center;"><strong>Nombre</strong></th>
			                          <th style="text-align: center;"><strong>Apellido</strong></th>
			                          <th style="text-align: center;"><strong>Cedula</strong></th>
			                          <th style="text-align: center;"><strong>Telf. Hab</strong></th>
			                          <th style="text-align: center;"><strong>Telf. Cel</strong></th>
			                          <th style="text-align: center;"><strong>Correo</strong></th>
			                          <th style="text-align: center;"><strong>Origen del contacto</strong></th>
			                          <th style="text-align: center;"><strong>Tipo de contacto</strong></th>
			                          <th style="text-align: center;"><strong>Categoria</strong></th>
			                          <th style="text-align: center;"><strong>Tipo de suscriptor</strong></th>
			                          <th style="text-align: center;"><strong>Fecha del pago</strong></th>
			                          <th style="text-align: center;"><strong>Tipo de moneda</strong></th>
			                          <th style="text-align: center;"><strong>Banco o medio de pago</strong></th>
			                          <th style="text-align: center;"><strong>Referencia de pago</strong></th>
			                          <th style="text-align: center;"><strong>Monto del pago</strong></th>			                          
			                        </tr>
			                    </thead>
				                <tbody>');
	            		if (!empty($descarga)) {
	                        foreach($descarga as $d){
					            echo '	<tr align="center">
				                           <td>'.$d['id_gestion'].'</td>
				                           <td>'.$d['fecha'].'</td>
				                           <td>'.$d['nombre'].'</td>
				                           <td>'.$d['apellido'].'</td>
				                           <td>'.$d['cedula'].'</td>
				                           <td>'.$d['telf_hab'].'</td>
				                           <td>'.$d['telf_cel'].'</td>
				                           <td>'.$d['correo'].'</td>
				                           <td>'.$d['origenContacto'].'</td>
				                           <td>'.$d['tipocontacto'].'</td>
				                           <td>'.$d['categoria2'].'</td>
				                           <td>'.$d['tiposuscriptor'].'</td>
				                           <td>'.$d['fechapago'].'</td>
				                           <td>'.$d['tipomoneda'].'</td>
				                           <td>'.$d['banco'].'</td>
				                           <td>'.$d['referenciapago'].'</td>
				                           <td>'.$d['montopago'].'</td>
				                        </tr>';
				                        	}
				                        }
					            echo '
					                </tbody>
					            </table>
					            </div>
					            </div>';

				break;

				default:
					header('location:'.HTML_DIR.'error.html');
				break;
			}
		}
	}
}
?>