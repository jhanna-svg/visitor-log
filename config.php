<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'visitor_log';
$port = 3309;

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

?>