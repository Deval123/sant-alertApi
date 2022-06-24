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
////	consultation_id	datecreate	ta	db	bg	pouls	taille	ddr	dpa	tension
$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
		$datecreate = $request->datecreate;
		$ta = $request->ta;
        $db = $request->db;
        $bg = $request->bg;
        $pouls = $request->pouls;
        $ddr = $request->ddr;
        $taille = $request->taille;
        $dpa = $request->dpa;
        $poids = $request->poids;
        $tension = $request->tension;
        $consultation = $request->consultation;
        $consultation_id = $consultation[0]->id;
        $personel = $request->personel;
        $personel_id = $personel[0]->id;
	}

    $sql = "INSERT INTO parametres (consultation_id, datecreate, ta, db, bg, pouls, taille, ddr, dpa, tension, personelEts_id, poids)
VALUES ('$consultation_id', '$datecreate', '$ta', '$db', '$bg', '$taille', '$pouls', '$ddr', '$dpa', '$tension', '$personel_id', '$poids')";


    if ($con->query($sql) === TRUE) {
        $response= "Successfull";

    } else {
        $response= "Error:";
    }
  
	echo json_encode( $response);

?>
