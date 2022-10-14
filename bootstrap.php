<?php
require 'vendor/autoload.php';
use Dotenv\Dotenv;
use Src\ServiceImpls\AppServiceImpl;


$dotenv = new DotEnv(__DIR__);
$dotenv->load();

$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$db   = getenv('DB_DATABASE');
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');

$dbConnection = new \PDO("mysql:host=$host;dbname=$db", $user, $pass);

$dbConnection->exec('CREATE TABLE IF NOT EXISTS iot (
    id INT  PRIMARY KEY AUTO_INCREMENT,
    device VARCHAR(100) NOT NULL,
    temperature VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);');
$appService = new AppServiceImpl($dbConnection);

$result_arr = json_decode(json_encode($appService->findAll()),true);
$dataPoints = array();

foreach($result_arr as $result){
    array_push($dataPoints,array("y"=>$result['temperature'],"label"=>$result['device']));
 }