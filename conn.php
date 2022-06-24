<?php

/**

try {
$strConnection= 'mysql:host=localhost; dbname=santalert';
$pdo = new PDO ($strConnection, 'root', '');
}
catch (PDOException $e) {
$msg = 'ERREUR PDO dans ' . $e ->getMessage();
die ($msg);
}


  try {
      $strConnection= 'mysql:host=localhost; dbname=habite1012_santalert';
      $pdo = new PDO ($strConnection, 'habite1012_santa', 'uM1Gb%_kn7%j');
  }
  catch (PDOException $e) {
      $msg = 'ERREUR PDO dans ' . $e ->getMessage();
      die ($msg);
  }*/


try {
    $strConnection= 'mysql:host=localhost; dbname=habitech_sant-alert';
    $pdo = new PDO ($strConnection, 'habitech_sant', '?bi6JRpHLV.W');
}
catch (PDOException $e) {
    $msg = 'ERREUR PDO dans ' . $e ->getMessage();
    die ($msg);
}

?>