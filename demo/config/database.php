<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "demodatabase";

// ket noi sql
$conn = new mysqli($host, $user, $password, $database);

// Kiem tra loi
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
