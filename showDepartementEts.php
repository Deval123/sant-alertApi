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
        $code = json_decode($data);
        //$code = $request->code1;
		//$password = $request->password;
         //$etablissement_id = $code->id;

	}


$sql = "SELECT id FROM etablissement where code = '$data'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$etablissement_id = $row['id'];
$count = mysqli_num_rows($result);
if($count == 0) {
    $response= "Error, don't exist";

}else {
    $sql1 ="SELECT * FROM  departement WHERE etablissement_id = '$etablissement_id' ;";
//etablissement_id	nom	description

    $result = mysqli_query($con, $sql1);
    $response = array();
    while($row = mysqli_fetch_array($result))
    {
        array_push($response, array("id"=>$row[0],
            "etablissement_id"=>$row[1],
            "nom"=>$row[2],
            "description"=>$row[3]));

    }

}



/*$sql ="SELECT * FROM  departement WHERE etablissement_id = '$etablissement_id' ;";
//etablissement_id	nom	description

$result = mysqli_query($con, $sql);
$response = array();
while($row = mysqli_fetch_array($result))
{
array_push($response, array("id"=>$row[0],
						  "etablissement_id"=>$row[1],
									"nom"=>$row[2],
						"description"=>$row[3]));

}*/

echo json_encode(array("server_response"=> $response));
//mysqli_close($DB)

?>