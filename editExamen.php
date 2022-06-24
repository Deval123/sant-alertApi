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
///id	consultation_id	contenu

$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
        $id = $request->id;
        $contenu = $request->contenu;
        $consultation_id = $request->consultation;


        $newconsultation_id = $request->newconsultation_id;
        $newcontenu = $request->newcontenu;
        $personelEts = $request->personel;
        $newpersonelEts_id = $personelEts[0]->id;
    }

$sql = "UPDATE examen SET contenu = '$newcontenu', consultation_id = '$newconsultation_id' , 
              personelEts_id = '$newpersonelEts_id' WHERE id ='$id';";


    if ($con->query($sql) === TRUE) {
        $response= "data update successfull";

    } else {
        $response= "Error:";///. $sql . “<br>” . $con->error;
    }
  
	echo json_encode( $response);

 
?>
