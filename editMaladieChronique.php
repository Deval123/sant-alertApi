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
///id	patients_id	nom	medecin_traitant	restriction	recommandation	commentaire

$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
        $id = $request->id;
		$nom = $request->nom;
		$medecin_traitant = $request->medecin_traitant;
		$restriction = $request->restriction;
		$recommandation = $request->recommandation;
		$commentaire = $request->commentaire;

        $newnom = $request->newnom;
        $newmedecin_traitant = $request->newmedecin_traitant;
        $newrestriction = $request->newrestriction;
        $newrecommandation = $request->newrecommandation;
        $newcommentaire = $request->newcommentaire;

    }

$sql = "UPDATE maladie_chronique SET nom = '$newnom', medecin_traitant = '$newmedecin_traitant', restriction = '$newrestriction',
  recommandation = '$newrecommandation', commentaire = '$newcommentaire' WHERE id ='$id';";


    if ($con->query($sql) === TRUE) {
        $response= "data update successfull";

    } else {
        $response= "Error:";///. $sql . “<br>” . $con->error;
    }
  
	echo json_encode( $response);

 
?>