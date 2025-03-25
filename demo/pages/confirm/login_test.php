<!-- kiểm tra đăng nhập -->
<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, email, password FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $login, $login);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $email, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "Đăng nhập thành công!";
            header("Location: ../../index.php");
            exit();
        } else {
            $_SESSION['error'] = "Sai mật khẩu!";
        }
    } else {
        $_SESSION['error'] = "Tên đăng nhập hoặc Email không tồn tại!";
    }

    header("Location: login.php");
    exit();
}
?>
