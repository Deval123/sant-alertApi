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
  ///etablissement_id	nom	premon	telephone	email	type_personnel

$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
		$nom = $request->nom;
		$matricule = $request->matricule;
		$telephone = $request->telephone;
		$email = $request->email;
		$type_personnel = $request->type_personnel;
        $password = $request->password;
        $code = $request->code;
        $departement_id = $code->id;
    }


    $sqli = "INSERT INTO personel_ets (nom, password, matricule, telephone, email, type_personnel, departement_id)
       VALUES ('$nom', '$password', '$matricule', '$telephone', '$email', '$type_personnel', '$departement_id')";
if ($con->query($sqli) === TRUE) {
    $response= "Registration successfull";

} else {
    $response= "Error, register failled";
}





/*
$sql = "SELECT id FROM etablissement where code = '$code' ";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$etablissement = $row['id'];
$count = mysqli_num_rows($result);
if($count == 0) {
    $response= "Error, don't exist";

}else {
    $sqli = "INSERT INTO personel_ets (nom, password, matricule, telephone, email, type_personnel, etablissement_id)
       VALUES ('$nom', '$password', '$matricule', '$telephone', '$email', '$type_personnel', '$etablissement')";
    if ($con->query($sqli) === TRUE) {
        $response= "Registration successfull";

    } else {
        $response= "Error, register failled";
    }

}*/

echo json_encode($response);
?>

