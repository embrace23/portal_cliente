<?php
//header("Content-Type: text/html;charset=utf-8");
$servername = "db5015283001.hosting-data.io";
$username = "dbu4149991";
$password = "Embrace2024!";
$dbname = "dbs12584072";
$con = mysqli_connect($servername, $username, $password) or die("No se ha podido conectar al Servidor");
mysqli_query($con,"SET SESSION collation_connection ='utf8_unicode_ci'");
$db = mysqli_select_db($con, $dbname) or die("Upps! Error en conectar a la Base de Datos");

?>