<?php
/**
 * Created by PhpStorm.
 * User: devalere
 * Date: 08/04/2019
 * Time: 11:28
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
$data = file_get_contents("php://input");
if (isset($data)) {
    $request = json_decode($data);
    $chirurgicale = $request->chirurgicale;
    $anesthesie = $request->anesthesie;
    $soinsIntensifs = $request->soinsIntensifs;
    $urgences = $request->urgences;
    $autres = $request->autres;
    $hospitalisation_id = $request->hospitalisation_id;

}


$sql = "INSERT INTO particularites (hospitalisation_id, chirurgicale, anesthesie, soinsIntensifs, urgences, autres)
    VALUES ('$hospitalisation_id', '$chirurgicale', '$anesthesie', '$soinsIntensifs', '$urgences', '$autres')";


    if ($con->query($sql) === TRUE) {
        $response= "Successfull";

    } else {
        $response= "Error:";// . $sql . "<br>" . $db->error;
    }
    echo json_encode( $response);
?>
