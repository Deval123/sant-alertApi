<?php
/**
 * Created by PhpStorm.
 * User: devalere
 * Date: 28/01/2019
 * Time: 12:41
 */

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
        header("Content-Type: application/json; charset=utf-8");

//id, patients_id, nom_medecin, image, particularite, datecreate, lieu

        include "configuration.php";
        $postjson = json_decode(file_get_contents('php://input'), true);
        if($postjson['aksi'] == 'add_consult'){
            $dev = $postjson['patients_id'];
            $data = array();
            // $datetimenow = date('Y-m-d H:i:s');
            $datenow = date('Y-m-d H-i-s');// use to remove duplicate name of  images
            $entry = base64_decode($postjson['image']);
            $img = imagecreatefromstring($entry);
            $directory = "images/consultation/consult_user".$dev.'_'.$datenow.".jpg"; // save image to folder sever
            imagejpeg($img, $directory);
            imagedestroy($img);
            $query = mysqli_query($mysqli, "INSERT INTO consultation SET 
                patients_id = '$postjson[patients_id]',
                nom_medecin = '$postjson[nom_medecin]',
                particularite = '$postjson[particularite]',
                lieu = '$postjson[lieu]',
                cout = '$postjson[cout]',
                image  = '$directory',
                datecreate = '$datenow'
                ");
            $idadd = mysqli_insert_id($mysqli);
            if($query) $result = json_encode(array('success' => true, 'idadd' => $idadd));
            else $result = json_encode(array('success' => false));
            echo $result;
        }


