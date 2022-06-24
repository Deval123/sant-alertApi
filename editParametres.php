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
//	id	patients_id	date_debut	rang	date_accouchement	note	type_accouchement	verdict

$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
        $id = $request->id;
        $datecreate = $request->datecreate;
        $ta = $request->ta;
        $db = $request->db;
        $bg = $request->bg;
        $pouls = $request->pouls;
        $tension = $request->tension;
        $ddr = $request->ddr;
        $taille = $request->taille;
        $dpa = $request->dpa;
        $consultation = $request->consultation;
        $consultation_id = $consultation[0]->id;


        $newdatecreate = $request->newdatecreate;
        $newta = $request->newta;
        $newdb = $request->newdb;
        $newbg = $request->newbg;
        $newpouls = $request->newpouls;
        $newtension = $request->newtension;
        $newddr = $request->newddr;
        $newtaille = $request->newtaille;
        $newdpa = $request->newdpa;
        $newconsultation = $request->newconsultation;
        $newconsultation_id = $newconsultation[0]->id;

    }

$sql = "UPDATE parametres SET datecreate = '$newdatecreate', ta = '$newta', db = '$newdb', bg = '$newbg', pouls = '$newpouls',
 tension = '$newpension', ddr = '$newddr', taille = '$newtaille', consultation_id = '$newconsultation_id' WHERE id ='$id';";


    if ($con->query($sql) === TRUE) {
        $response= "data update successfull";

    } else {
        $response= "Error:";///. $sql . “<br>” . $con->error;
    }
  
	echo json_encode( $response);

 
?>
