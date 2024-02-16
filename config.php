<?php
//header("Content-Type: text/html;charset=utf-8");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portal";
$con = mysqli_connect($servername, $username, $password) or die("No se ha podido conectar al Servidor");
mysqli_query($con,"SET SESSION collation_connection ='utf8_unicode_ci'");
$db = mysqli_select_db($con, $dbname) or die("Upps! Error en conectar a la Base de Datos");

?>