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


        include "config.php";
        $postjson = json_decode(file_get_contents('php://input'), true);
        if($postjson['aksi'] == 'add_user'){
            $data = array();
            $datenow = date('y-m-d');
            $datenow1 = date('Y-m-d H-i-s');// use to remove duplicate name of  images
            $entry = base64_decode($postjson['images']);
            $img = imagecreatefromstring($entry);
            $directory = "images/img_user".$datenow1.".jpg"; // save gambar to folder sever
            imagejpeg($img, $directory);
            imagedestroy($img);
            $query = mysqli_query($mysqli, "INSERT INTO master_user SET 
                user_name = '$postjson[user_name]',
                phone_number = '$postjson[phone_number]',
                gender = '$postjson[gender]',
                images  = '$directory',
                created_at = '$datenow' 
                ");
            $idadd = mysqli_insert_id($mysqli);
            if($query) $result = json_encode(array('success' => true, 'idadd' => $idadd));
            else $result = json_encode(array('success' => false));
            echo $result;
        }
        elseif($postjson['aksi'] == 'get_user'){
            $data = array();
            $query = mysqli_query($mysqli, "SELECT * FROM master_user ORDER BY user_id DESC");

        while($row = mysqli_fetch_array($query)) {
            $data[] = array(
                'user_id' => $row['user_id'],
                'user_name' =>  $row['user_name'],
                'phone_number' =>  $row['phone_number'],
                'gender' =>  $row['gender'],
                'images' => $row['images'],
                'created_at' =>  $row['created_at'],
            );
         }
        if($query) $result = json_encode(array('success' => true, 'result' => $data));
        else $result = json_encode(array('success' => false));
        echo $result;
    }
        elseif($postjson['aksi'] == 'update_user'){
            $data = array();
            $query = mysqli_query($mysqli, "UPDATE master_user SET 
                user_name = '$postjson[user_name]',
                phone_number = '$postjson[phone_number]',
                gender = '$postjson[gender]' 
                WHERE  user_id='$postjson[user_id]'");

            if($query) $result = json_encode(array('success' => true));
            else $result = json_encode(array('success' => false));
            echo $result;
        }
        elseif($postjson['aksi'] == 'del_user'){
            $query = mysqli_query($mysqli, "DELETE FROM master_user WHERE  user_id='$postjson[user_id]'");

            if($query) $result = json_encode(array('success' => true));
            else $result = json_encode(array('success' => false));
            echo $result;
        }

        elseif($postjson['aksi'] == 'get_datasingle'){
            $data = array();
            $query = mysqli_query($mysqli, "SELECT * FROM master_user WHERE user_id='$postjson[user_id]'");

            while($row = mysqli_fetch_array($query)) {
                $data = array(
                    'user_name'      =>  '$row[user_name]',
                    'phone_number'   =>  '$row[phone_number]',
                    'gender'         =>  '$row[gender]',
                    'created_at'     =>  '$row[created_at]',
                );
            }
            if($query) $result = json_encode(array('success' => true, 'result' => $data));
            else $result = json_encode(array('success' => false));
            echo $result;
        }

