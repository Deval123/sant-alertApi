<?php
/**
 * Created by PhpStorm.
 * User: devalere
 * Date: 12/06/2019
 * Time: 14:00
 */

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

require "dbconnect.php";
//////id	consultation_id	contenu

$data = file_get_contents("php://input");
if (isset($data)) {
    $request = json_decode($data);
    $patients_id = $request->patients_id;
    $nom = $request->nom;
    $nom_hopital = $request->nom_hopital;
    $date_realisation = $request->date_realisation;
}
/////patients_id	nom	date_realisation	nom_hopital

$sql = "INSERT INTO vaccin (patients_id, nom, date_realisation, nom_hopital) VALUES 
                ('$patients_id', '$nom', '$date_realisation', '$nom_hopital')";


if ($con->query($sql) === TRUE) {
    $response= "Successfull";

} else {
    $response= "Error:"/*. $sql . "<br>" . $db->error*/;
}

echo json_encode( $response);


?>
