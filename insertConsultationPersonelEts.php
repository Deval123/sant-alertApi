<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 
  require "dbconnect.php";
  ///datecreate	symtome	traitement	evaluation	observation	cout_traitement	patients_id
$res = array();

$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
		$datecreate = $request->datecreate;
		$ets = $request->hopital;
        $hopital = $ets[0]->id;
        $nom_medecin = $request->nom_medecin;
        $patients_id = $request->patients_id;
        $personelEts = $request->personel;
        $personelEts_id = $personelEts[0]->id;
	}

//id	patients_id	hopital	nom_medecin	image	personelEts_id	datecreate

//'1', '6','chinois','24','2018-10-08 00:01:11'
    $sql = "INSERT INTO consultation (patients_id, hopital, nom_medecin, personelEts_id, datecreate)
VALUES ('$patients_id', '$hopital', '$nom_medecin', '$personelEts_id', '$datecreate')";


    if ($con->query($sql) === TRUE) {
        $response= "Successfull";

        $sql1 ="SELECT * FROM  consultation WHERE patients_id = '$patients_id' and datecreate='$datecreate';";
        $result1 = mysqli_query($con, $sql1);
        $res = array();
        while($row = mysqli_fetch_array($result1))
        {//
//id	patients_id	hopital		nom_medecin	image personelEts_id datecreate

            array_push($res, array("id"=>$row[0],
                "patients_id"=>$row[1],
                "hopital"=>$row[2],
                "nom_medecin"=>$row[3],
                "image"=>$row[4],
                "personelEts_id"=>$row[5],
                "datecreate"=>$row[6]));

        }


    } else {
        $response= "Error: ";
    }
  
	//echo json_encode( $response);
echo json_encode(array("server_response"=> $response, "consultation"=> $res));

 
?>
