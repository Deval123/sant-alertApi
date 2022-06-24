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
$resp = array();
$data = file_get_contents("php://input");
if (isset($data)) {
    $request = json_decode($data);
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
    $numeroLit = $request->numeroLit;
    $symptomes = $request->symptome;
    $personelEts = $request->personel;
    $personelEts_id = $personelEts[0]->id;
    $patients_id = $request->patients_id;

}

//id	patients_id	consultation_id	date_entree	date_sortie	nom_hopital	causes	diagnostique	medecinTraitant	recommandationsAlimentaire	numeroChambre	numeroLit	numeroDossier	particularités	personelEts_id	symptomes

$sql = "INSERT INTO hospitalisation (patients_id, date_entree, date_sortie, nom_hopital, causes, diagnostique, medecinTraitant, recommandationsAlimentaire, numeroChambre, numeroLit, numeroDossier, personelEts_id, symptomes)
VALUES ('$patients_id', '$date_entree', '$date_sortie', '$nom_hopital', '$causes', '$diagnostique', '$medecinTraitant', '$recommandationsAlimentaire', '$numeroChambre', '$numeroLit', '$numeroDossier', '$personelEts_id', '$symptomes')";


    if ($con->query($sql) === TRUE) {
       $sql1 ="SELECT MAX(id)  FROM hospitalisation where patients_id='$patients_id';";
        $result = mysqli_query($con, $sql1);
        while($row = mysqli_fetch_array($result))
        {

            array_push($resp, array(
                "id"=>$row[0]));

        }
        $response= "Successfull";
    } else {
        $response= "Error:";
    }


   // echo json_encode( $response);
echo json_encode(array("server_response"=> $response, "resp"=> $resp));


?>
