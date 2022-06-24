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
		$patients_id = $request->patients_id;
		$hopital = $request->hopital;
        $nom_medecin = $request->nom_medecin;
        $image = $request->image;
        $personelEts_id = $request->personelEts_id;

        $newdatecreate = $request->newdatecreate;
        $newpatients_id = $request->newpatients_id;
        $newhopital = $request->newhopital;
        $newnom_medecin = $request->newnom_medecin;
        $newimage = $request->newimage;
        $newpersonelEts_id = $request->newpersonelEts_id;
	}
//id	patients_id	hopital		nom_medecin	image personelEts_id datecreate

$sql = "UPDATE consultation SET datecreate = '$newdatecreate', newpatients_id = '$newpatients_id',
  newhopital = '$newhopital', nom_medecin = '$newnom_medecin', image = '$newimage', personelEts_id = '$newpersonelEts_id'
   WHERE id ='$id';";


    if ($con->query($sql) === TRUE) {
        $response= "data update successfull";

    } else {
        $response= "Error:";///. $sql . “<br>” . $con->error;
    }
  
	echo json_encode( $response);

 
?>
