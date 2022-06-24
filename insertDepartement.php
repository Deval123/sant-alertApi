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
		$nom = $request->nom;
		$description = $request->description;
        $code = $request->code;
        $etablissement_id = $code->id;
    }
//etablissement_id	nom	description

/*$sql = "SELECT id FROM etablissement where code = '$code' ";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$etablissement_id = $row['id'];
$count = mysqli_num_rows($result);
if($count == 0) {
    $response= "Error, don't exist";

}else {
    $sqli = "INSERT INTO departement (etablissement_id, nom, description) VALUES 
                              ('$code', '$nom', '$description')";
    if ($con->query($sqli) === TRUE) {
        $response= "Successfull";

    } else {
        $response= "Error, creation failled";
    }

}*/



$sql = "INSERT INTO departement (etablissement_id, nom, description) VALUES 
                              ('$etablissement_id', '$nom', '$description')";


if ($con->query($sql) === TRUE) {
    $response= "Successfull";

} else {
    $response= "Error: "/*. $sql . "<br>" . $db->error*/;
}
    echo json_encode( $response);

 
?>
