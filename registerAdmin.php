<?php
/**
 * Created by PhpStorm.
 * User: Kamguia
 * Date: 01/12/2018
 * Time: 06:52
 */
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
        $login = $request->login;
        $password = $request->password;
        $description = $request->description;
        $email = $request->email;
        $telephone = $request->telephone;
        $gender = $request->gender;

    }

/*$login = stripslashes($login);
$password = stripslashes($password);*/



$sql = "INSERT INTO admin (login, password, description, telephone, email, gender)
VALUES ('$login', '$password', '$description', '$telephone', '$email', '$gender')";


if ($con->query($sql) === TRUE) {
    $response= "Registration successfull";

} else {
    $response= "Error: ";
}


	echo json_encode( $response);


?>
