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
        $patient = $request->patients;
        $patient_id = $patient[0]->id;
        $id = $request->id;

	}

$sql ="SELECT * FROM  bilan WHERE patients_id = '$patient_id' and id = '$id';";

$result = mysqli_query($con, $sql);

$response = array();

while($row = mysqli_fetch_array($result))
{//

    array_push($response, array("id"=>$row[0],
						  "intitule"=>$row[1],
						 "temperature"=>$row[2],
						"taille"=>$row[3],
						"tension"=>$row[4],
                       "datecreate"=>$row[5],
                      "patients_id"=>$row[6],
                    "poidsActuel"=>$row[7],
                    "poidsNormal"=>$row[8],
                    "imc"=>$row[9],
                    "tgc"=>$row[10],
                    "masseMinEraleOsseuse"=>$row[11],
                    "pourcentageEau"=>$row[12],
                    "masseMusculaire"=>$row[13],
                    "evaluationSihouette"=>$row[14],
                    "tgViscerale"=>$row[15]));

}

echo json_encode(array("server_response"=> $response));
//mysqli_close($DB)

?>