<?php
$server = 'localhost';
$username = '';
$password = '';
$dbname = 'loginCookiesSession';


$conn = new mysqli($server, $username, $password);
$sql = 'CREATE DATABASE loginCookiesSession';
$conn->query($sql);

$conn = new mysqli($server, $username, $password, $dbname);
$sql = 'CREATE TABLE users(
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(50) NOT NULL,
	password VARCHAR(100) NOT NULL,
	season1 VARCHAR(50),
	season2 VARCHAR(50),
	cookies VARCHAR(50),
	sensData VARCHAR(100), #sensitive data
	reg_date TIMESTAMP)';
$conn->query($sql);
echo 'Okay done'.$conn->error;


?>