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
        //$code = $request->code;
 
	}
//$password = stripslashes($password);

$sql ="SELECT * FROM parametres;";

$result = mysqli_query($con, $sql);

$response = array();

while($row = mysqli_fetch_array($result))
{
array_push($response, array("id"=>stripslashes($row[0]),
						  "consultation_id"=>stripslashes($row[1]),
						  "datecreate"=>stripslashes($row[2]),
						 "ta"=>stripslashes($row[3]),
						"db"=>stripslashes($row[4]),
						"bg"=>stripslashes($row[5]),
                       "pouls"=>stripslashes($row[6]),
                        "taille"=>stripslashes($row[7]),
                        "ddr"=>stripslashes($row[8]),
                        "dpa"=>stripslashes($row[9]),
                        "tension"=>stripslashes($row[10])));

}
////	consultation_id	datecreate	ta	db	bg	pouls	taille	ddr	dpa	tension

echo json_encode(array("server_response"=> $response));
//mysqli_close($DB)

?>