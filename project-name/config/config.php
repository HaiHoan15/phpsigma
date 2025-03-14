<?php
// Cấu hình kết nối MySQL
$host = 'localhost'; // Địa chỉ máy chủ MySQL
$db_name = 'your_database_name'; // Tên cơ sở dữ liệu
$username = 'your_username'; // Tên người dùng MySQL
$password = 'your_password'; // Mật khẩu MySQL

// Tạo kết nối
$conn = new mysqli($host, $username, $password, $db_name);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>