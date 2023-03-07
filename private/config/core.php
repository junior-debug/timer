<?php

date_default_timezone_set('America/Caracas');

#Constantes de conexión a BDD  
define('DB_HOST','localhost'); 
define('DB_USER','root');
define('DB_PASS',''); //2016prc333+   //D3s4rr0ll0s-
define('DB_NAME','timer');
define('DB_PORT','3306');
/*
#Constantes de conexión a BDD
define('DB_HOST','192.168.10.238');
define('DB_USER','desarrollo');
define('DB_PASS','2016prc333+');
define('DB_NAME','bulksales');
define('DB_PORT','3306');
*/
#Constantes de la APP
define('HTML_DIR','private/views/');
define('MODEL_DIR','private/model/');
define('PUBLIC_DIR','public/');
define('APP_TITLE','TIMER CONTADOR');
define('APP_COPY','Copyright &copy; ' . date('Y',time()));
define('APP_URL','http://localhost/'); 

require('database.php');

?>