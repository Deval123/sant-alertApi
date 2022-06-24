<?php
/**
 * Created by PhpStorm.
 * User: devalere
 * Date: 28/01/2019
 * Time: 12:56
 */

define('DB_HOST','localhost');
define('DB_USER', 'root');
define('DB_PASSWORD','');
define('DB_NAME','db_crudionic');
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

date_default_timezone_set('Africa/Douala');



