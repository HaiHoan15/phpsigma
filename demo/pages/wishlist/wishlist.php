<!-- giỏ hàng -->
<?php
session_start();
include '../head_foot/header.php';
require '../../config/database.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Bạn cần đăng nhập để xem giỏ hàng!'); window.location.href='../confirm/login.php';</script>";
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
    <script src="../../assets/js/script.js"></script>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Giỏ hàng</title>
</head>

<body>

    <div class="wishlist-container">
        <h2>Danh sách sản phẩm đã chọn</h2>
        <?php if ($result->num_rows > 0): ?>
            <form method="post" action="/demo/pages/wishlist/update_wishlist.php">
                <!-- <form method="post" action="update_wishlist.php"> -->
                <?php while ($item = $result->fetch_assoc()):
                    $subtotal = $item['price'] * $item['quantity'];
                    $total_price += $subtotal;
                    ?>
                    <div class="wishlist-item">
                        <img src="/demo/<?= $item['image'] ?>" alt="<?= $item['title'] ?>">

                        <div class="wishlist-info">
                            <strong><?= $item['title'] ?></strong>
                            <span class="wishlist-price"><?= number_format($item['price'], 0, ',', '.') ?> VND</span>
                        </div>
                        <div class="wishlist-actions">
                            <input type="number" name="quantity[<?= $item['wishlist_id'] ?>]" value="<?= $item['quantity'] ?>"
                                min="1">
                            <a href="/demo/pages/wishlist/remove_from_wishlist.php?id=<?= $item['wishlist_id'] ?>">Xóa</a>
                            <!-- <a href="remove_from_wishlist.php?id=    ">Xóa</a> -->
                        </div>
                    </div>
                <?php endwhile; ?>
                <button type="submit">Cập nhật số lượng</button>
            </form>

            <h3 class="total-price">Tổng giá: <?= number_format($total_price, 0, ',', '.') ?> VND</h3>
            <!-- chuyển sang trang thanh toán -->
            <form method="post" action="../pay/pay.php">
                <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
                <button type="submit" class="checkout-btn">Mua</button>
            </form>
            <!-- <button type="button" class="checkout-btn" onclick="window.location.href='../pay/pay.php'">Mua</button> -->
        <?php else: ?>
            <p>Giỏ hàng trống.</p>
        <?php endif; ?>
    </div>


</body>

</html>
<?php include '../head_foot/footer.php'; ?>