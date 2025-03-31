<link rel="stylesheet" href="../../assets/css/style.css">
<link rel="stylesheet" href="../../assets/css/pay_list.css">

<?php
session_start();
include '../head_foot/header.php';
include '../../config/database.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Bạn cần đăng nhập để xem giỏ hàng!'); window.location.href='../confirm/login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT id, name, address, phone, payment_method, total_price, status, created_at FROM orders WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<h2>Danh Sách Các Cuộc Thanh Toán Của Bạn</h2>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Phương thức thanh toán</th>
                <th>Tổng giá</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        $status = ($row['status'] === 'Pending') ? 'Đang xử lý...' :
          ($row['status'] === 'Completed' ? 'Hoàn thành đơn hàng' :
          ($row['status'] === 'Cancelled' ? 'Hủy đơn hàng' : $row['status']));


        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['address']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['payment_method']}</td>
                <td>" . number_format($row['total_price']) . " VND</td>
                <td>{$status}</td>
                <td>{$row['created_at']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<script>alert('Bạn chưa có hóa đơn thanh toán nào!'); window.location.href='../../index.php';</script>";
    exit();
}

$stmt->close();
$conn->close();
?>
