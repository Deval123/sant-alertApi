<?php
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
//	patients_id	datecreate	date_debut	rang	date_accouchement	nom_medecin	nom_hopital	observation

$datenow = date('y-m-d');

$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
        $date_debut = $request->date_debut;
		$rang = $request->rang;
        $date_accouchement = $request->date_accouchement;
		$nom_medecin = $request->nom_medecin;
        $patients_id = $request->patients_id;
        $nom_hopital = $request->nom_hopital;
        $datecreate = $datenow;
	}


    $sql = "INSERT INTO grossesse (patients_id, datecreate, date_debut, rang, date_accouchement, nom_medecin, nom_hopital)
VALUES ('$patients_id', '$datecreate', '$date_debut', '$rang', '$date_accouchement', '$nom_medecin', '$nom_hopital')";


    if ($con->query($sql) === TRUE) {
        $response= "Successfull";

    } else {
        $response= "Error:";
    }
  
	echo json_encode( $response);

 
?>
