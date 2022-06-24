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
//regime_id	poids	dateParam	temperature	tension	observation

$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
        $id = $request->id;
		$poids = $request->poids;
		$dateParam = $request->dateParam;
		$temperature = $request->temperature;
        $tension = $request->tension;
        $observation = $request->observation;

        $newpoids = $request->newpoids;
        $newdateParam = $request->newdateParam;
        $newtemperature = $request->newtemperature;
        $newtension = $request->newtension;
        $newobservation = $request->newobservation;
	}

$sql = "UPDATE param_regime SET  poids = '$newpoids', dateParam = '$newdateParam', temperature = '$newtemperature', 
                                 tension = '$newtension', observation = '$newobservation' WHERE id ='$id';";


    if ($con->query($sql) === TRUE) {
        $response= "data update successfull";

    } else {
        $response= "Error:";///. $sql . “<br>” . $con->error;
    }
  
	echo json_encode( $response);

 
?>
