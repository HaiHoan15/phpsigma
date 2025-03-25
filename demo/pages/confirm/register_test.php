<!-- kiểm trang đăng nhập -->
<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Mật khẩu xác nhận không khớp!";
        header("Location: register.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT); 

    try {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Đăng ký thành công! Hãy đăng nhập.";
            header("Location: login.php");
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        if (str_contains($e->getMessage(), 'Duplicate entry')) {
            $_SESSION['error'] = "Tên đăng nhập hoặc Email đã tồn tại!";
        } else {
            $_SESSION['error'] = "Đăng ký thất bại! Vui lòng thử lại.";
        }
        header("Location: register.php");
        exit();
    }
}
?>
