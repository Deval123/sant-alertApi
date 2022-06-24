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

$resp = array();



    $sql1 = "SELECT MAX(id)  FROM patients WHERE nom = 'deval' and password = '2valere' ";
    $result = mysqli_query($con,$sql1);

    while($row = mysqli_fetch_array($result))
    {///////	patients_id	datedebut	datefin	nature	lieu	observation

        array_push($resp, array(
            "patients_id"=>$row[0]));

    }



echo json_encode( $resp);
echo json_encode( date(null));
?>
