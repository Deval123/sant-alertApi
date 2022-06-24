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
		$nom = $request->nom;
		$medecin_traitant = $request->medecin_traitant;
		$restriction = $request->restriction;
		$recommandation = $request->recommandation;
		$commentaire = $request->commentaire;
        $patient = $request->patients;
        $patient_id = $patient[0]->id;
	}

///id	patients_id	nom	medecin_traitant	restriction	recommandation	commentaire
    $sql = "INSERT INTO maladie_chronique (patients_id, nom, medecin_traitant, restriction, recommandation, commentaire)
VALUES ('$patient_id', '$nom', '$medecin_traitant', '$restriction', '$recommandation', '$commentaire')";


    if ($con->query($sql) === TRUE) {
        $response= "Successfull";

    } else {
        $response= "Error:";
    }
  
	echo json_encode( $response);

 
?>
