<!-- giỏ hàng -->
<?php
session_start();
include 'header.php'; 
require 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Bạn cần đăng nhập để xem giỏ hàng!'); window.location.href='login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

$query = $conn->prepare("
    SELECT w.id AS wishlist_id, p.id AS product_id, p.image, p.title, p.price, w.quantity 
    FROM wishlist w
    JOIN products p ON w.product_id = p.id
    WHERE w.user_id = ?
");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

$total_price = 0;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
</head>
<body>

<h2>Danh sách sản phẩm đã chọn</h2>
<?php if ($result->num_rows > 0): ?>
    <form method="post" action="update_wishlist.php">
        <?php while ($item = $result->fetch_assoc()): 
            $subtotal = $item['price'] * $item['quantity'];
            $total_price += $subtotal;
        ?>
            <div>
                <img src="<?= $item['image'] ?>" width="100">
                <strong><?= $item['title'] ?></strong> - <?= number_format($item['price'], 0, ',', '.') ?> VND
                <input type="number" name="quantity[<?= $item['wishlist_id'] ?>]" value="<?= $item['quantity'] ?>" min="1">
                <a href="remove_from_wishlist.php?id=<?= $item['wishlist_id'] ?>">Xóa</a>
            </div>
        <?php endwhile; ?>
        <button type="submit">Cập nhật số lượng</button>
    </form>

    <h3>Tổng giá: <?= number_format($total_price, 0, ',', '.') ?> VND</h3>
    <button onclick="showCheckoutModal()">Mua</button>

<?php else: ?>
    <p>Giỏ hàng trống.</p>
<?php endif; ?>

<div id="checkout-modal" style="display:none;">
    <h3>Xác nhận thanh toán</h3>
    <form method="post" action="checkout.php">
        <input type="radio" name="payment_method" value="Chuyển khoản" required> Chuyển khoản<br>
        <input type="radio" name="payment_method" value="Tiền mặt"> Tiền mặt<br>
        <button type="submit">Xác nhận</button>
        <button type="button" onclick="document.getElementById('checkout-modal').style.display='none'">Hủy</button>
    </form>
</div>

<script>
function showCheckoutModal() {
    document.getElementById('checkout-modal').style.display = 'block';
}
</script>

</body>
</html>
<?php include 'footer.php'; ?>
