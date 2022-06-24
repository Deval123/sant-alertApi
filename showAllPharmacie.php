<?php
/**
 * Created by PhpStorm.
 * User: devalere
 * Date: 12/02/2019
 * Time: 16:18
 */


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


require_once ("conn.php");
$ps=$pdo->prepare("SELECT * FROM pharmacie WHERE garde = 1 ORDER BY nom ASC ;");
$ps->execute();
$liste=$ps->fetchAll(PDO::FETCH_ASSOC);

$ps1=$pdo->prepare("SELECT * FROM regions ORDER BY name ASC ;");
$ps1->execute();
$liste1=$ps1->fetchAll(PDO::FETCH_ASSOC);

$ps2=$pdo->prepare("SELECT * FROM department ORDER BY name ASC ;");
$ps2->execute();
$liste2=$ps2->fetchAll(PDO::FETCH_ASSOC);

$ps3=$pdo->prepare("SELECT * FROM city ORDER BY name ASC ;");
$ps3->execute();
$liste3=$ps3->fetchAll(PDO::FETCH_ASSOC);
// header("Access-Control-Allow-Origin : *");
// header("Content-Type:application/json; charset=utf-8");
// echo (json_encode($liste));

// pour resoudre le problÃ¨me des accents pour json-encode
$data=array();
$data1=array();
$data2=array();
$data3=array();


foreach ($liste as $i=>$v){
    $fields=array();
    foreach ($v as $key=>$value){
        $fields[$key] = utf8_encode($value);
    }
    $data[$i]=$fields;
}

foreach ($liste1 as $i=>$v){
    $fields=array();
    foreach ($v as $key=>$value){
        $fields[$key] = utf8_encode($value);
    }
    $data1[$i]=$fields;
}

foreach ($liste2 as $i=>$v){
    $fields=array();
    foreach ($v as $key=>$value){
        $fields[$key] = utf8_encode($value);
    }
    $data2[$i]=$fields;
}

foreach ($liste3 as $i=>$v){
    $fields=array();
    foreach ($v as $key=>$value){
        $fields[$key] = utf8_encode($value);
    }
    $data3[$i]=$fields;
}

echo json_encode(array("server_response"=> $data, "server_response1"=> $data1,
    "server_response2"=> $data2, "server_response3"=> $data3));

?>