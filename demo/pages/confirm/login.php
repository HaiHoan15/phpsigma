<?php 
session_start();
include '../../config/database.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    
    $stmt = $conn->prepare("SELECT id, username, email, password, role FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $login, $login);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $email, $hashed_password, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {

            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            if ($role === 'admin') {
                $_SESSION['success'] = "Đăng nhập thành công với vai trò ADMIN!";
                header("Location: ../admin/admin.php");
            } else {
                $_SESSION['success'] = "Đăng nhập thành công!";
                header("Location: ../../index.php");
            }
            exit();
        } else {
            $_SESSION['error'] = "Sai mật khẩu!";
        }
    } else {
        $_SESSION['error'] = "Tài khoản không tồn tại!";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng Nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../assets/css/style.css"> 
</head>
<body>

<?php if (isset($_SESSION['error']) || isset($_SESSION['success'])): ?>
<div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
    <div id="toastMessage" class="toast show align-items-center text-bg-<?php echo isset($_SESSION['error']) ? 'danger' : 'success'; ?> border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                <?php
                echo isset($_SESSION['error']) ? $_SESSION['error'] : $_SESSION['success'];
                unset($_SESSION['error']);
                unset($_SESSION['success']);
                ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="container">
    <div class="login-container">
        <h3 class="text-center">ĐĂNG NHẬP</h3>
        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Tên người dùng hoặc email <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="login" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-custom w-100">Đăng nhập</button>
        </form>
        <div class="text-end mt-2">
            <a href="register.php">Chưa có tài khoản? Ấn vào đây để đăng ký!</a>
        </div>
    </div>
</div>

</body>
</html>
