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

/////patients_id	nom	date_realisation	nom_hopital images

        include "configuration.php";
        $postjson = json_decode(file_get_contents('php://input'), true);
        if($postjson['aksi'] == 'add_visite'){
            $data = array();
            $datenow = date('y-m-d');
            $datenow1 = date('Y-m-d H-i-s');// use to remove duplicate name of  images
            $entry = base64_decode($postjson['images']);
            $img = imagecreatefromstring($entry);
            $directory = "images/img_visite".$datenow1.".jpg"; // save gambar to folder sever
            imagejpeg($img, $directory);
            imagedestroy($img);
            $query = mysqli_query($mysqli, "INSERT INTO visite SET 
                patients_id = '$postjson[patients_id]',
                nom = '$postjson[nom]',
                date_realisation = '$postjson[date_realisation]',
                nom_hopital = '$postjson[nom_hopital]',
                images  = '$directory'
                ");
            $idadd = mysqli_insert_id($mysqli);
            if($query) $result = json_encode(array('success' => true, 'idadd' => $idadd));
            else $result = json_encode(array('success' => false));
            echo $result;
        }
        elseif($postjson['aksi'] == 'get_visite'){
            $data = array();
            $query = mysqli_query($mysqli, "SELECT * FROM visite ORDER BY id DESC");

        while($row = mysqli_fetch_array($query)) {
            $data[] = array(
                'id' => $row['id'],
                'patients_id' =>  $row['patients_id'],
                'nom' =>  $row['nom'],
                'date_realisation' =>  $row['date_realisation'],
                'nom_hopital' =>  $row['nom_hopital'],
                'images' => $row['images']
            );
         }
        if($query) $result = json_encode(array('success' => true, 'result' => $data));
        else $result = json_encode(array('success' => false));
        echo $result;
    }
        elseif($postjson['aksi'] == 'get_vaccin'){
            $data = array();
            $query = mysqli_query($mysqli, "SELECT * FROM vaccin ORDER BY id DESC");

            while($row = mysqli_fetch_array($query)) {
                $data[] = array(
                    'id' => $row['id'],
                    'patients_id' =>  $row['patients_id'],
                    'nom' =>  $row['nom'],
                    'date_realisation' =>  $row['date_realisation'],
                    'nom_hopital' =>  $row['nom_hopital']
                );
            }
            if($query) $result = json_encode(array('success' => true, 'result' => $data));
            else $result = json_encode(array('success' => false));
            echo $result;
        }
//	patients_id	datecreate	date_debut	rang	date_accouchement	nom_medecin	nom_hopital	observation

        elseif($postjson['aksi'] == 'get_grossesse'){
            $data = array();
            $query = mysqli_query($mysqli, "SELECT * FROM grossesse ORDER BY id DESC");

            while($row = mysqli_fetch_array($query)) {
                $data[] = array(
                    'id' => $row['id'],
                    'patients_id' =>  $row['patients_id'],
                    'datecreate' =>  $row['datecreate'],
                    'date_debut' =>  $row['date_debut'],
                    'rang' =>  $row['rang'],
                    'date_accouchement' =>  $row['date_accouchement'],
                    'nom_medecin' =>  $row['nom_medecin'],
                    'nom_hopital' =>  $row['nom_hopital']
                );
            }
            if($query) $result = json_encode(array('success' => true, 'result' => $data));
            else $result = json_encode(array('success' => false));
            echo $result;
        } elseif ($postjson['aksi'] == '') {
    $ps = $pdo->prepare("SELECT * FROM consultation WHERE (patients_id='$postjson[patients_id]') AND (grossesses_id IS NOT NULL) ORDER BY grossesses_id ASC ;");
    $ps->execute();
    $liste = $ps->fetchAll(PDO::FETCH_ASSOC);
    $data = array();
    foreach ($liste as $i => $v) {
        $fields = array();
        foreach ($v as $key => $value) {
            $fields[$key] = utf8_encode($value);
        }
        $data[$i] = $fields;
    }

    if ($liste) $result = json_encode(array('success' => true, 'result' => $data));
    else $result = json_encode(array('success' => false));
    echo $result;
}

elseif($postjson['aksi'] == 'get_visite_consult'){
    $data = array();
    $query = mysqli_query($mysqli, "SELECT * FROM consultation WHERE (patients_id='$postjson[patients_id]') AND (grossesses_id IS NOT NULL) ORDER BY grossesses_id ASC ;");

    while($row = mysqli_fetch_array($query)) {
        $data[] = array(
            'id' => $row['id'],
            'patients_id' =>  $row['patients_id'],
            'datecreate' =>  $row['datecreate'],
            'hopital' =>  $row['hopital'],
            'grossesses_id' =>  $row['grossesses_id'],
            'personelEts_id' =>  $row['personelEts_id'],
            'nom_medecin' =>  $row['nom_medecin'],
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

