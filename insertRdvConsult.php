<?php
/**
 * Created by PhpStorm.
 * User: devalere
 * Date: 23/12/2018
 * Time: 15:11
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
        $patients_id = $request->patients_id;
        $consultation = $request->consultation;
        $consultation_id = $consultation[0]->id;
        $personel = $request->personel;
        $personelEts_id = $personel[0]->id;
    }

$sql = "INSERT INTO patientsagenda (patients_id, datedebut, datefin, nature, lieu, observation, personelEts_id, consultation_id)
VALUES ('$patients_id', '$datedebut', '$datefin', '$nature', '$lieu', '$observation', '$personelEts_id', '$consultation_id')";

    if ($con->query($sql) === TRUE) {
        $response= "Successfull";

    } else {
        $response= "Error, failled";
    }

	echo json_encode( $response);


?>
