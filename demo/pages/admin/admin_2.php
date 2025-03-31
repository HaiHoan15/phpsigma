<!-- quản lý user -->
<?php
session_start();
include '../../config/database.php'; 

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../confirm/login.php");
    exit();
}

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">
        Quản lý User 
        <a href="admin.php" class="ms-2">
            <i class="bi bi-arrow-left-circle-fill" style="font-size: 24px; color: #007bff;"></i>
        </a>
    </h2>
    <a href="/demo/pages/confirm/logout.php" class="btn btn-danger mb-3">Đăng xuất</a>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Avatar</th>
                <th>Vai trò</th>
                <th>Chi tiết Hóa Đơn</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['username']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><img src="/demo/assets/images/image_user/<?= $row['avatar']; ?>" width="80" onerror="this.onerror=null; this.src='/demo/assets/images/image_user/default.jpg'"></td>
                <td><?= $row['role']; ?></td>
                <td>
                    <a href="../user/user_orders.php?user_id=<?= $row['id']; ?>" class="btn btn-info btn-sm">Xem hóa đơn</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>

