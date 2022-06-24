<?php
require_once ("conn.php");
$ps=$pdo->prepare("SELECT * FROM pharmacie ORDER BY nom ASC ;");
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
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json; charset=utf-8");
echo json_encode(array("server_response"=> $data));

?>