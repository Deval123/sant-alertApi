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

$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
        $id = $request->id;
		$datecreate = $request->datecreate;
		$symtome = $request->symtome;
		$traitement = $request->traitement;
		$evaluation = $request->evaluation;
		$observation = $request->observation;
        $cout_traitement = $request->cout_traitement;

        $newdatecreate = $request->newdatecreate;
        $newsymtome = $request->newsymtome;
        $newtraitement = $request->newtraitement;
        $newevaluation = $request->newevaluation;
        $newobservation = $request->newobservation;
        $newcout_traitement = $request->newcout_traitement;
	}

$sql = "UPDATE auto_med SET datecreate = '$newdatecreate', symtome = '$newsymtome', traitement = '$newtraitement',
  evaluation = '$newevaluation', observation = '$newobservation', cout_traitement = '$newcout_traitement' WHERE id ='$id';";


    if ($con->query($sql) === TRUE) {
        $response= "data update successfull";

    } else {
        $response= "Error:";///. $sql . “<br>” . $con->error;
    }
  
	echo json_encode( $response);

 
?>
