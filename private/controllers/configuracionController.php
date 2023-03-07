<?php
include(PUBLIC_DIR.'general/session.php');
if($_SESSION['type_user'] == 2){
	header("location:?view=formulario&mode=index");
}else{
	if(empty($_SESSION)){header('location:index.php');}else{
		include_once(MODEL_DIR.'configuracionModel.php');
		$conexion = new database();
		if (isset($_GET['mode'])){
			switch ($_GET['mode']){
				case 'index':

				break;
	#----------------------------------------------------------------------------------------------------------------------
				default:
					header('location:'.HTML_DIR.'error.html');
				break;
			}
		}
	}
}
?>