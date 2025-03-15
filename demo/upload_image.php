<!-- upload ảnh user -->
<?php
session_start();
require 'config/database.php'; // Kết nối database

if (!isset($_SESSION['user_id'])) {
    exit("Bạn chưa đăng nhập!");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['avatar'])) {
    $user_id = $_SESSION['user_id'];
    $target_dir = "image_user/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_name = time() . "_" . basename($_FILES["avatar"]["name"]); 
    $target_file = $target_dir . $file_name;
    
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ["jpg", "jpeg", "png", "gif"];

    if (in_array($imageFileType, $allowed_types)) {
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {

            $sql = "UPDATE users SET avatar = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $file_name, $user_id);
            $stmt->execute();

            echo $file_name; 
        } else {
            echo "Lỗi khi upload!";
        }
    } else {
        echo "Định dạng file không hợp lệ!";
    }
}
?>
