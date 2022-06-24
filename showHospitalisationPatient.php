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

//$image $lieuExamen $datecreate
require_once ("conn.php");

$data = file_get_contents("php://input");
if (isset($data)) {
    $request = json_decode($data);
    $patient = $request->patients;
    $patient_id = $patient[0]->id;

}

$ps=$pdo->prepare("SELECT * FROM hospitalisation WHERE patients_id ='$patient_id' ORDER BY datecreate DESC ;");
$ps->execute();
$liste=$ps->fetchAll(PDO::FETCH_ASSOC);
// header("Access-Control-Allow-Origin : *");
// header("Content-Type:application/json; charset=utf-8");
// echo (json_encode($liste));

// pour resoudre le problÃ¨me des accents pour json-encode
$data=array();
foreach ($liste as $i=>$v){
    $fields=array();
    foreach ($v as $key=>$value){
        $fields[$key] = utf8_encode($value);
    }
    $data[$i]=$fields;
}
echo json_encode(array("server_response"=> $data));

?>