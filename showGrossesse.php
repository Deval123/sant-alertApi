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
 
	}
//$password = stripslashes($password);

$sql ="SELECT * FROM grossesse WHERE patients_id = '$patient_id' ;";

$result = mysqli_query($con, $sql);

$response = array();

while($row = mysqli_fetch_array($result))
{
array_push($response, array("id"=>stripslashes($row[0]),
						  "patients_id"=>stripslashes($row[1]),
						  "date_debut"=>stripslashes($row[2]),
						 "rang"=>stripslashes($row[3]),
						"date_accouchement"=>stripslashes($row[4]),
						"note"=>stripslashes($row[5]),
                       "type_accouchement"=>stripslashes($row[6]),
                      "verdict"=>stripslashes($row[7]),
                    "observation"=>stripslashes($row[8])));

}
//	id	patients_id	date_debut	rang	date_accouchement	note	type_accouchement	verdict

echo json_encode(array("server_response"=> $response));
//mysqli_close($DB)

?>