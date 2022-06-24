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
        $nom = $request->nom;
		$password = $request->password;
 
	}

$sql ="SELECT * FROM  patients WHERE nom = 'deval' or prenom = 'tt' ;";

$result = mysqli_query($con, $sql);

$response = array();

while($row = mysqli_fetch_array($result))
{
array_push($response, array(

    "id" =>$row[0],
    "nom" =>$row[1],
    "password" =>$row[2],
    "telephone" =>$row[3],
    "telephone1" =>$row[4],
    "email" =>$row[5],
    "email1" =>$row[6],
    "prenom" =>$row[7],
    "anneeNais" =>$row[8],
    "lieuNais" =>$row[9],
    "profession" =>$row[10],
    "filename" =>$row[11],
    "lieuService" =>$row[12],
    "dateCreate" =>$row[13],
    "telBureau" =>$row[14],
    "residencePrincipal" =>$row[15],
    "residenceSecondaire" =>$row[16],
    "nomPere" =>$row[17],
    "telPere" =>$row[18],
    "emailPere" =>$row[19],
    "professionPere" =>$row[20],
    "quartierPere" =>$row[21],
    "ruePere" =>$row[22],
    "nomMere" =>$row[23],
    "telMere" =>$row[24],
    "emailMere" =>$row[25],
    "professionMere" =>$row[26],
    "quartierMere" =>$row[27],
    "rueMere" =>$row[28],
    "nomTuteur" =>$row[29],
    "telTuteur" =>$row[30],
    "emailTuteur" =>$row[31],
    "professionTuteur" =>$row[32],
    "quartierTuteur" =>$row[33],
    "rueTuteur" =>$row[34],
    "proche1" =>$row[35],
    "tel_proche1" =>$row[36],
    "emailProche1" =>$row[37],
    "residenceProche1" =>$row[38],
    "professionProche1" =>$row[39],
    "proche2" =>$row[40],
    "tel_proche2" =>$row[41],
    "emailProche2" =>$row[42],
    "residenceProche2" =>$row[43],
    "professionProche2" =>$row[44],
    "proche3" =>$row[45],
    "tel_proche3" =>$row[46],
    "emailProche3" =>$row[47],
    "residenceProche3" =>$row[48],
    "professionProche3" =>$row[49],
    "groupeSanguin" =>$row[50],
    "allergie" =>$row[51],
    "incapacite" =>$row[52],
    "medecinFamille" =>$row[53],
    "assurance" =>$row[54],
    "rhesus" =>$row[55],
    "observationPhisyque" =>$row[56],
    "signeParticulier" =>$row[57]));

}

echo json_encode(array("server_response"=> $response));
//mysqli_close($DB)

?>


