<!-- admin -->
<?php
session_start();
include '../../config/database.php'; 

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../confirm/login.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $_SESSION['success'] = "Xóa sản phẩm thành công!";
    } else {
        $_SESSION['error'] = "Lỗi khi xóa sản phẩm!";
    }
    header("Location: /demo/pages/admin/admin.php");
    // header("Location: admin.php");
    exit();
}

$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/script.js"></script>
    <link rel="stylesheet" href="/demo/assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">
        Quản lý Sản Phẩm 
        <a href="admin_2.php" class="ms-2">
            <i class="bi bi-arrow-right-circle-fill" style="font-size: 24px; color: #007bff;"></i>
        </a>
    </h2>
    <a href="/demo/pages/confirm/logout.php" class="btn btn-danger mb-3">Đăng xuất</a>
    <a href="/demo/pages/admin/add_product.php" class="btn btn-primary mb-3">Thêm sản phẩm</a>

    <?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
        <div class="alert alert-<?php echo isset($_SESSION['success']) ? 'success' : 'danger'; ?>">
            <?php
            echo isset($_SESSION['success']) ? $_SESSION['success'] : $_SESSION['error'];
            unset($_SESSION['success']);
            unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Hình ảnh</th>
                <th>Tiêu đề</th>
                <th>Mô tả</th>
                <th>Chất liệu</th>
                <th>Kích thước</th>
                <th>Nhà cung cấp</th>
                <th>Giá (VND)</th>
                <th>Mô tả chi tiết</th>
                <th>Màu sắc</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><img src="/demo/<?= $row['image']; ?>" width="80"></td>
                <td><?= $row['title']; ?></td>
                <td><?= $row['description']; ?></td>
                <td><?= $row['material']; ?></td>
                <td><?= $row['size']; ?></td>
                <td><?= $row['supplier']; ?></td>
                <td><?= number_format($row['price']); ?></td>
                <td><?= substr($row['moredescription'], 0, 100) . '...'; ?></td>
                <td><?= $row['color']; ?></td>
                <td>
                    <a href="edit_product.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="admin.php?delete=<?= $row['id']; ?>" class="btn btn-danger btn-sm btn-delete">Xóa</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>

