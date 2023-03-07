<?php
include(PUBLIC_DIR.'general/session.php');
if($_SESSION['type_user'] == 2){
	header("location:?view=formulario&mode=index");
}else{
	//if(empty($_SESSION)){header('location:index.php');}else{
		include_once(MODEL_DIR.'asistenciaModel.php');
		$conexion = new database();
		if (isset($_GET['mode'])) {
			switch ($_GET['mode']) {

				case 'index':
					$listUser = $conexion->listUser();
					include(PUBLIC_DIR.'general/header.html');
					include(PUBLIC_DIR.'general/sidebar.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'asistencia/index.php');
					include(PUBLIC_DIR.'general/footer.html');/**/
				break;
		#----------------------------------------------------------	
				case '':
				
				break;
		#----------------------------------------------------------	

				default:
						header('location:'.HTML_DIR.'error.html');
				break;
				}
			}
	//}
}
?>