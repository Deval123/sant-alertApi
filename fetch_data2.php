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
 
  include "dbconnect.php";
  
    $data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
        $username = $request->username;
		$password = $request->password;
 
	}
	
 /////{"id":"370","username":"","password":"12345","telephone":"","email":"fie@gmail.com"},
 ////https://ionicdon.com/how-to-write-read-and-display-data-from-mysql-database-in-ionic-app/
	  $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password' ";
      $result = mysqli_query($con,$sql);   //$result = $conn->query($query);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      //$count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
     
     //$response= "Your Login success";
	 $outp = "";
		if( $rs=$row) {
			if ($outp != "") {$outp .= ",";}
			$outp .= '{"id":"'  . $rs["id"] . '",';
			$outp .= '"username":"'   . $rs["username"]        . '",';
			$outp .= '"email":"'   . $rs["email"]        . '",';
			$outp .= '"telephone":"'   . $rs["telephone"]        . '",';
			$outp .= '"password":"'. $rs["password"]     . '"}';
		}
		$outp ='{"records":'.$outp.'}';
		$con->close();
		
      
   
   echo($outp);


	 
	//echo json_encode( $outp);
?>