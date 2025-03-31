<?php
session_start();
include '../../config/database.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "Bạn không có quyền thực hiện hành động này!";
    exit();
}

if (isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $allowed_statuses = ['Pending', 'Completed', 'Cancelled'];
    if (!in_array($status, $allowed_statuses)) {
        echo "Trạng thái không hợp lệ!";
        exit();
    }

    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $order_id);

    if ($stmt->execute()) {
        echo "Cập nhật trạng thái thành công!";
    } else {
        echo "Lỗi khi cập nhật trạng thái!";
    }
    $stmt->close();
} else {
    echo "Dữ liệu không hợp lệ!";
}
?>
