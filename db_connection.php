<?php

// Hardcoded database connection details
$servername = $_ENV("DB_HOST");
$username = $_ENV("DB_USER");
$password = $_ENV("DB_PASSWORD");
$dbname = $_ENV("DB_NAME");
$port = $_ENV("DB_PORT");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>