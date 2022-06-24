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

$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
        $id = $request->id;
		$datedebut = $request->datedebut;
		$datefin = $request->datefin;
		$nature = $request->nature;
		$lieu = $request->lieu;
		$observation = $request->observation;
        $tiers = $request->tiers;
        ///////$cout = $request->cout;
///////	patients_id	datedebut	datefin	nature	lieu	observation tiers personelEts_id
        $newdatedebut = $request->newdatedebut;
        $newdatefin = $request->newdatefin;
        $newnature = $request->newnature;
        $newlieu = $request->newlieu;
        $newobservation = $request->newobservation;
        $newtiers = $request->newtiers;
        $newcout = $request->newcout;
	}
//patients_id, datedebut, datefin, nature, lieu, observation, tiers
$sql = "UPDATE patientsagenda SET datedebut = '$newdatedebut', datefin = '$newdatefin', nature = '$newnature',
 lieu = '$newlieu', observation = '$newobservation', tiers = '$newtiers', cout = '$newcout' WHERE id ='$id';";


    if ($con->query($sql) === TRUE) {
        $response= "data update successfull";

    } else {
        $response= "Error:". $sql . "<br>" . $con->error;
    }
  
	echo json_encode( $response);

 
?>