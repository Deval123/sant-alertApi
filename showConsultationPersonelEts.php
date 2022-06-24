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
//intitule	temperature	taille	tension	dateCreate	patients_id	poidsActuel	poidsNormal	imc	tgc	masseMinEraleOsseuse	pourcentageEau	masseMusculaire	evaluationSihouette	tgViscerale

$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
        $personelEts = $request->personelEts;
        $personelEts_id = $personelEts[0]->id;
 
	}

$sql ="SELECT * FROM  consultation WHERE personelEts_id = '$personelEts_id';";

$result = mysqli_query($con, $sql);

$response = array();

while($row = mysqli_fetch_array($result))
{//
//id	patients_id	hopital		nom_medecin	image personelEts_id datecreate

    array_push($response, array("id"=>$row[0],
						  "patients_id"=>$row[1],
						    "hopital"=>$row[2],
                        "nom_medecin"=>$row[3],
                         "image"=>$row[4],
                    "particularite"=>$row[5],
                    "datecreate"=>$row[6],
                     "personelEts_id"=>$row[7],
                    "symptomes"=>$row[8]));

}

echo json_encode(array("server_response"=> $response));
//mysqli_close($DB)

?>