<?php
/**
 * Created by PhpStorm.
 * User: devalere
 * Date: 22/12/2018
 * Time: 16:42
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
        $datedebut = $request->datedebut;
        $datefin = $request->datefin;
        $nature = $request->nature;
        $lieu = $request->lieu;
        $observation = $request->observation;
        $mobile = $request->mobile;
        $patient = $request->patient;
        $nommedecin = $request->nommedecin;
        $personel = $request->personel;
        $personelEts_id = $personel[0]->id;
    }
//id	datedebut	datefin	nature	mobile	patient	lieu	nommedecin	observation	personelEts_id


$sql = "INSERT INTO Rdv (datedebut, datefin, nature, mobile, patient, lieu, nommedecin, observation, personelEts_id)
VALUES ('$datedebut', '$datefin', '$nature', '$mobile', '$patient', '$lieu', '$nommedecin', '$observation', '$personelEts_id')";


if ($con->query($sql) === TRUE) {
    $response= "Successfull";

} else {
    $response= "Error, register failled";
}
	echo json_encode( $response);


?>
