<?php
require('config.php');
$tipo = $_FILES['archivo']['type'];
$tamanio = $_FILES['archivo']['size'];
$archivotmp = $_FILES['archivo']['tmp_name'];
$lineas = file($archivotmp);

$i = 0;

foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados =  ($cantidad_registros - 1);

    if ($i != 0) {

        $datos = explode(",", $linea);
       
        $nombre = !empty($datos[0])  ? ($datos[0]) : '';
		$apellido = !empty($datos[1])  ? ($datos[1]) : '';
        $fecha_nacimiento = !empty($datos[2])  ? ($datos[2]) : '';
        $plan = !empty($datos[3]) ? ($datos[3]) : '';

        $cant_duplicidad = 0;

       
        if( !empty($apellido) ){
            $checkemail_duplicidad = ("SELECT apellido FROM pax WHERE apellido='".($apellido)."' ");
            $ca_dupli = mysqli_query($con, $checkemail_duplicidad);
            $cant_duplicidad = mysqli_num_rows($ca_dupli);
        }   

        //No existe Registros Duplicados
        if ( $cant_duplicidad == 0 ) { 

            $insertarData = "INSERT INTO pax( 
            nombre,
                apellido,
                fecha_nacimiento,
                plan
            ) VALUES(
                '$nombre',
                '$apellido',
                '$fecha_nacimiento',
                '$plan'
            )";
            mysqli_query($con, $insertarData);
                    
        } 
        /**Caso Contrario actualizo el o los Registros ya existentes*/
        else{
            $updateData =  ("UPDATE pax SET 
                nombre='" .$nombre. "',
                apellido='" .$apellido. "',
                fecha_nacimiento='" .$fecha_nacimiento. "',
                plan='" .$plan. "'
                WHERE apellido='".$apellido."'
            ");
            $result_update = mysqli_query($con, $updateData);
        } 
    }

$i++;
}

?>

<a href="index.php">Atras</a>