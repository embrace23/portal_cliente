User
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

        $datos = explode(";", $linea);

        $first_name = !empty($datos[0]) ? trim($datos[0]) : '';
        $last_name = !empty($datos[1]) ? trim($datos[1]) : '';
        $date_of_birth = !empty($datos[2]) ? trim($datos[2]) : '';
        $age = !empty($datos[3]) ? trim($datos[3]) : '';
        $document_number = !empty($datos[4]) ? trim($datos[4]) : '';
        $destination = !empty($datos[5]) ? trim($datos[5]) : '';
        $plan = !empty($datos[6]) ? trim($datos[6]) : '';
        $agreement = !empty($datos[7]) ? trim($datos[7]) : '';
        $issuance_country = !empty($datos[8]) ? trim($datos[8]) : '';
        $issuing_date = !empty($datos[9]) ? trim($datos[9]) : '';
        $effective_date = !empty($datos[10]) ? trim($datos[10]) : '';
        $term_date = !empty($datos[11]) ? trim($datos[11]) : '';

        $cant_duplicidad = 0;

        if (!empty($last_name)) {
            $checkemail_duplicidad = "SELECT document_number FROM pax WHERE document_number='" . $document_number . "'";
            $ca_dupli = mysqli_query($con, $checkemail_duplicidad);
            $cant_duplicidad = mysqli_num_rows($ca_dupli);
        }

        // No existe Registros Duplicados
        if ($cant_duplicidad == 0) {

            
            $insertarData = "INSERT INTO pax(
                first_name,
                last_name,
                date_of_birth,
                age,
                document_number,
                destination,
                plan,
                agreement,
                issuance_country,
                issuing_date,
                effective_date,
                term_date
            ) VALUES(
                '$first_name',
                '$last_name',
                '$date_of_birth',
                '$age',
                '$document_number',
                '$destination',
                '$plan',
                '$agreement',
                '$issuance_country',
                '$issuing_date',
                '$effective_date',
                '$term_date'
            )";
            mysqli_query($con, $insertarData);
            
            $tabla_destino = ($agreement == 'Protege Tu Viaje (PTV)') ? 'cliente1' : 'cliente2';
            $insertarTablaIndividual = "INSERT INTO $tabla_destino(
                first_name,
                last_name,
                date_of_birth,
                age,
                document_number,
                destination,
                plan,
                agreement,
                issuance_country,
                issuing_date,
                effective_date,
                term_date
            ) VALUES(
                '$first_name',
                '$last_name',
                '$date_of_birth',
                '$age',
                '$document_number',
                '$destination',
                '$plan',
                '$agreement',
                '$issuance_country',
                '$issuing_date',
                '$effective_date',
                '$term_date'
            )";
            mysqli_query($con, $insertarTablaIndividual);
        } 
        // Caso Contrario actualizo el o los Registros ya existentes
        else {
            $updateData =  "UPDATE pax SET 
                first_name='" . $first_name . "',
                last_name='" . $last_name . "',
                date_of_birth='" . $date_of_birth . "',
                age='" . $age . "',
                destination='" . $destination . "',
                plan='" . $plan . "',
                agreement='" . $agreement . "',
                issuance_country='" . $issuance_country . "',
                issuing_date='" . $issuing_date . "',
                effective_date='" . $effective_date . "',
                term_date='" . $term_date . "'
                WHERE document_number='" . $document_number . "'";
            $result_update = mysqli_query($con, $updateData);

            $tabla_destino = ($agreement == 'Protege Tu Viaje (PTV)') ? 'cliente1' : 'cliente2';
            $updateTablaIndividual =  "UPDATE $tabla_destino SET 
            first_name='" . $first_name . "',
            last_name='" . $last_name . "',
            date_of_birth='" . $date_of_birth . "',
            age='" . $age . "',
            destination='" . $destination . "',
            plan='" . $plan . "',
            agreement='" . $agreement . "',
            issuance_country='" . $issuance_country . "',
            issuing_date='" . $issuing_date . "',
            effective_date='" . $effective_date . "',
            term_date='" . $term_date . "'
            WHERE document_number='" . $document_number . "'";
            $result_updateTablaIndividual = mysqli_query($con, $updateTablaIndividual);
        }
    }

    $i++;
}

?>

<a href="index.php">Atrás</a>