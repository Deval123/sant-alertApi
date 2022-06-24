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
        $regime_id = $request->id;
	}
//regime_id	poids	dateParam	temperature	tension	observation

$sql ="SELECT * FROM  param_regime WHERE regime_id = '$regime_id';";

$result = mysqli_query($con, $sql);

$response = array();

while($row = mysqli_fetch_array($result))
{
array_push($response, array("id"=>$row[0],
						  "regime_id"=>$row[1],
						 "poids"=>$row[2],
						"dateParam"=>$row[3],
						"temperature"=>$row[4],
                       "tension"=>$row[5],
                      "observation"=>$row[6]));

}

echo json_encode(array("server_response"=> $response));
//mysqli_close($DB)

?>