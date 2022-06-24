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
		$consultation = $request->consultation;
        $consultation_id = $request->consultation[0]->id;
        $date_entree = $request->date_entree;
		$date_sortie = $request->date_sortie;
		$hopital = $request->hopital;
        $nom_hopital = $request->hopital[0]->id;
        $causes = $request->causes;
        $diagnostique = $request->diagnostique;
        $medecinTraitant = $request->medecinTraitant;
        $recommandationsAlimentaire = $request->recommandationsAlimentaire;
        $numeroChambre = $request->numeroChambre;
        $numeroDossier = $request->numeroDossier;
        $particularités = $request->particularités;
        $symptomes = $request->symptomes;
        $personelEts = $request->personel;
        $personelEts_id = $personelEts[0]->id;
        $patients_id = $request->patients_id;

    }

//id	patients_id	consultation_id	date_entree	date_sortie	nom_hopital	causes	diagnostique	medecinTraitant	recommandationsAlimentaire	numeroChambre	numeroLit	numeroDossier	particularités	personelEts_id	symptomes


$sql = "INSERT INTO hospitalisation (patients_id, consultation_id, date_entree, date_sortie, nom_hopital, causes, diagnostique, medecinTraitant, medecinTraitant, recommandationsAlimentaire, numeroChambre, numeroLit, numeroDossier, particularités, personelEts_id, symptomes)
VALUES ('$patients_id', '$consultation_id', '$date_entree', '$date_sortie', '$nom_hopital', '$causes', '$diagnostique', '$medecinTraitant', '$recommandationsAlimentaire', '$numeroChambre', '$numeroLit', '$numeroDossier', '$particularités', '$personelEts_id', '$symptomes')";


if ($con->query($sql) === TRUE) {
    $response= "Successfull";

    $sql1 ="SELECT * FROM  hospitalisation WHERE patients_id = '$patients_id' and date_entree='$date_entree';";
    $result1 = mysqli_query($con, $sql1);
    $res = array();
    while($row = mysqli_fetch_array($result1))
    {

        array_push($res, array("id"=>$row[0],
                            "patients_id"=>$row[1],
                            "consultation_id"=>$row[2],
                            "date_entree"=>$row[3],
                            "date_sortie"=>$row[4],
                            "nom_hopital"=>$row[5],
                            "causes"=>$row[6],
                            "diagnostique"=>$row[7],
                            "medecinTraitant"=>$row[8],
                            "recommandationsAlimentaire"=>$row[9],
                            "numeroChambre"=>$row[10],
                            "numeroLit"=>$row[11],
                            "numeroDossier"=>$row[12],
                            "particularités"=>$row[13],
                            "personelEts_id"=>$row[14],
                            "symptomes"=>$row[15]));

    }


} else {
    $response= "Error: ";
}

  /*  if ($con->query($sql) === TRUE) {
        $response= "Successfull";

    } else {
        $response= "Error: ". $sql . "<br>" . $db->error;
    }*/
  
	//echo json_encode( $response);
echo json_encode(array("server_response"=> $response, "hospitalisation"=> $res));

 
?>
