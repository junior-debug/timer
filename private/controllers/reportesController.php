<?php
include(PUBLIC_DIR.'general/session.php');
if($_SESSION['cargo'] == 'OPERADOR'){
	header("location:?view=contador&mode=index");
}else{
	if(empty($_SESSION)){header('location:index.php');}else{
		include_once(MODEL_DIR.'reportesModel.php');
		$conexion = new database();
		if (isset($_GET['mode'])) {
			function RestarHoras($horaini,$horafin){
    			$f1 = new DateTime($horaini);
    			$f2 = new DateTime($horafin);
    			$d = $f1->diff($f2);
    			return $d->format('%H:%I:%S');
			}
			function sumarHoras($horas) {
				$total = 0;
			    foreach($horas as $h) {
			        $parts = explode(":", $h);
			        $total += $parts[2] + $parts[1]*60 + $parts[0]*3600;        
			    }   
			    return gmdate("H:i:s", $total);
			}

			function sqlServicios($total_servi){
				if ( $total_servi === 1 ) {
			    	
			    	$sqlService = "AND (datos_empleados.servicio = '".$_SESSION['serviceP1']."')"; 	   		

			    }else if ( $total_servi === 2 ) {
			  		
			  		$sqlService = "AND (datos_empleados.servicio = '".$_SESSION['serviceP1']."' OR datos_empleados.servicio = '".$_SESSION['serviceP2']."')";      		

			    }else if ( $total_servi === 3 ) {
			    	
			    	$sqlService = "AND (datos_empleados.servicio = '".$_SESSION['serviceP1']."' OR datos_empleados.servicio = '".$_SESSION['serviceP2']."' OR datos_empleados.servicio = '".$_SESSION['serviceP3']."')";  		

			    }else{} /**/
					
					return $sqlService;
			}


			function sqlPosicionServicios($total_servi){
				//$separacion = explode(',', $servi);
				
				if ( $total_servi === 1 ) {
			    	
			    	$sqlService = "(servicio_ = '".$_SESSION['serviceP1']."')"; 	   		

			    }else if ( $total_servi === 2 ) {
			  		
			  		$sqlService = "(servicio_ = '".$_SESSION['serviceP1']."' OR servicio_ = '".$_SESSION['serviceP2']."')";      		

			    }else if ( $total_servi === 3 ) {
			    	
			    	$sqlService = "(servicio_ = '".$_SESSION['serviceP1']."' OR servicio_ = '".$_SESSION['serviceP2']."' OR servicio_ = '".$_SESSION['serviceP3']."')";	

			    }else{} /**/
					
				return $sqlService;
			}

			function sumaTotalCount($respConsulta, $orign){
				//echo '<br><br> funcion sumaTotalCount:  '. count($respConsulta) . '<br><br>';
				$sumaCountt = 0;
				$name_variabl = "";

				if ( $orign == 'conectado' ) {
					$name_variabl = "contConect";

				}else if ( $orign == 'auxiliar' ) {
					$name_variabl = "contConect";

				}else if ( $orign == 'desconectado' ) {
					$name_variabl = "contDesconect";

				}else if ( $orign == 'plantilla' ) {
					$name_variabl = "contPlantill";

				}else{}

					if ( count($respConsulta) != 1) { 
						//echo ' <br> ingreso del IF <br>'. count($respConsulta).'<br><br>';
						for ($i=0; $i < count($respConsulta) ; $i++) { 
							//echo ' VALORESSSSS: '. $respConsulta[$i][$name_variabl].'<br><br>';
							$sumaCountt = $sumaCountt + $respConsulta[$i][$name_variabl];
						}
						//$sumaCountt = $sumaCountt;

					}else{
						/*echo ' no esta en el IF <br><br><br>';
						print_r($respConsulta);
						echo '<br><br>';*/
						$sumaCountt = $respConsulta[0][$name_variabl];
					}
					
					//echo ' valor-valor '. $respConsulta[0][$name_variabl].'<br><br>';
					return $sumaCountt;
			}

			switch ($_GET['mode']) {
				case 'index':	
					include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'reportes/index.php');
					include(PUBLIC_DIR.'general/footer.html');	
				break;
	#-------------------------------------------------------------------------------------------
				case 'auxiliar':
				    include(PUBLIC_DIR.'general/header.html'); 
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'reportes/vistaAuxiliares.php');
					include(PUBLIC_DIR.'general/footer.html');	
				break;
	#-------------------------------------------------------------------------------------------	
				case 'consulta_auxiliar':
					//echo $_POST['fecha_d']. ' --> '.  $_POST['fecha_h']. ' --> '.  $_POST['auxiliar_'];
					$a  = 	$_POST['fecha_d'];  
					$b  = 	$_POST['fecha_h'];

					$listSupervisor = $conexion->listSupervisor();
				    $consultar = $conexion->consultarxauxiliar($a, $b);

				    include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'reportes/vistaAuxiliar2.php');
					include(PUBLIC_DIR.'general/footer.html');	/**/
				break;
	#_____________________________________________________________
		case 'descargaReporteConsulta_auxiliar':	
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=Consulta_auxiliar.xls");
			
			$a 	=	$_GET['desde'];
			$b 	=	$_GET['hasta'];


			$listSupervisor = $conexion->listSupervisor();
			$consultar = $conexion->consultarxauxiliar($a, $b);
			echo '
					<table class="table table-hover" id="dataTable" cellspacing="0">
				        <thead>
				          <tr>
				            <!-- 
				            <th>ID REGISTRO</th>
				            <th>ID USUARIO</th> -->
				            <th>ID USUARIO</th>
				            <th>NOMBRE</th>
				            <th>APELLIDO</th>
				            <th>SERVICIO </th>
				            <th>'.utf8_decode('CAMPAÑA').'</th>
				            <th>SUPERVISOR</th>
				            <th>CEDULA</th>
				            <th>CARGO</th>
				            <th>FECHA</th>
				            <th>TIEMPO READY</th>
				            <th>BREAK</th>
				            <th>'.utf8_decode('BAÑO').'</th>
				            <th>ENTRENAMIENTO</th>
				            <th>FEEK BACK</th>
				            <th>LLAMADAS SALIENTES</th>
				            <th>HORA INICIO</th> 
				            <th>HORA FINAL</th>      
				          </tr>
				        </thead>
				        <tbody>';
          		$i = 1;
            	if ($consultar) {
              		foreach ($consultar as $consult) {
		                $timerMaxBreak    = '00:00:20';
		                $timerMaxEntre    = '01:00:15';
		                $timerMaxBA_FB_LL = '00:00:30';

		                if ($consult['break'] >= $timerMaxBreak) {
		                  $cssBR = 'style= "color:red; font-weight:700;"';
		                }else{
		                  $cssBR = '';
		                }

		                if ($consult['entrenamiento'] >= $timerMaxEntre) {
		                  $cssEN = 'style= "color:red; font-weight:700;"';
		                }else{
		                  $cssEN = '';
		                }

		                if ($consult['bath'] >= $timerMaxBA_FB_LL) {
		                  $cssBA = 'style= "color:red; font-weight:700;"';
		                }else{
		                  $cssBA = '';
		                }

		                if ($consult['feek_back'] >= $timerMaxBA_FB_LL) {
		                  $cssFB = 'style= "color:red; font-weight:700;"';
		                }else{
		                  $cssFB = '';
		                }

		                if ($consult['llamada_saliente'] >= $timerMaxBA_FB_LL) {
		                  $cssLL = 'style= "color:red; font-weight:700;"';
		                }else{
		                  $cssLL = '';
		                }


	        echo ' 		<tr>
			              <!-- 
			              <td>'.$consult['id_registro'].'</td>
			              <td>'.$consult['id_user'].'</td> -->
			              <td>'.$consult['id_datos_empleados'].'</td>
			              <td>'.$consult['nombre'].'</td>
			              <td>'.$consult['apellido'].'</td>
			              <td>'.$consult['servicio']. '</td>
			              <td>'.utf8_decode($consult['name_campana']).'</td>';
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
						  <td>'.$consult['cedula'].'</td>
			              <td>'.$consult['cargo'].'</td>
			              <td>'.$consult['dia'].'</td>
			              <td>'.$consult['tiempo_ready'].'</td>
			              <td '.$cssBR.' >'.$consult['break'].'</td>
			              <td '.$cssBA.' >'.$consult['bath'].'</td>
			              <td '.$cssEN.' >'.$consult['entrenamiento'].'</td>
			              <td '.$cssFB.' >'.$consult['feek_back'].'</td>
			              <td '.$cssLL.' >'.$consult['llamada_saliente'].'</td>
			              <td>'.$consult['hora_inicio'].'</td>
			              <td>'.$consult['hora_fin'].'</td>
			            </tr>';
          		$i++; } 
          		}
        	echo '		</tbody>
      				</table>';				
		break;
	#-------------------------------------------------------------------------------------------
	#-------------------------------------------------------------------------------------------	
				case 'conexionxagente':
					$listUsuarios = $conexion->listUsuarios();

				    include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'reportes/conexionxagente.php');
					include(PUBLIC_DIR.'general/footer.html');	
				break;
	#-------------------------------------------------------------------------------------------	
				case 'busquedaAgente':
					$texto = $_POST['texto'];
					$consultar = $conexion->busquedaAgnte($texto);

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
	#-------------------------------------------------------------------------------------------
				case 'consulta_xagente':
					$as  = 	$_POST['fecha_d'];  
					$bs  = 	$_POST['fecha_h'];
					$cs  = 	$_POST['agenteBusque_'];

					//$as = $_POST['agente_'];
				    $consultar 	= $conexion->consultarxagente($as, $bs, $cs);
				    $consultar_ = $conexion->consultarxagenteCambioCampana($as, $bs, $cs);

				    if ($consultar) { 
				    	$apellido   = $consultar[0]['apellido']; 
				    
				    }else{ 
				    	$apellido   = '';
				    }

					if ($consultar) { 
						$name = $consultar[0]['nombre']; 
					}else{
						$name = '';
					} 

				    include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'reportes/conexionxagente2.php');
					include(PUBLIC_DIR.'general/footer.html');	/**/			
				break;
	#------------------------------------------------------------------------------------------------------------------------------	
				case 'selectSuperxServi_':
					$id_servicio 	=	$_POST['id_servicio'];
					$consulta1_3 	= 	$conexion->supervisoresList();
					$consultas 		=	$conexion->selectSuperxServi($id_servicio);
					/*		for ($d=0; $d < count($consulta1_3) ; $d++) { 
								echo count($consulta1_3). ' TODOS LOS SUPERV: '. $consulta1_3[$d]['id_datos_empleados']. ' <br> ';
				           	}	
				    echo '<br><br>';
				        for ($j=0; $j < count($consultas) ; $j++) { 
				            echo count($consultas). ' SUPERV SERVICE: '.  	$consultas[$j]['id_datos_empleados']. '<br> ';

				        }
				    echo '<br><br>';echo '<br><br>';*/

					if ($consultas) {
				      	$json['result'] = '
				            									<select required class="form-control" id="supervisor2_contadReal_" name="supervisor2_contadReal_" onchange = "selectSuperDos(this.value)" >';
				        $json['result'] = $json['result'].'			<option value="0">Seleccione...</option>';
				        												for ($d=0; $d < count($consulta1_3) ; $d++) { 
				                  											for ($j=0; $j < count($consultas) ; $j++) { 
				                  												if ( $consultas[$j]['id_datos_empleados'] == $consulta1_3[$d]['id_datos_empleados']) {
				        $json['result'] = $json['result'].'						<option value="'.$consulta1_3[$d]['id_datos_empleados'].'">'.$consulta1_3[$d]['nombre'].' '.$consulta1_3[$d]['apellido'].'</option>';
				                  												}	
				                  											}
				                  										}	
				        $json['result'] = $json['result']. '	</select><br>';
				        $json['response'] = 'true';
						echo json_encode($json);
				    }else{
			      		$json['result'] =   '	<select required class="form-control" id="supervisor2_contadReal_" name="supervisor2_contadReal_" >
				            						<option value="0">Seleccione...</option>
				            					</select><br>
				            				';
						$json['response'] = 'false';
						echo json_encode($json);
			    	}
				break;
	#-------------------------------------------------------------------------------------------------------------------------------				
				case 'conectado_time_real':		
					if ($_SESSION['cargo'] != 'CLIENTE'){
						if ( $_SESSION['cargo'] == 'COORDINADOR') {
							$valorCargo   = " AND (cargos != 'GERENTE' AND cargos != 'CLIENTE' AND cargos != 'COORDINADOR') ";
							
						}else if ( $_SESSION['cargo'] == 'CLIENTE') {
							$valorCargo   = "AND cargos = 'OPERADOR'";
							
						}else if ( $_SESSION['cargo'] == 'GERENTE') {
							$valorCargo   = " AND (cargos != 'GERENTE') ";
							
						}else if ( $_SESSION['cargo'] == 'SUPERVISOR' ) {
							$valorCargo   = " AND (cargos = 'OPERADOR' OR cargos = 'ANALISTA'  OR cargos = 'SUPERVISOR') ";
							 
						}else{ $valorCargo   = "";}

						$consulta1_2 	= $conexion->cargosList($valorCargo);	

								//$valorSupervi
					}

					if ( $_SESSION['cargo'] == 'ADMINISTRADOR'  || $_SESSION['cargo'] == 'GERENTE') { /* 1==> ADMIN, 2==> COORDI_CLIENT_ */
						$consulta1_3 	= $conexion->supervisoresList();
						$consulta2 	= $conexion->servicios(1);
					}

					if ( $_SESSION['cargo'] == 'COORDINADOR'  || $_SESSION['cargo'] == 'SUPERVISOR') { 
						//echo '<br> aqui coordi_suoer <br>';
						$consultaSQL1 = sqlServicios( $_SESSION['totalService'] );
						$consulta1_3 		=	$conexion->selectSuperxServi( $consultaSQL1   /*$_SESSION['IdServices']*/ );
					}


					

					/*if ($_SESSION['cargo'] != 'CLIENTE' || $_SESSION['cargo'] != 'OPERADOR') {
						$consulta2_ = $conexion->cantidadPosicionMES($_SESSION['id_servicio'] , date("m"), date("Y"));
						if ( !empty($consulta2_[0]['idPM']) ) {
							$msj = 1;
						}else{
							$msj = 0;
						}
					}*/
				    include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'reportes/conectado_time_real.php');
					include(PUBLIC_DIR.'general/footer.html');  /*	*/
				break;
	#-------------------------------------------------------------------------------------------	
				case 'busqueda_time_real':
					$fechaHoy 			= date("Y-m-d");			
				    $timerMaxBreak 		= '00:59:00';
					$timerMaxEntre 		= '01:00:00';
					$timerMaxBA_FB_LL 	= '00:15:00';
					$valor_posicion = 0;

					$valorServicio 	= 	$_POST['valorServicio'];  //'SIMPLE TV'; //0;
					$valorCargo    	= 	$_POST['valorCargo'];     //0;
					$valorSuperv 	= 	$_POST['valorSuperv']; 	  //98;
					//echo $valorServicio. ' ==> '. $_SESSION['cargo'].' <br><br><br>';


					if ($_SESSION['cargo'] == 'ADMINISTRADOR' || $_SESSION['cargo'] == 'COORDINADOR' || $_SESSION['cargo'] == 'CLIENTE'  || $_SESSION['cargo'] == 'GERENTE') {
						
						if ( $_SESSION['cargo'] == 'COORDINADOR' OR $_SESSION['cargo'] == 'GERENTE' OR  $_SESSION['cargo'] == 'ADMINISTRADOR') {
							$classButton = '';
							if ( $valorCargo == '0' OR $valorCargo == null) {
								if ( $valorSuperv == '0') {
									$valorCargo   = "";
								}else{				
									$valorCargo   = " AND datos_empleados.supervisor = '".$valorSuperv."'";				
								}	
							}else{
								$valorCargo   = " AND datos_empleados.cargo = '".$valorCargo."'";
							}

						}else if ( $_SESSION['cargo'] == 'CLIENTE') {
							$classButton = 'disabled';			
							$valorCargo   = " AND datos_empleados.cargo = 'OPERADOR'";	
						}else{}	


						if ( $valorServicio === '0') {
							$valor_posicion  =  "";
							$valorServicio   = "";

						}else{ 
							$valor_posicion  = " servicio_ = '".$valorServicio."' AND";
							$valorServicio   = "AND datos_empleados.servicio = '".$valorServicio."'";
						}


			            $consultarSupervisores = $conexion->consultarSupervisores($valorServicio);/**/	
						$consultarP 			= $conexion->cantidadPosicionMES($valor_posicion, date("m"), date("Y"), 'ADMIN' );   //$_SESSION['id_servicio'], date("m"), date("Y")


						if ( !empty($consultarP[0]['idPM']) ) {
							$msj = 1;
							$valor_posicion = $consultarP[0]['posicion_'];
						}else{
							$msj = 0;
							$valor_posicion = 0;
						}

						$consultar 	= $conexion->consultarxtimerealDiaAdmin($fechaHoy, $valorServicio, $_SESSION['cargo'], $valorCargo);					
						
						$cosultaTotalConectados 	= $conexion->TotalConectados($fechaHoy, $valorServicio, $valorCargo, $_SESSION['totalService']);
						$cosultaTotal_TimeAuxiliares 	= $conexion->Total_TimeAuxiliares_cadaUno($fechaHoy, $valorServicio, $valorCargo, $_SESSION['totalService']);
						$cosultaTotalDesconectados 	= $conexion->TotalDesconectados($fechaHoy, $valorServicio, $valorCargo, $_SESSION['totalService']);
						$cosultaTotalPlantilla 		= $conexion->TotalPlantilla($fechaHoy, $valorServicio, $valorCargo, $_SESSION['totalService']);

						$cosultaTotalConectados 		=  sumaTotalCount($cosultaTotalConectados, 'conectado');
						//$cosultaTotal_TimeAuxiliares	=  sumaTotalCount($cosultaTotal_TimeAuxiliares, 'auxiliar');
						$cosultaTotalDesconectados		=  sumaTotalCount($cosultaTotalDesconectados, 'desconectado');
						$cosultaTotalPlantilla 			=  sumaTotalCount($cosultaTotalPlantilla, 'plantilla');

						if (/*$cosultaTotalPlantilla[0]["contPlantill"]*/ $cosultaTotalConectados >= $valor_posicion) {
							$valorTotalP = '<font color = "#00c37d"> Total Plantilla: '.$cosultaTotalPlantilla.'</font>';

						}else{
							$valorTotalP = '<font color = "#f1b213"> Total Plantilla: '.$cosultaTotalPlantilla.'</font>';
						}/**/  
 
			        }else if ($_SESSION['cargo'] == 'SUPERVISOR') {

			        	/*echo ' <br> SECCION DE SUPERVISOR!!! <br>';
				        	echo ' VALORES: <br>';
					        	echo ' fechaHoy 			= '. date("Y-m-d").'<br>';			
						    	echo ' timerMaxBreak 		= 00:59:00 <br>';
								echo ' timerMaxEntre 		= 01:00:00 <br>';
								echo ' timerMaxBA_FB_LL 	= 00:15:00 <br>';
								echo ' valor_posicion = 0 <br>';

								echo ' valorServicio 	= 	0 <br>';  		
								echo ' valorCargo    	= 	0<br>';   										
								echo ' valorSuperv 	= 	0<br>';   */


			        	$classButton = '';

			        	if ( $valorCargo == '0'  OR $valorCargo == null) {
							if ( $valorSuperv == '0') {
								$valorCargo   = "AND (datos_empleados.cargo = 'OPERADOR' OR  datos_empleados.cargo = 'ANALISTA' OR  datos_empleados.cargo = 'SUPERVISOR')";
							}else{				
								$valorCargo   = " AND datos_empleados.supervisor = '".$valorSuperv."'";				
							}	
						}else{
							$valorCargo   = " AND datos_empleados.cargo = '".$valorCargo."'";
						}

						if ( $valorServicio == '0') {
							//echo '<br> servicio cero <br>';
							$valor_posicion  = 0;
							$valorServicio   = "";

							$consultaSQL1 = sqlServicios( $_SESSION['totalService'] );
				        	$consultaSQL2 = sqlPosicionServicios( $_SESSION['totalService'] );


						}else{  
							//$valor_posicion  = $valorServicio;
							//$valorServicio   = "AND datos_empleados.servicio = '".$valorServicio."'";
							//echo '<br> servicio DISTINTO DE cero <br>';
							$consultaSQL1 = "AND (datos_empleados.servicio = '".$valorServicio."')"; 	
							$consultaSQL2 = "(servicio_ = '".$valorServicio."')";
						}

				        	/*echo '<br><br>';
				        	print($consultaSQL1); 
				        	echo '<br><br>';
	 						
	 						print($consultaSQL2);
				        	echo '<br><br>';*/



			            $consultarSupervisores = $conexion->consultarSupervisores($consultaSQL1);/**/			           
						$consultarP 	= $conexion->cantidadPosicionMES($consultaSQL2, date("m"), date("Y"), 'SUP' );   //$_SESSION['id_servicio'], date("m"), date("Y")

						if ( !empty($consultarP[0]['idPM']) ) {
							$msj = 1;
							$valor_posicion = $consultarP[0]['posicion_'];
						}else{
							$msj = 0;
							$valor_posicion = 0;
						}

						$consultar 	= $conexion->consultarxtimerealDiaSuperv($fechaHoy, $_SESSION['id'], $consultaSQL1 /*$valorServicio*/, $_SESSION['cargo'], $valorCargo);

						$cosultaTotalConectados 		= $conexion->TotalConectados($fechaHoy, $consultaSQL1 /*$valorServicio*/, $valorCargo, $_SESSION['totalService']);
						$cosultaTotal_TimeAuxiliares 	= $conexion->Total_TimeAuxiliares_cadaUno($fechaHoy, $consultaSQL1 /*$valorServicio*/, $valorCargo );
						$cosultaTotalDesconectados 		= $conexion->TotalDesconectados($fechaHoy, $consultaSQL1 /*$valorServicio*/, $valorCargo, $_SESSION['totalService']);
						$cosultaTotalPlantilla 			= $conexion->TotalPlantilla($fechaHoy, $consultaSQL1 /*$valorServicio*/, $valorCargo, $_SESSION['totalService']);

						$cosultaTotalConectados 		=  sumaTotalCount($cosultaTotalConectados, 'conectado');
						//$cosultaTotal_TimeAuxiliares	=  sumaTotalCount($cosultaTotal_TimeAuxiliares, 'auxiliar');
						$cosultaTotalDesconectados		=  sumaTotalCount($cosultaTotalDesconectados, 'desconectado');
						$cosultaTotalPlantilla 			=  sumaTotalCount($cosultaTotalPlantilla, 'plantilla');

						if (/*$cosultaTotalPlantilla[0]["contPlantill"]*/ $cosultaTotalConectados >= $valor_posicion) {
							$valorTotalP = '<font color = "#00c37d"> Total Plantilla: '.$cosultaTotalPlantilla.'</font>';

						}else{
							$valorTotalP = '<font color = "#f1b213"> Total Plantilla: '.$cosultaTotalPlantilla.'</font>';
						}/**/  

 
						//echo 'cosultaTotalConectados: '. ($cosultaTotalConectados). '  ==>>> '.'cosultaTotalDesconectados: '. ($cosultaTotalDesconectados). '  ==>>> '.'cosultaTotalPlantilla: '. ($cosultaTotalPlantilla). ' <br><br>';

						//echo ' <br> valorTotalP ===> '. $valorTotalP.'<br><br>';


			        }else {}

				    if ($consultar) {
						$json['result'] = $json['result'].' <h6 ';
								if ($msj == 0) { 
						$json['result'] = $json['result'].'style="color: #e30945; float: left; display:block;" ';
								}else{ 
						$json['result'] = $json['result'].' style="color: #000; float: left; display:none;" '; 
								}
						$json['result'] = $json['result'].' class="m-0 font-weight-bold" >Se debe actualizar el valor de posiciones por mes</h6><br>   

							      	<div class="row"> 
							      		<div class="col-2" style = "text-align: center;	" >
							            	<label style="color: #000; font-weight:500; border-bottom: 2px solid #ffb700;" for="" class="visually-hidden">POSICIONES MES: '.$valor_posicion.'</label>
							          	</div>

							        	<div class="col-2" style = "text-align: center;	" >
							            	<label style="color: #000; font-weight:500;" for="" class="visually-hidden">'.$valorTotalP.'</label>
							          	</div>
							          	<div class="col-2" style = "text-align: center;	" >
							            	<label style="color: #000; font-weight:500; border-bottom: 2px solid #169b6b;" for="" class="visually-hidden">CONECTADOS: '.$cosultaTotalConectados.'</label>
							          	</div>
							          	<div class="col-2" style = "text-align: center;	" >
							            	<label style="color: #000; font-weight:500; border-bottom: 2px solid #169b6b;" for="" class="visually-hidden">DESCONECTADOS: '.$cosultaTotalDesconectados.'</label>
							          	</div>
							          	<div class="col-2" style = "text-align: center;	" >
							          		<a onclick="modalContadorCampana();" style="float: right;margin-right: 5px; font-weight: 500;"  class="btn text-primary">CONTADOR POR CAMPAÑA</a>
							          	</div><!---->
							      	</div><br> 
									<div class="row">
							          	<div class="col-2" style = "text-align: center;	" >
							            	<label style="color: #000; font-weight:500; border-bottom: 2px solid #169b6b;" for="" class="visually-hidden">BREAK: '.$cosultaTotal_TimeAuxiliares[0]['contConect'].'</label>
							          	</div>
							          	<div class="col-2" style = "text-align: center;	" >
							            	<label style="color: #000; font-weight:500; border-bottom: 2px solid #169b6b;" for="" class="visually-hidden">BAÑO: '.$cosultaTotal_TimeAuxiliares[1]['contConect'].'</label>
							          	</div>
							          	<div class="col-2" style = "text-align: center;	" >
							            	<label style="color: #000; font-weight:500; border-bottom: 2px solid #169b6b;" for="" class="visually-hidden">ENTRENAMIENTO: '.$cosultaTotal_TimeAuxiliares[2]['contConect'].'</label>
							          	</div>
							          	<div class="col-2" style = "text-align: center;	" >
							            	<label style="color: #000; font-weight:500; border-bottom: 2px solid #169b6b;" for="" class="visually-hidden">FEED BACK: '.$cosultaTotal_TimeAuxiliares[3]['contConect'].'</label>
							          	</div>
							          	<div class="col-2" style = "text-align: center;	" >
							            	<label style="color: #000; font-weight:500; border-bottom: 2px solid #169b6b;" for="" class="visually-hidden">LLAMADAS SALIENTES: '.$cosultaTotal_TimeAuxiliares[4]['contConect'].'</label>
							          	</div>
							      	</div><br>
							      		<script type="text/javascript">   
									    	$(document).ready( function () {
									        	//$("#dataTableIS").DataTable();
									        	$("#dataTableIS").DataTable( {
											        "order": [[ 15, "desc" ]]
											    });
									      	});
									    </script><!----> 

												<table style="text-align: center;" class="table table-hover"  id="dataTableIS" cellspacing="0">
											        <thead>
											          <tr>
											            <!-- <th>ID REGISTRO</th>-->
											            <th>ID EMPLEADO</th> 
											            <th>NOMBRE Y APELLIDO</th>
											            <th>SUPERVISOR</th> 
											            <!--<th>CAMPAÑA</th> -->
											            <th>CARGO</th>
											            <!-- <th>APELLIDO</th> -->
											            <th>FECHA</th>
											            <th>TIEMPO READY</th>
											            <!-- -->
											            <th>BREAK</th>
											            <th>BAÑO</th>
											            <th>ENTRENAMIENTO</th>
											            <th>FEED BACK</th>
											            <th>LLAMADAS SALIENTES</th>
											            <th>HORA INICIO SESIÓN</th>
											            <th>HORA FINAL SESIÓN</th> 
											           <!-- <th>TIEMPO TOTAL (HIni - HFin)</th>-->
											            <th>TIEMPO CONEXIÓN</th>
											            <th>ACCIONES</th>
											            <th style="display:none;">ESTATUS</th>          
											          </tr>
											        </thead>
											        <tbody>';
											            if ($consultar) {
											            	foreach ($consultar as $consult) {
											            		if ($consult['break'] >= $timerMaxBreak) {
											            			$cssBR = 'style= "color:red; font-weight:700;"';
											            		}else{
											            			$cssBR = '';
											            		}

											            		if ($consult['entrenamiento'] >= $timerMaxEntre) {
											            			$cssEN = 'style= "color:red; font-weight:700;"';
											            		}else{
											            			$cssEN = '';
											            		}

											            		if ($consult['bath'] >= $timerMaxBA_FB_LL) {
											            			$cssBA = 'style= "color:red; font-weight:700;"';
											            		}else{
											            			$cssBA = '';
											            		}

											            		if ($consult['feek_back'] >= $timerMaxBA_FB_LL) {
											            			$cssFB = 'style= "color:red; font-weight:700;"';
											            		}else{
											            			$cssFB = '';
											            		}

											            		if ($consult['llamada_saliente'] >= $timerMaxBA_FB_LL) {
											            			$cssLL = 'style= "color:red; font-weight:700;"';
											            		}else{
											            			$cssLL = '';
											            		}
						$json['result'] = $json['result'].'	<tr>
												              	<!--<td>'. $consult['id_registro'] .'</td>-->
												              	<td>'. $consult['id_datos_empleados'] .'</td>
												              	<td>'. $consult['nombre'].' '.$consult['apellido'] .' <font style="color: #01368a;font-weight: 700;">('.$consult['campana'].')</font> </td>';
																	if ($consult['supervisor'] != 0) {
												            			for ($d=0; $d < count($consultarSupervisores) ; $d++) { 
												            				if ( $consult['supervisor'] == $consultarSupervisores[$d]['id_datos_empleados']) {
						$json['result'] = $json['result'].'		<td>'. $consultarSupervisores[$d]['nombre'].' '.$consultarSupervisores[$d]['apellido'] .'</td>';
																			}
											            				}
											            			}else{
						$json['result'] = $json['result'].'		<td> </td>';
											            			} 
						$json['result'] = $json['result'].'  	
																<!-- <td>'. $consult['campana'] .'</td> -->
																<td>'. $consult['cargo'] .'</td>
											              		<!-- <td>'. $consult['supervisor'] .'</td> 
											              		<td>'. $consult['name_campana'] .'</td>-->
											              		<td>'. $consult['dia'] .'</td>
											              		<td>'. $consult['tiempo_ready'] .'</td>';
											              			if ( $consult['estatusBR'] == 1) {
						$json['result'] = $json['result'].'		<td '.$cssBR.'><strong class="btn btn-outline-primary">'. $consult['break'] .'</strong></td>';				    
											              			}else{
						$json['result'] = $json['result'].'		<td '.$cssBR.'>'. $consult['break'] .'</td>';				              			
											              			}
											              			if ( $consult['estatusBA'] == 1) { 
						$json['result'] = $json['result'].'		<td '.$cssBA.'><strong class="btn btn-outline-primary">'. $consult['bath'] .'</strong></td>';				    
											              			}else{
						$json['result'] = $json['result'].'		<td '.$cssBA.'>'. $consult['bath'] .'</td>';				              			
											              			}
											              			if ( $consult['estatusEN'] == 1) {
						$json['result'] = $json['result'].'		<td '.$cssEN.'><strong class="btn btn-outline-primary">'. $consult['entrenamiento'] .'</strong></td>';
											              			}else{
						$json['result'] = $json['result'].'		<td '.$cssEN.'>'. $consult['entrenamiento'] .'</td>';				              			
											              			}
											              			if ( $consult['estatusFB'] == 1) {
						$json['result'] = $json['result'].'		<td '.$cssFB.'><strong class="btn btn-outline-primary">'. $consult['feek_back'] .'</strong></td>';				
											              			}else{
						$json['result'] = $json['result'].'		<td '.$cssFB.'>'. $consult['feek_back'] .'</td>';				              			
											              			}
											              			if ( $consult['estatusLL'] == 1) {
						$json['result'] = $json['result'].'		<td '.$cssLL.'><strong class="btn btn-outline-primary">'. $consult['llamada_saliente'] .'</strong></td>';	
											              			}else{
						$json['result'] = $json['result'].'		<td '.$cssLL.'>'. $consult['llamada_saliente'] .'</td>';				              			
											              			}											              		
						$json['result'] = $json['result'].'		<td>'. $consult['hora_inicio'] .'</td>
											              		<td>'. $consult['hora_fin'] .'</td>';
																//$duracion = RestarHoras($consult['hora_inicio'],$consult['hora_fin']);  
						$json['result'] = $json['result'].'		<!--<td>'.$duracion.'</td>  -->   ';
															  	$cosultaHistoric = $conexion->TotalHistoric($fechaHoy, $consult['id_datos_empleados']);	
																if ($cosultaHistoric) {//echo'shi <br>';
																	$restatimer = array();
																	if ( count($cosultaHistoric) > 1) {
																		for ($j=0; $j < count($cosultaHistoric) ; $j++) {  
																			if ($cosultaHistoric[$j]['horaInicio'] == '0') {
																				$HoraInicio = '00:00:00';
																			}else{
																				$HoraInicio = $cosultaHistoric[$j]['horaInicio'];
																			}
																			if ($cosultaHistoric[$j]['horaFin'] == '0') {
																				$HoraFin = '00:00:00';
																			}else{
																				$HoraFin = $cosultaHistoric[$j]['horaFin'];
																			}																		
																			//echo '<br> '. $cosultaHistoric[$j]['horaInicio'].' --> '.$cosultaHistoric[$j]['horaFin'].' --> '.$cosultaHistoric[$j]['fechaHistori'].' --> '.$cosultaHistoric[$j]['estatus'].'<br><br>';
																			$restatimer[] = RestarHoras($HoraInicio, $HoraFin); 
																		}
																		$sumaTimer = sumarHoras($restatimer);  //echo'<br> Tiempo de Gestión REAL: '.$sumaTimer.'<br><br>';
																	}else{
																		if ($cosultaHistoric[0]['horaInicio'] == '0') {
																			$HoraInicio = '00:00:00';
																		}else{
																			$HoraInicio = $cosultaHistoric[0]['horaInicio'];
																		}
																		if ($cosultaHistoric[0]['horaFin'] == '0') {
																			$HoraFin = '00:00:00';
																		}else{
																			$HoraFin = $cosultaHistoric[0]['horaFin'];
																		}
																		//echo $HoraInicio. ' ==> '. $HoraFin.'<br>';
																		$sumaTimer = RestarHoras($HoraInicio, $HoraFin);  
																	}
																}else{ //echo'shiNOP <br>';
																	$sumaTimer = '00:00:00'; 
																}
						$json['result'] = $json['result'].'		<td style="color: #169b6b; font-weight:500;" >'.$sumaTimer.'</td>  
																<td><button '.$classButton.' onclick="cancelar_sesion('.$consult['id_datos_empleados'].')" class="btn ';
											              		if ($consult['estatusSesion'] == 1 	|| $consult['estatusSesion'] == 0) {
						$json['result'] = $json['result'].'			btn-success';					              		
											              		}else{
						$json['result'] = $json['result'].'			btn-danger';					              		
																}
						$json['result'] = $json['result'].'	
											            		btn-icon-split btn-sm" data-toggle="modal" data-target="#cierreDeSesion"><span class="icon text-white-50"><i class="fas fa-sign-out-alt"></i></span></button></td>
											            		<td style="display:none;">'.$consult['estatusSesion'].'</td>
											            	</tr>';/**/
											        		} 
											        	}
						$json['result'] = $json['result'].'						
													</tbody>
						      					</table>';
						$json['response'] = 'true';
						echo json_encode($json);/**/

				    }else{
				    	$json['result'] = ' No hay datos del día de hoy.';
						$json['response'] = 'false';
						echo json_encode($json);
				    }
				break;
	#-------------------------------------------------------------------------------------------	
				case 'consulta__':
					$as  = 	$_POST['id_empleado'];  

					$consultar_ = $conexion->updateSesion($as);	
				break;




	#-------------------------------------------------------------------------------------------
	#-------------------------------------------------------------------------------------------
	#-------------------------------------------------------------------------------------------	
				case 'contadorCampanasxServicio':
					$fechaHoy 		 = date("Y-m-d");

					$servicioSession = $_POST['valorServicio'];   //  $_POST['valorServicio'];			//$_SESSION['id_servicio'];
					$consultar1 	 = $conexion->idServicio($servicioSession);

					$idService 		 = $consultar1[0]['idServicio'];
					$consultar_ 	 = $conexion->campanasDelService($idService);

					if ($consultar_) {
						foreach ($consultar_ as $key) {
							//echo $key['id_campana']. ' ' .$key['name_campana']. ' ' .$key['abrev_campana']. '<br><br><br>';
							$queryContcampana = $queryContcampana. "SELECT count(*) as contadorCampana FROM datos_empleados INNER JOIN registro ON registro.id_usuario = datos_empleados.id_datos_empleados WHERE datos_empleados.servicio ='".$servicioSession."' AND datos_empleados.estatusSesion = 1 AND registro.dia ='".$fechaHoy."' AND datos_empleados.campana ='".$key['abrev_campana']."' UNION ALL ";
						}
					}
					$queryContcampana = rtrim($queryContcampana, ' UNION ALL ');
					//echo $queryContcampana.'<br><br>';

					$consultar2 	 = $conexion->contCampanaxService($queryContcampana);

					//echo '<br><br> '.$consultar2[0]['contadorCampana']. ' --> '.$consultar2[1]['contadorCampana']. ' --> '.$consultar2[2]['contadorCampana']. ' --> '.$consultar2[3]['contadorCampana']. ' --> '.$consultar2[4]['contadorCampana']. ' --> '.$consultar2[5]['contadorCampana']. ' --> '.$consultar2[6]['contadorCampana']. ' --> '.$consultar2[7]['contadorCampana']. ' --> '.$consultar2[8]['contadorCampana']. ' --> '.$consultar2[9]['contadorCampana']. '<br>';					

					if ($consultar_) {
						if ($consultar2) {
							$sumaTOTAL = 0;
							
							$json['result'] = $json['result'].  '<div class="row">';
							for ($i=0; $i < count($consultar2) ; $i++) { 	
								$sumaTOTAL = ($sumaTOTAL + $consultar2[$i]['contadorCampana']);
								$json['result'] = 	$json['result']. '														
							      						<div class="col-4" style = "text-align: center;	" >
							            					<label style="color: #000; font-weight:500; border-bottom: 1px solid #169b6b;" for="" class="visually-hidden">'.strtoupper($consultar_[$i]['name_campana']).': '.$consultar2[$i]['contadorCampana'].'</label>
							          					</div><br><br>';
							}	

							$json['result'] 	= 	$json['result']. '</div>';
							$json['response'] 	= 	'true';
							echo json_encode($json);
						}
					}else{
						$json['result'] = ' No hay datos del día de hoy.';
						$json['response'] = 'false';
						echo json_encode($json);
					}/**/
				break;
	
	#-------------------------------------------------------------------------------------------	
	#-------------------------------------------------------------------------------------------
				default:
					header('location:'.HTML_DIR.'error.html');
				break;		
			}	
		}
	}
}
?>