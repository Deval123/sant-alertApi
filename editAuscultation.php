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
//id	patients_id	consultation_id	nom	date_prescription	date_reel	resultat	cout	observation	personelEts_id

$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
        $id = $request->id;
		$patients_id = $request->patients_id;
		$consultation_id = $request->consultation_id;

        $personelEts_id = $request->personelEts_id;

        $newpatients_id = $request->newpatients_id;
        $newconsultation_id = $request->newconsultation_id;

	}

$sql = "UPDATE auscultation SET nom = '$newnom', patients_id = '$newpatients_id', consultation_id = '$newconsultation_id',
  date_prescription = '$newdate_prescription', observation = '$newobservation', cout = '$newcout', personelEts_id = '$newpersonelEts_id', 
  date_reel = '$newdate_reel' WHERE id ='$id';";


    if ($con->query($sql) === TRUE) {
        $response= "data update successfull";

    } else {
        $response= "Error:";///. $sql . “<br>” . $con->error;
    }
  
	echo json_encode( $response);

 
?>
