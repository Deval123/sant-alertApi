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
    $patient_id = $request->patients_id;
}
require_once ("conn.php");
$ps=$pdo->prepare("SELECT * FROM patients WHERE  id ='$patient_id'");
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

$ps1=$pdo->prepare("SELECT * FROM  maladie_chronique WHERE patients_id = '$patient_id' ;");
$ps1->execute();
$liste1=$ps1->fetchAll(PDO::FETCH_ASSOC);
// header("Access-Control-Allow-Origin : *");
// header("Content-Type:application/json; charset=utf-8");
// echo (json_encode($liste));

// pour resoudre le problÃ¨me des accents pour json-encode
$data1=array();
foreach ($liste1 as $i1=>$v1){
    $fields1=array();
    foreach ($v1 as $key=>$value){
        $fields1[$key] = utf8_encode($value);
    }
    $data1[$i1]=$fields1;
}
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json; charset=utf-8");
echo json_encode(array("infos"=> $data, "maladie"=> $data1));

?>