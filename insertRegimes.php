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
		$type_regime = $request->type_regime;
		$datedebut = $request->datedebut;
		$poidsDepart = $request->poidsDepart;
		$imc = $request->imc;
		$restrictions = $request->restrictions;
        $taille = $request->taille;
        $natureRegime = $request->natureRegime;
        $alimentationRecommande = $request->alimentationRecommande;
        $typeTraitement = $request->typeTraitement;
        $dateFin = $request->dateFin;
        $patient = $request->patients;
        $patient_id = $patient[0]->id;
	}


    $sql = "INSERT INTO regime (type_regime, datedebut, poidsDepart, imc, restrictions, taille, patients_id, natureRegime, alimentationRecommande, typeTraitement, dateFin)
VALUES ('$type_regime', '$datedebut', '$poidsDepart', '$imc', '$restrictions', '$taille', '$patient_id','$natureRegime', '$alimentationRecommande', '$typeTraitement', '$dateFin')";


    if ($con->query($sql) === TRUE) {
        $response= "Successfull";

    } else {
        $response= "Error:";  ///. $sql . "<br>" . $db->error
    }
  
	echo json_encode( $response);

 
?>
