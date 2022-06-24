<?php
/**
 * Created by PhpStorm.
 * User: devalere
 * Date: 08/03/2019
 * Time: 08:17
 */
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");

//$image $lieuExamen $datecreate

include "configuration.php";
$postjson = json_decode(file_get_contents('php://input'), true);
if($postjson['aksi'] == 'add_hospitalisation'){
    $dev = $postjson['patients_id'];
    $data = array();
    $datetimenow = date('Y-m-d H:i:s');
    $datenow = date('Y-m-d H-i-s');// use to remove duplicate name of  images
    $entry = base64_decode($postjson['image']);
    $img = imagecreatefromstring($entry);
    $directory = "images/hospitalisation/hospitalisation_user".$dev.'_'.$datenow.".jpg"; // save image to folder sever
    imagejpeg($img, $directory);
    imagedestroy($img);
    $query = mysqli_query($mysqli, "INSERT INTO hospitalisation SET 
                patients_id = '$postjson[patients_id]',
                lieuHospitalisation = '$postjson[lieuHospitalisation]',
                nature = '$postjson[nature]',
                cout = '$postjson[cout]',
                image  = '$directory',
                datecreate = '$datetimenow'
                ");
    $idadd = mysqli_insert_id($mysqli);
    if($query) $result = json_encode(array('success' => true, 'idadd' => $idadd));
    else $result = json_encode(array('success' => false));
    echo $result;
}


