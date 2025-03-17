<!-- xóa giỏ hàng -->
<?php
session_start();
require 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $wishlist_id = $_GET['id'];

    $query = $conn->prepare("DELETE FROM wishlist WHERE id = ?");
    $query->bind_param("i", $wishlist_id);
    $query->execute();
}

header("Location: wishlist.php");
exit();
?>
