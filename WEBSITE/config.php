<?php
$host = 'localhost';     // or your DB host
$user = 'root';          // DB username
$password = '';          // DB password
$dbname = 'tote_bag_shop';    // Your database name

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
?>
