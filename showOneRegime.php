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
//type_regime	datedebut	poidsDepart	imc	restrictions	taille	patients_id	natureRegime	alimentationRecommande	typeTraitement	dateFin

$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
        $patient = $request->patients;
        $patient_id = $patient[0]->id;
        $id = $request->id;

    }

$sql ="SELECT * FROM  regime WHERE patients_id = '$patient_id' and id = '$id';";

$result = mysqli_query($con, $sql);

$response = array();

while($row = mysqli_fetch_array($result))
{      //

    array_push($response, array("id"=>$row[0],
						  "type_regime"=>$row[1],
						 "datedebut"=>$row[2],
						"poidsDepart"=>$row[3],
						"imc"=>$row[4],
                       "restrictions"=>$row[5],
                      "taille"=>$row[6],
                    "patients_id"=>$row[7],
                    "natureRegime"=>$row[8],
                    "alimentationRecommande"=>$row[9],
                    "typeTraitement"=>$row[10],
                    "dateFin"=>$row[11]));

}

echo json_encode(array("server_response"=> $response));
//mysqli_close($DB)

?>