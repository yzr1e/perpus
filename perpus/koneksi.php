<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'perpus';
$mysqli = new mysqli($host, $username, $password, $dbname);
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Create users table if not exists
$query = "CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

$mysqli->query($query);
?>
