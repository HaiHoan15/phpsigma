<?php
session_start();
include '../../config/database.php'; 

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../confirm/login.php");
    exit();
}

if (!isset($_GET['user_id'])) {
    $_SESSION['error'] = "Không tìm thấy người dùng!";
    header("Location: admin_2.php");
    exit();
}

$user_id = $_GET['user_id'];

// Lấy thông tin user
$user_query = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$user_query->bind_param("i", $user_id);
$user_query->execute();
$user_result = $user_query->get_result();
$user = $user_result->fetch_assoc();

// Lấy danh sách hóa đơn của user
$order_query = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
$order_query->bind_param("i", $user_id);
$order_query->execute();
$orders = $order_query->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết hóa đơn của <?= $user['username'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">Chi Tiết Hóa Đơn của <?= $user['username'] ?> (<?= $user['email'] ?>)</h2>
    <a href="admin_2.php" class="btn btn-secondary mb-3">Quay lại</a>

    <?php if ($orders->num_rows > 0) { ?>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID Hóa Đơn</th>
                    <th>Tên Người Nhận</th>
                    <th>Địa Chỉ</th>
                    <th>Số Điện Thoại</th>
                    <th>Phương Thức Thanh Toán</th>
                    <th>Tổng Tiền (VND)</th>
                    <th>Trạng Thái</th>
                    <th>Ngày Tạo</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($order = $orders->fetch_assoc()) { ?>
                <tr>
                    <td><?= $order['id']; ?></td>
                    <td><?= $order['name']; ?></td>
                    <td><?= $order['address']; ?></td>
                    <td><?= $order['phone']; ?></td>
                    <td><?= $order['payment_method']; ?></td>
                    <td><?= number_format($order['total_price']); ?></td>
                    <td>
                        <select class="form-select status-select" data-order-id="<?= $order['id']; ?>">
                            <option value="Pending" <?= $order['status'] === 'Pending' ? 'selected' : ''; ?>>Đang xử lý</option>
                            <option value="Completed" <?= $order['status'] === 'Completed' ? 'selected' : ''; ?>>Hoàn thành đơn hàng</option>
                            <option value="Cancelled" <?= $order['status'] === 'Cancelled' ? 'selected' : ''; ?>>Hủy đơn hàng</option>
                        </select>
                    </td>
                    <td><?= $order['created_at']; ?></td>
                    <td>
                        <button class="btn btn-success btn-save" data-order-id="<?= $order['id']; ?>">Lưu</button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Người dùng này chưa có hóa đơn nào.</p>
    <?php } ?>
</div>

<script>
$(document).ready(function() {
    $('.btn-save').click(function() {
        const orderId = $(this).data('order-id');
        const newStatus = $(this).closest('tr').find('.status-select').val();
        
        $.ajax({
            url: 'update_order_status.php',
            type: 'POST',
            data: {
                order_id: orderId,
                status: newStatus
            },
            success: function(response) {
                alert(response);
                location.reload();
            },
            error: function() {
                alert('Có lỗi xảy ra, vui lòng thử lại!');
            }
        });
    });
});
</script>

</body>
</html>
