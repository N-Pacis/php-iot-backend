<?php
require "./bootstrap.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,POST,GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$requestMethod = $_SERVER["REQUEST_METHOD"];

$dbConnection->exec('USE '.$db.';');

$dbConnection->exec('CREATE TABLE IF NOT EXISTS iot (
    id INT  PRIMARY KEY AUTO_INCREMENT,
    device VARCHAR(100) NOT NULL,
    temperature VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);');

registerData($dbConnection);
