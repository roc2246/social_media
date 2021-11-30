<?php 

/** 
 * Connection parameters for The Condo
 * 
 * PHP version 7.4
 * 
 * @category Libraries
 * @package  Pages
 * @author   Riley Childs <riley.childs@yahoo.com>
 * @license  Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)
 * @link     http://wh963069.ispot.cc/projects/eCommerce/include/connect.php
 */


if ($_SERVER['HTTP_HOST'] == 'localhost') { 
    $servername = 'localhost';
    $username = 'root';
    $password = 'root';
    $database = 'social_media';
} else if ($_SERVER['HTTP_HOST'] == 'wh963069.ispot.cc') {
    $servername = 'wh963069.ispot.cc';
    $username = 'childswe_eCommerce';
    $password = 'VJChkRFx';
    $database = 'childswe_socialMedia';
} else {
    $servername = 'localhost';
    $username = 'roc09090';
    $password = 'je5umyju5';
    $database = 'roc09090_wordpress';
}


$connection = mysqli_connect($servername, $username, $password, $database);  
if (!$connection) {
     die("Database connection failed");
}


?>