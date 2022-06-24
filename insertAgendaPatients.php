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

$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
		$datedebut = $request->datedebut;
		$datefin = $request->datefin;
        $datefin1 = $request->datefin1;
        $datefin2 = $request->datefin2;
        $datefin3 = $request->datefin3;
		$nature = $request->nature;
		$lieu = $request->lieu;
		$observation = $request->observation;
        $tiers = $request->tiers;
        $cout = $request->cout;
        $patient = $request->patients;
        $patient_id = $patient[0]->id;
	}

///////	patients_id	datedebut	datefin	nature	lieu	observation tiers personelEts_id
    $sql = "INSERT INTO patientsagenda (patients_id, datedebut, datefin, nature, lieu, observation, tiers, datefin1, datefin2, datefin3, cout)
VALUES ('$patient_id', '$datedebut', '$datefin', '$nature', '$lieu', '$observation', '$tiers', '$datefin1', '$datefin2', '$datefin3', '$cout')";


    if ($con->query($sql) === TRUE) {
        $response= "Successfull";

    } else {
        $response= "Error:";
    }
  
	echo json_encode( $response);

 
?>
