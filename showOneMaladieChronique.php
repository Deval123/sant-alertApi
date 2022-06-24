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
        $patient = $request->patients;
        $patient_id = $patient[0]->id;
        $id = $request->id;
    }

$sql ="SELECT * FROM  maladie_chronique WHERE patients_id = '$patient_id' and id = '$id';";

$result = mysqli_query($con, $sql);

$response = array();

while($row = mysqli_fetch_array($result))
{//

    array_push($response, array("id"=>$row[0],
						  "patients_id"=>$row[1],
						 "nom"=>$row[2],
						"medecin_traitant"=>$row[3],
						"restriction"=>$row[4],
                       "recommandation"=>$row[5],
                      "commentaire"=>$row[6]));
///id	patients_id	nom	medecin_traitant	restriction	recommandation	commentaire

}

echo json_encode(array("server_response"=> $response));
//mysqli_close($DB)

?>