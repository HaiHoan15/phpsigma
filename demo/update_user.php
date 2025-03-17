<!-- cập nhập user -->
<?php
session_start();
require 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    exit("Bạn chưa đăng nhập!");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id'];
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    $check_sql = "SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ssi", $username, $email, $user_id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        exit("Tên hoặc email đã tồn tại trong hệ thống.");
    }

    $old_avatar_sql = "SELECT avatar FROM users WHERE id = ?";
    $old_avatar_stmt = $conn->prepare($old_avatar_sql);
    $old_avatar_stmt->bind_param("i", $user_id);
    $old_avatar_stmt->execute();
    $old_avatar_result = $old_avatar_stmt->get_result();
    $old_avatar_row = $old_avatar_result->fetch_assoc();
    $old_avatar = $old_avatar_row['avatar'];

    if (!empty($_FILES["avatar"]["name"])) {
        $target_dir = "image_user/";
        $file_name = time() . "_" . basename($_FILES["avatar"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            if ($old_avatar && $old_avatar !== "default.png" && file_exists($target_dir . $old_avatar)) {
                unlink($target_dir . $old_avatar); 
            }

            $sql = "UPDATE users SET username = ?, email = ?, avatar = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $username, $email, $file_name, $user_id);
        } else {
            exit("Lỗi khi upload ảnh.");
        }
    } else {
        $sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $username, $email, $user_id);
    }

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Có lỗi xảy ra khi cập nhật.";
    }
}
?>
