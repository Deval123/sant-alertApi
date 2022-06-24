<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400'); // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

exit(0);
}

require "dbconnect.php";

$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
       /* $personelEts = $request->personelEts;
        $personelEts_id = $personelEts[0]->id;*/
        $patient = $request->patients;
        $patients_id = $request->$patient[0]->id;
 
	}

$sql ="SELECT * FROM  hospitalisation WHERE patients_id = '$patients_id';";

$result = mysqli_query($con, $sql);

$response = array();

while($row = mysqli_fetch_array($result))
{//

    array_push($response, array("id"=>$row[0],
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
//id	patients_id	consultation_id	date_entree	date_sortie	nom_hopital	causes	diagnostique	medecinTraitant	recommandationsAlimentaire	numeroChambre	numeroLit	numeroDossier	particularités	personelEts_id	symptomes


echo json_encode(array("server_response"=> $response));
//mysqli_close($DB)

?>