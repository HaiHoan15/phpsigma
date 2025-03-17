<!-- cập nhập giỏ hàng -->
<?php
session_start();
require 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $wishlist_id => $quantity) {
        if ($quantity > 0) {
            $query = $conn->prepare("UPDATE wishlist SET quantity = ? WHERE id = ? AND user_id = ?");
            $query->bind_param("iii", $quantity, $wishlist_id, $user_id);
            $query->execute();
        }
    }
}

header("Location: wishlist.php");
exit();
?>
