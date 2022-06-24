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
        //$id = $request->id;
        $personel = $request->personelEts;
        $personelEts_id = $personel[0]->id;
	}

/*SELECT*FROM TABLE ORDER BY ID DESC LIMIT 1
SELECT * FROM TABLE WHERE ID=(SELECT MAX(ID) FROM TABLE)*/
//SELECT*FROM patientsagenda WHERE patients_id=1 ORDER BY id DESC LIMIT 1

$sql = "SELECT * FROM patientsagenda WHERE personelEts_id = '$personelEts_id' ORDER BY id DESC LIMIT 1;";
$result = mysqli_query($con, $sql);

$response = array();
/*id
patients_id
datedebut
datefin
nature
lieu
observation
tiers
personelEts_id*/
while($row = mysqli_fetch_array($result))
{///////	patients_id	datedebut	datefin	nature	lieu	observation

    array_push($response, array("id"=>$row[0],
						  "patients_id"=>$row[1],
						 "datedebut"=>$row[2],
						"datefin"=>$row[3],
						"nature"=>$row[4],
                        "lieu"=>$row[5],
               "observation"=>$row[6],
                "tiers"=>$row[7],
        "personelEts_id"=>$row[8]));

}

echo json_encode(array("server_response"=> $response));
//mysqli_close($DB)

?>