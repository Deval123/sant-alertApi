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
//datecreate, symtome, traitement, evaluation, observation, cout_traitement, patients_id
$data = file_get_contents("php://input");
if (isset($data)) {
    $request = json_decode($data);
    $personel = $request->personel;
    $personelEts_id = $personel[0]->id;
    //$password = $personel->password;


}

$sql = "SELECT *
                    FROM patientsagenda a
                    INNER JOIN patients p
                    ON a.patients_id = p.id
                    WHERE a.personelEts_id = '$personelEts_id'
                    ORDER BY datedebut DESC";
$result = mysqli_query($con, $sql);
$response = array();



while($row = mysqli_fetch_array($result))
{

    array_push($response, array(
        "id"=>$row[0],
        "patients_id"=>$row[1],
        "datedebut"=>$row[2],
        "datefin"=>$row[3],
        "nature"=>$row[4],
        "lieu"=>$row[5],
        "observation"=>$row[6],
        "tiers"=>$row[7],
        "personelEts_id"=>$row[8],
        "nom"=>$row[15],
        "telephone"=>$row[17],
        "telephone1"=>$row[18],
        "email"=>$row[19],
        "email1"=>$row[20],
        "prenom"=>$row[21],
        "anneeNais"=>$row[22],
        "lieuNais"=>$row[23],
        "profession"=>$row[24],
        "filename"=>$row[25]

    ));

}

echo json_encode(array("server_response"=> $response));
//mysqli_close($DB)

?>