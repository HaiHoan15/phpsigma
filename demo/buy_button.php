<!-- nút mua -->
<?php
session_start();
require 'config/database.php'; 

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!'); window.location.href='login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['buy_product'])) {
    $product_id = $_POST['product_id'];

    $checkQuery = $conn->prepare("SELECT * FROM wishlist WHERE user_id = ? AND product_id = ?");
    $checkQuery->bind_param("ii", $user_id, $product_id);
    $checkQuery->execute();
    $result = $checkQuery->get_result();

    if ($result->num_rows > 0) {
    
        $updateQuery = $conn->prepare("UPDATE wishlist SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?");
        $updateQuery->bind_param("ii", $user_id, $product_id);
        $updateQuery->execute();
    } else {
     
        $insertQuery = $conn->prepare("INSERT INTO wishlist (user_id, product_id, quantity) VALUES (?, ?, 1)");
        $insertQuery->bind_param("ii", $user_id, $product_id);
        $insertQuery->execute();
    }

    echo "<script>alert('Đã thêm vào giỏ hàng!'); window.history.back();</script>";
    exit();
}
?>
