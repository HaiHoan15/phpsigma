<!-- đăng nhập -->
<?php session_start(); ?> 

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng Ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css"> 
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
    <div class="register-container">
        <h3 class="text-center">ĐĂNG KÝ</h3>
        <form method="POST" action="register_test.php">
            <div class="mb-3">
                <label class="form-label">Tên người dùng <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-custom w-100">Đăng ký</button>
        </form>
        <div class="text-end mt-2">
            <a href="login.php">Đã có tài khoản? Hãy truy cập vào trang đăng nhập!</a>
        </div>
    </div>
</div>

</body>
</html>
