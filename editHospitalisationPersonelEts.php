<?php
/**
 * Created by PhpStorm.
 * User: Kamguia
 * Date: 21/11/2018
 * Time: 06:15
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
//id	patients_id	consultation_id	nom	date_prescription	date_reel	resultat	cout	observation	personelEts_id

$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
        $id = $request->id;
		$patients_id = $request->patients_id;
		$consultation_id = $request->consultation_id;
		$date_entree = $request->date_entree;
		$date_sortie = $request->date_sortie;
		$nom_hopital = $request->nom_hopital;
        $diagnostique = $request->diagnostique;

        $observation = $request->observation;
        $personelEts_id = $request->personelEts_id;

        $newpatients_id = $request->newpatients_id;
        $newconsultation_id = $request->newconsultation_id;
        $newnom = $request->newnom;
        $newdate_prescription = $request->newdate_prescription;
        $newdate_reel = $request->newdate_reel;
        $newdate_prescription = $request->newdate_prescription;
        $newcout = $request->newcout;
        $newobservation = $request->newobservation;
        $newpersonelEts_id = $request->newpersonelEts_id;
	}
//id	patients_id	consultation_id	date_entree	date_sortie	nom_hopital	causes	diagnostique	cout	personelEts_id

$sql = "UPDATE hospitalisation SET nom = '$newnom', patients_id = '$newpatients_id', consultation_id = '$newconsultation_id',
  date_prescription = '$newdate_prescription', observation = '$newobservation', cout = '$newcout', personelEts_id = '$newpersonelEts_id', 
  date_reel = '$newdate_reel' , diagnostique = '$newdiagnostique' WHERE id ='$id';";


    if ($con->query($sql) === TRUE) {
        $response= "data update successfull";

    } else {
        $response= "Error:";///. $sql . “<br>” . $con->error;
    }
  
	echo json_encode( $response);

 
?>
