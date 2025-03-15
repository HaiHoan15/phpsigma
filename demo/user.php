<!-- thông tin người dùng -->
<?php
session_start();
include 'header.php';
require 'config/database.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
</head>
<body>

<div class="login-container">
    <h2>Thông Tin Người Dùng</h2>
    <img id="user-avatar" src="<?= $user['avatar'] ? 'image_user/' . $user['avatar'] : 'image_user/default.png'; ?>" alt="Avatar" width="150" style="border-radius: 50%; border: 3px solid #ddd;">
    
    <p><strong>Tên:</strong> <?= htmlspecialchars($user['username']); ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>

    <form id="uploadForm" enctype="multipart/form-data">
        <input type="file" name="avatar" id="avatarInput" required>
        <button type="submit" class="btn btn-custom">Cập nhật</button>
    </form>

    <p id="uploadStatus"></p> 
    <a href="home.php" class="btn btn-secondary">Quay lại</a>
</div>

<script>
$(document).ready(function(){
    $("#uploadForm").on("submit", function(e){
        e.preventDefault(); 
        
        let formData = new FormData(this);

        $.ajax({
            url: "upload_image.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                response = response.trim(); 

                if(response.endsWith(".jpg") || response.endsWith(".jpeg") || response.endsWith(".png") || response.endsWith(".gif")) {
                    $("#user-avatar").attr("src", "image_user/" + response); 
                    $("#uploadStatus").html("Upload thành công!");
                } else {
                    $("#uploadStatus").html(response);
                }
            },
            error: function() {
                $("#uploadStatus").html("Có lỗi xảy ra khi upload ảnh.");
            }
        });
    });
});
</script>

</body>
</html>
