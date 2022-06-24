<?php
/**
 * Created by PhpStorm.
 * User: devalere
 * Date: 28/01/2019
 * Time: 12:56
 */

/**
 *define('DB_HOST','localhost');
 *define('DB_USER', 'habitech_sant');
 *define('DB_PASSWORD','?bi6JRpHLV.W');
 *define('DB_NAME','habitech_sant-alert');
 *$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
 *
 *


define('DB_HOST','localhost');
define('DB_USER', 'habite1012_santa');
define('DB_PASSWORD','uM1Gb%_kn7%j');
define('DB_NAME','habite1012_santalert');
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

 * try {
$strConnection= 'mysql:host=localhost; dbname=habitech_sant-alert';
$pdo = new PDO ($strConnection, 'habitech_sant', '?bi6JRpHLV.W');
}
 *
 * config base de donnée:
Hôte : localhost
Non de la base de donnée: habite1012_santalert
Utilisateur de la base de donnée: habite1012_santa
password: uM1Gb%_kn7%j
Port: 3306
 *
 */


define('DB_HOST','localhost');
define('DB_USER', 'habitech_sant');
define('DB_PASSWORD','?bi6JRpHLV.W');
define('DB_NAME','habitech_sant-alert');
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

date_default_timezone_set('Africa/Douala');
