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
		$nature = $request->nature;
		$lieu = $request->lieu;
		$observation = $request->observation;
        $tiers = $request->tiers;
        /*$mobile = $request->mobile;*/
        $patient = $request->patient;
        $personel = $request->personel;
        $personelEts_id = $personel[0]->id;
	}


$sql = "SELECT id FROM patients where nom = '$patient' ";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$patients = $row['id'];
$count = mysqli_num_rows($result);
if($count == 0) {
$response= "Error, this person do not exist";

}else {
    $sqli = "INSERT INTO patientsagenda (patients_id, datedebut, datefin, nature, lieu, observation, tiers, personelEts_id)
VALUES ('$patients', '$datedebut', '$datefin', '$nature', '$lieu', '$observation', '$tiers', '$personelEts_id')";

if ($con->query($sqli) === TRUE) {
    $response= "Successfull";

} else {
    $response= "Error, register failled";
}

}

/*
///////	patients_id	datedebut	datefin	nature	lieu	observation tiers personelEts_id
    $sql = "INSERT INTO patientsagenda (patients_id, datedebut, datefin, nature, lieu, observation, tiers, personelEts_id)
VALUES ('$patient_id', '$datedebut', '$datefin', '$nature', '$lieu', '$observation', '$tiers', '$personelEts_id')";


    if ($con->query($sql) === TRUE) {
        $response= "Successfull";

    } else {
        $response= "Error: ";
    }
  */
	echo json_encode( $response);

 
?>
