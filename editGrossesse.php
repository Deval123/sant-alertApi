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
		$patients_id = $request->patients_id;
		$date_debut = $request->date_debut;
		$rang = $request->rang;
		$date_accouchement = $request->date_accouchement;
		$note = $request->note;
        $type_accouchement = $request->type_accouchement;
        $verdict = $request->verdict;
        $observation = $request->observation;

        //$newpatients_id = $request->newpatients_id;
        $newdate_debut = $request->newdate_debut;
        $newrang = $request->newrang;
        $newdate_accouchement = $request->newdate_accouchement;
        $newnote = $request->newnote;
        $newtype_accouchement = $request->newtype_accouchement;
        $newverdict = $request->newverdict;
        $newobservation = $request->newobservation;

    }

$sql = "UPDATE grossesse SET date_debut = '$newdate_debut', rang = '$newrang', date_accouchement = '$newdate_accouchement',
  note = '$newnote', observation = '$newobservation', verdict = '$newverdict' WHERE id ='$id';";


    if ($con->query($sql) === TRUE) {
        $response= "data update successfull";

    } else {
        $response= "Error:";///. $sql . “<br>” . $con->error;
    }
  
	echo json_encode( $response);

 
?>
