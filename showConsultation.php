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
    ///$personelEts = $request->personelEts;
    ///$personelEts_id = $personelEts[0]->id;
    /// $patient = $request->patients;
    ///$patient_id = $patient[0]->id;
    $password = $request->password;
    $nom = $request->nom;





}

///patients:P, consultation:C, parametres:Pa, auscultation:A, ordonance:O, examen:E, rdv:R
///id, nom, password, telephone, email ,prenom anneeNais lieuNais profession filename
///id patients_id hopital nom_medecin image particularite datecreate personelEts_id symptomes
/// id consultation_id datecreate ta db bg pouls taille ddr dpa tension personelEts_id
///id consultation_id contenu personelEts_id
/// id consultation_id contenu personelEts_id
/// id consultation_id contenu personelEts_id
///id patients_id datedebut datefin nature lieu observation tiers personelEts_id consultation_id
///
///id nom telephone email type adresse ville statut code dateExpiration

///id patients_id hopital nom_medecin image particularite datecreate personelEts_id lieu symptomes


$sql ="SELECT   P.id, P.nom, P.password, P.telephone, P.telephone1, P.email, P.email1, P.prenom, P.anneeNais, P.lieuNais, P.profession, P.filename,
               C.id, C.hopital, C.nom_medecin, C.image, C.particularite, C.datecreate, C.personelEts_id, C.lieu, C.symptomes, C.cout,
               E.nom, E.telephone, E.email, E.type, E.adresse, E.ville, E.statut, E.code, E.dateExpiration,
               Pa.id, Pa.consultation_id, Pa.datecreate, Pa.ta, Pa.db, Pa.bg, Pa.pouls, Pa.taille, Pa.ddr, Pa.dpa, Pa.tension, Pa.personelEts_id,
               A.id, A.consultation_id, A.contenu, A.personelEts_id,
               O.id, O.consultation_id, O.contenu, O.personelEts_id,
               Ex.id, Ex.consultation_id, Ex.contenu, Ex.personelEts_id,
               R.id, R.datedebut, R.datefin, R.nature, R.lieu, R.observation, R.tiers, R.personelEts_id
          FROM     consultation as C   
          LEFT JOIN patients as P ON C.patients_id = P.id  
          LEFT JOIN etablissement as E ON E.id = C.hopital 
          LEFT JOIN parametres as Pa ON Pa.consultation_id = C.id  
          LEFT JOIN auscultation as A ON A.consultation_id = C.id
          LEFT JOIN ordonance as O ON O.consultation_id = C.id
          LEFT JOIN examen as Ex ON Ex.consultation_id = C.id
          LEFT JOIN patientsagenda as R ON C.id = R.consultation_id
          WHERE    P.nom = '$nom' AND P.password = '$password' 
          ORDER BY C.id DESC ";

$result = mysqli_query($con, $sql);

$response = array();

while($row = mysqli_fetch_array($result))
{//

    array_push($response, array("id"=>$row[0],
        "nom"=>$row[1],
        "password"=>$row[2],
        "telephone"=>$row[3],
        "telephone1"=>$row[4],
        "email"=>$row[5],
        "email1"=>$row[6],
        "prenom"=>$row[7],
        "anneeNais"=>$row[8],
        "lieuNais"=>$row[9],
        "profession"=>$row[10],
        "filename"=>$row[11],
        "consultation_id"=>$row[12],

        "hopital"=>$row[13],
        "nom_medecin"=>$row[14],
        "image"=>$row[15],
        "particularite"=>$row[16],
        "consul_datecreate"=>$row[17],
        "consul_personelEts_id"=>$row[18],
        "lieu"=>$row[19],
        "consul_symptomes"=>$row[20],
        "cout"=>$row[21],
        "Etsnom"=>$row[22],
        "Etstelephone"=>$row[23],
        "Etsemail"=>$row[24],
        "Etstype"=>$row[25],
        "Etsadresse"=>$row[26],
        "Etsville"=>$row[27],
        "Etsstatut"=>$row[28],
        "Etscode"=>$row[29],
        "EtsdateExpiration"=>$row[30],

        "param_id"=>$row[31],
        "param_consultation_id"=>$row[32],
        "param_datecreate"=>$row[33],
        "ta"=>$row[34],
        "db"=>$row[35],
        "bg"=>$row[36],
        "pouls"=>$row[37],
        "taille"=>$row[38],
        "ddr"=>$row[39],
        "dpa"=>$row[40],
        "tension"=>$row[41],
        "param_personelEts_id"=>$row[42],

        "auscul_id"=>$row[43],
        "auscul_consultation_id"=>$row[44],
        "auscul_contenu"=>$row[45],
        "auscul_personelEts_id"=>$row[46],

        "ordo_id"=>$row[47],
        "ordo_consultation_id"=>$row[48],
        "ordo_contenu"=>$row[49],
        "ordo_personelEts_id"=>$row[50],

        "examen_id"=>$row[51],
        "examen_consultation_id"=>$row[52],
        "examen_contenu"=>$row[53],
        "examen_personelEts_id"=>$row[54],

        "rdv_id"=>$row[55],
        "rdv_datedebut"=>$row[56],
        "rdv_datefin"=>$row[57],
        "rdv_nature"=>$row[58],
        "rdv_lieu"=>$row[59],
        "rdv_observation"=>$row[60],
        "rdv_tiers"=>$row[61],
        "rdv_personelEts_id"=>$row[62],
    ));

}


echo json_encode(array("server_response"=> $response));

?>