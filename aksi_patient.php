<?php
/**
 * Created by PhpStorm.
 * User: devalere
 * Date: 02/02/2019
 * Time: 06:50
 */

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");

//id, patients_id, nom_medecin, image, particularite, datecreate, lieu

include "configuration.php";
$postjson = json_decode(file_get_contents('php://input'), true);
if($postjson['aksi'] == 'add_patients'){
    $dev = $postjson['patients_id'];
    $data = array();
    $datetimenow = date('Y-m-d H:i:s');
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
                image  = '$directory',
                datecreate = '$datetimenow'
                ");
    $idadd = mysqli_insert_id($mysqli);
    if($query) $result = json_encode(array('success' => true, 'idadd' => $idadd));
    else $result = json_encode(array('success' => false));
    echo $result;
}

    elseif($postjson['aksi'] == 'get_patients'){
        $data = array();
        $query = mysqli_query($mysqli, "SELECT * FROM patients WHERE  id='$postjson[patients_id]' ");

            while($row = mysqli_fetch_array($query)) {
                $data[] = array(
                    'id' => $row['id'],
                    'nom' => $row['nom'],
                    'sexe' =>  $row['sexe'],
                    'telephone' =>  $row['telephone'],
                    'telephone1' =>  $row['telephone1'],
                    'email' => $row['email'],
                    'email1' =>  $row['email1'],
                    'prenom' => $row['prenom'],
                    'anneeNais' =>  $row['anneeNais'],
                    'lieuNais' =>  $row['lieuNais'],
                    'profession' =>  $row['profession'],
                    'lieuService' => $row['lieuService'],
                    'dateCreate' =>  $row['dateCreate'],
                    'telBureau' => $row['telBureau'],
                    'residencePrincipal' =>  $row['residencePrincipal'],
                    'residenceSecondaire' =>  $row['residenceSecondaire'],
                    'nomPere' =>  $row['nomPere'],
                    'telPere' => $row['telPere'],
                    'emailPere' =>  $row['emailPere'],
                    'professionPere' => $row['professionPere'],
                    'quartierPere' =>  $row['quartierPere'],
                    'ruePere' =>  $row['ruePere'],
                    'nomMere' =>  $row['nomMere'],
                    'telMere' => $row['telMere'],
                    'emailMere' =>  $row['emailMere'],
                    'professionMere' => $row['professionMere'],
                    'quartierMere' =>  $row['quartierMere'],
                    'nomTuteur' =>  $row['nomTuteur'],
                    'telTuteur' =>  $row['telTuteur'],
                    'emailTuteur' => $row['emailTuteur'],
                    'rueMere' =>  $row['rueMere'],
                    'professionTuteur' =>  $row['professionTuteur'],
                    'quartierTuteur' => $row['quartierTuteur'],
                    'rueTuteur' =>  $row['rueTuteur'],
                    'proche1' => $row['proche1'],
                    'tel_proche1' =>  $row['tel_proche1'],
                    'emailProche1' =>  $row['emailProche1'],
                    'residenceProche1' =>  $row['residenceProche1'],
                    'professionProche1' => $row['professionProche1'],
                    'proche2' =>  $row['proche2'],
                    'tel_proche2' => $row['tel_proche2'],
                    'emailProche2' =>  $row['emailProche2'],
                    'residenceProche2' =>  $row['residenceProche2'],
                    'professionProche2' =>  $row['professionProche2'],
                    'proche3' => $row['proche3'],
                    'tel_proche3' =>  $row['tel_proche3'],
                    'emailProche3' => $row['emailProche3'],
                    'residenceProche3' =>  $row['residenceProche3'],
                    'professionProche3' =>  $row['professionProche3'],
                    'groupeSanguin' => $row['groupeSanguin'],
                    'allergie' =>  $row['allergie'],
                    'incapacite' =>  $row['incapacite'],
                    'medecinFamille' =>  $row['medecinFamille'],
                    'assurance' => $row['assurance'],
                    'rhesus' =>  $row['rhesus'],
                    'observationPhisyque' => $row['observationPhisyque'],
                    'signeParticulier' =>  $row['signeParticulier'],
                    'filename' =>  $row['filename']
                );
            }
        if($query) $result = json_encode(array('success' => true, 'result' => $data));
        else $result = json_encode(array('success' => false));
        echo $result;
    }

    elseif($postjson['aksi'] == 'update_patients'){
        $dev = $postjson['id'];
        $data = array();
        $datetimenow = date('Y-m-d H:i:s');
        $datenow = date('Y-m-d H-i-s');// use to remove duplicate name of  images
        $entry = base64_decode($postjson['filename']);
        $img = imagecreatefromstring($entry);
        $directory = "images/profil/profil_patient".$dev.'_'.$datenow.".jpg"; // save image to folder sever
        imagejpeg($img, $directory);
        imagedestroy($img);
        $query = mysqli_query($mysqli, "UPDATE patients SET 

                    nom = '$postjson[nom]',
                    sexe = '$postjson[sexe]',
                    telephone = '$postjson[telephone]',
                    telephone1 = '$postjson[telephone1]',
                    email = '$postjson[email]',
                    email1 = '$postjson[email1]',
                    prenom  = '$postjson[prenom]',
                    anneeNais = '$postjson[anneeNais]',
                    lieuNais = '$postjson[lieuNais]',
                    profession  = '$postjson[profession]',
                    lieuService = '$postjson[lieuService]',
                    telBureau  = '$postjson[telBureau]',
                    residencePrincipal = '$postjson[residencePrincipal]',
                    residenceSecondaire = '$postjson[residenceSecondaire]',
                    nomPere = '$postjson[nomPere]',
                    telPere = '$postjson[telPere]',
                    emailPere = '$postjson[emailPere]',
                    professionPere  = '$postjson[professionPere]',
                    quartierPere = '$postjson[quartierPere]',
                    ruePere  = '$postjson[ruePere]',
                    nomMere  = '$postjson[nomMere]',
                    telMere = '$postjson[telMere]',
                    emailMere = '$postjson[emailMere]',
                    professionMere = '$postjson[professionMere]',
                    quartierMere  = '$postjson[quartierMere]',
                    rueMere = '$postjson[rueMere]',
                    nomTuteur = '$postjson[nomTuteur]',
                    telTuteur = '$postjson[telTuteur]',
                    emailTuteur = '$postjson[emailTuteur]',
                    professionTuteur  = '$postjson[professionTuteur]',
                    quartierTuteur = '$postjson[quartierTuteur]',
                    rueTuteur = '$postjson[rueTuteur]',
                    proche1 = '$postjson[proche1]',
                    tel_proche1 = '$postjson[tel_proche1]',
                    emailProche1 = '$postjson[emailProche1]',
                    residenceProche1  = '$postjson[residenceProche1]',
                    professionProche1 = '$postjson[professionProche1]',
                    proche2  = '$postjson[proche2]',
                    tel_proche2 = '$postjson[tel_proche2]',
                    emailProche2 = '$postjson[emailProche2]',
                    residenceProche2 = '$postjson[residenceProche2]',
                    professionProche2  = '$postjson[professionProche2]',
                    proche3 = '$postjson[proche3]',
                    tel_proche3  = '$postjson[tel_proche3]',
                    emailProche3  = '$postjson[emailProche3]',
                    residenceProche3 = '$postjson[residenceProche3]',
                    professionProche3 = '$postjson[professionProche3]',
                    groupeSanguin  = '$postjson[groupeSanguin]',
                    allergie  = '$postjson[allergie]',
                    incapacite = '$postjson[incapacite]',
                    medecinFamille  = '$postjson[medecinFamille]',
                    assurance  = '$postjson[assurance]',
                    rhesus  = '$postjson[rhesus]',
                    observationPhisyque  = '$postjson[observationPhisyque]',
                    signeParticulier  = '$postjson[signeParticulier]',
                    filename = '$directory'
                    WHERE  id='$postjson[id]'");

        if($query) $result = json_encode(array('success' => true));
        else $result = json_encode(array('success' => false));
        echo $result;
    }


elseif($postjson['aksi'] == 'add_infos'){
    $dev = $postjson['id'];
    $data = array();
    $datetimenow = date('Y-m-d H:i:s');
    $datenow = date('Y-m-d H-i-s');// use to remove duplicate name of  images
    $entry = base64_decode($postjson['filename']);
    $img = imagecreatefromstring($entry);
    $directory = "images/profil/profil_patient".$dev.'_'.$datenow.".jpg"; // save image to folder sever
    imagejpeg($img, $directory);
    imagedestroy($img);
    $query = mysqli_query($mysqli, "UPDATE patients SET 
                    groupeSanguin  = '$postjson[groupeSanguin]',
                    allergie  = '$postjson[allergie]',
                    incapacite = '$postjson[incapacite]',
                    medecinFamille  = '$postjson[medecinFamille]',
                    assurance  = '$postjson[assurance]',
                    rhesus  = '$postjson[rhesus]',
                    sexe  = '$postjson[sexe]',
                    observationPhisyque  = '$postjson[observationPhisyque]',
                    signeParticulier  = '$postjson[signeParticulier]',
                    filename = '$directory'
                    WHERE  id='$postjson[id]'");

    if($query) $result = json_encode(array('success' => true));
    else $result = json_encode(array('success' => false));
    echo $result;
}

elseif($postjson['aksi'] == 'add_agendaPatients'){
    $data = array();
    $query = mysqli_query($mysqli, "INSERT INTO patientsagenda SET 
                datedebut = '$postjson[datedebut]',
                datefin = '$postjson[datefin]',
                datefin1 = '$postjson[datefin1]',
                datefin2 = '$postjson[datefin2]',
                datefin3 = '$postjson[datefin3]',
                nature = '$postjson[nature]',
                cout = '$postjson[cout]',
                lieu = '$postjson[lieu]',
                observation = '$postjson[observation]',
                tiers = '$postjson[tiers]',
                patients_id = '$postjson[id]',

                ");
    $idadd = mysqli_insert_id($mysqli);
    if($query) $result = json_encode(array('success' => true, 'idadd' => $idadd));
    else $result = json_encode(array('success' => false));
    echo $result;
}