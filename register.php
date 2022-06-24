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
		$username = $request->username;
		$password = $request->password;
		$mobile = $request->mobile;
        $mobile1 = $request->mobile1;
        $country_id = $request->country->id;
		$emailadd = $request->email;
        $emailadd1 = $request->email1;
		$firstname = $request->firstname;

	}

$username = stripslashes($username);
$password = stripslashes($password);

$resp = array();


$sql = "INSERT INTO patients (nom, password, telephone, telephone1, email, email1,prenom,country_id)
VALUES ('$username', '$password', '$mobile', '$mobile1', '$emailadd', '$emailadd1', '$firstname', '$country_id')";


if ($con->query($sql) === TRUE) {
    $sql1 = "SELECT MAX(id)  FROM patients WHERE nom = '$username' and password = '$password' ";
    $result = mysqli_query($con,$sql1);

    while($row = mysqli_fetch_array($result))
    {///////	patients_id	datedebut	datefin	nature	lieu	observation

        array_push($resp, array(
            "id"=>$row[0]));

    }

	$response= "Registration successfull";
   
} else {
   $response= "Error:";
}
 
  
	///echo json_encode( $response);
echo json_encode(array("response"=> $response, "result"=> $resp));
 
?>
