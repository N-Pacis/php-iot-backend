<?php
require './controller.php';

// $host = "localhost";
// $db   = "benax_iot";
// $user = "benax_iot_root";
// $pass = "Td(FAdeZ9xp3";

$host = "localhost";
$db   = "php_work";
$user = "root";
$pass = "pacis123";

$dbConnection = new \PDO("mysql:host=$host;dbname=$db", $user, $pass);

$dbConnection->exec('CREATE TABLE IF NOT EXISTS pacis_sensordata (
    id INT  PRIMARY KEY AUTO_INCREMENT,
    device VARCHAR(100) NOT NULL,
    temperature VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);');

$result_arr = json_decode(json_encode(findAll($dbConnection)),true);
$dataPoints = array();

foreach($result_arr as $result){
    array_push($dataPoints,array("y"=>$result['temperature'],"label"=>$result['device']));
 }