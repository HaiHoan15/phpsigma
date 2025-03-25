<!-- thông tin người dùng -->
<?php
session_start();
include '../head_foot/header.php';
require '../../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../confirm/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT username, email, avatar FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Người Dùng</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script src="../../assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
</head>
<body>

<div class="login-container">
    <h2>Thông Tin Người Dùng</h2>
    <img id="user-avatar" src="<?= $user['avatar'] ? '../../assets/images/image_user/' . $user['avatar'] : '../../assets/images/image_user/default.png'; ?>"
         alt="Avatar" width="150" style="border-radius: 50%; border: 3px solid #ddd;">
    
    <p><strong>Tên:</strong> <span id="display-username"><?= htmlspecialchars($user['username']); ?></span></p>
    <p><strong>Email:</strong> <span id="display-email"><?= htmlspecialchars($user['email']); ?></span></p>

    <button id="editBtn" class="btn btn-custom">Thay đổi</button>
    <a href="../../index.php" class="btn btn-secondary">Quay lại</a>
</div>

<div id="editPopup" class="popup">
    <div class="popup-content">
        <h2>Chỉnh Sửa Thông Tin</h2>
        <form id="updateForm" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?= $user_id; ?>">
            <label for="username">Tên:</label>
            <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']); ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']); ?>" required>
            
            <label for="avatar">Ảnh đại diện:</label>
            <input type="file" name="avatar" id="avatar">

            <button type="submit" class="btn btn-custom">Cập nhật</button>
            <button type="button" id="closePopup" class="btn btn-secondary">Hủy</button>
        </form>
        <p id="updateStatus"></p>
    </div>
</div>

</body>
</html>
<?php include '../head_foot/footer.php'; ?>