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
$res = array();

$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
        $nom = $request->username;
		$password = $request->password;
 
	}
//Tiokeng anderson123  nom = '$nom' and password = '$password'

$sql2 = "SELECT departement_id FROM personel_ets WHERE nom = '$nom' and password = '$password' ";
$result = mysqli_query($con,$sql2);
$row = mysqli_fetch_array($result);
$departement_id = $row['departement_id'];
$count = mysqli_num_rows($result);
if($count == 0) {
    $response= "Error, don't exist";

}else {
    $sql1 ="SELECT etablissement_id FROM  departement WHERE id = '$departement_id' ;";
    $result = mysqli_query($con, $sql1);
    $row = mysqli_fetch_array($result);
    $etablissement_id = $row['etablissement_id'];
    $count = mysqli_num_rows($result);
    if($count == 0) {
        $response= "Error, don't exist";

    }else {
        $sql3 ="SELECT * FROM  etablissement WHERE id = '$etablissement_id' ;";
        $result = mysqli_query($con, $sql3);
        $res = array();
        while($row = mysqli_fetch_array($result))
        {
            array_push($res, array("id"=>$row[0],
                "nom"=>stripslashes($row[1]),
                "telephone"=>stripslashes($row[2]),
                "email"=>stripslashes($row[3]),
                "type"=>stripslashes($row[4]),
                "adresse"=>stripslashes($row[5]),
                "ville"=>stripslashes($row[6]),
                "statut"=>stripslashes($row[7]),
                "code"=>stripslashes($row[8])));

        }

  }

}


$sql ="SELECT * FROM  personel_ets WHERE nom = '$nom' and password = '$password' ;";
$result = mysqli_query($con, $sql);
$response = array();
while($row = mysqli_fetch_array($result))
{
array_push($response, array("id"=>$row[0],
						  "nom"=>$row[1],
						 "password"=>$row[2],
                        "matricule"=>$row[3],
						"telephone"=>$row[4],
						"email"=>$row[5],
                       "type_personnel"=>$row[6],
                     "departement_id"=>$row[7]
                    ));

}


echo json_encode(array("personel"=> $response, "etablissement" => $res));
//mysqli_close($DB)

?>