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
  ///datecreate	symtome	traitement	evaluation	observation	cout_traitement	patients_id

$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
        $id = $request->id;
		$intitule = $request->intitule;
		$temperature = $request->temperature;
		$taille = $request->taille;
		$tension = $request->tension;
		$datecreate = $request->datecreate;
        $poidsActuel = $request->poidsActuel;
        $poidsNormal = $request->poidsNormal;
        $imc = $request->imc;
        $tgc = $request->tgc;
        $masseMinEraleOsseuse = $request->masseMinEraleOsseuse;
        $pourcentageEau = $request->pourcentageEau;
        $masseMusculaire = $request->masseMusculaire;
        $evaluationSihouette = $request->evaluationSihouette;
        $tgViscerale = $request->tgViscerale;


        $newintitule = $request->newintitule;
        $newtemperature = $request->newtemperature;
        $newtaille = $request->newtaille;
        $newtension = $request->newtension;
        $newdatecreate = $request->newdatecreate;
        $newpoidsActuel = $request->newpoidsActuel;
        $newpoidsNormal = $request->newpoidsNormal;
        $newimc = $request->newimc;
        $newtgc = $request->newtgc;
        $newmasseMinEraleOsseuse = $request->newmasseMinEraleOsseuse;
        $newpourcentageEau = $request->newpourcentageEau;
        $newmasseMusculaire = $request->newmasseMusculaire;
        $newevaluationSihouette = $request->newevaluationSihouette;
        $newtgViscerale = $request->newtgViscerale;
	}

$sql = "UPDATE bilan SET intitule = '$newintitule', temperature = '$newtemperature', taille = '$newtaille', tension = '$newtension', dateCreate = '$newdatecreate', poidsActuel = '$newpoidsActuel',
   imc = '$newimc', tgc = '$newtgc', masseMinEraleOsseuse = '$newmasseMinEraleOsseuse', pourcentageEau = '$newpourcentageEau', masseMusculaire = '$newmasseMusculaire', evaluationSihouette = '$newevaluationSihouette',
   tgViscerale = '$newtgViscerale' WHERE id ='$id';";

    if ($con->query($sql) === TRUE) {
        $response= "data update successfull";

    } else {
        $response= "Error:";
    }
  
	echo json_encode($response);

 
?>
