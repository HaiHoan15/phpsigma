<link rel="stylesheet" href="../../assets/css/pay.css">
<link rel="stylesheet" href="../../assets/css/style.css">
<?php
session_start();
include '../../config/database.php';

if (isset($_POST['total_price'])) {
    $_SESSION['total_price'] = $_POST['total_price'];
    $_SESSION['payment_method'] = $_POST['payment_method']; 
    header("Location: pay.php"); 
    exit;
} elseif (!isset($_SESSION['total_price'])) {
    echo "Dữ liệu không hợp lệ. Vui lòng thử lại.";
    exit;
}

$total_price = $_SESSION['total_price'];

if (isset($_POST['confirm_payment'])) {
    if (!isset($_POST['payment_method']) || empty($_POST['payment_method'])) {
        echo "Vui lòng chọn phương thức thanh toán.";
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $name = htmlspecialchars($_POST['name']);
    $address = htmlspecialchars($_POST['address']);
    $phone = htmlspecialchars($_POST['phone']);
    $payment_method = htmlspecialchars($_POST['payment_method']);

    $query = "INSERT INTO orders (user_id, name, address, phone, payment_method, total_price, status)
              VALUES (?, ?, ?, ?, ?, ?, 'Pending')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issssd", $user_id, $name, $address, $phone, $payment_method, $total_price);

    if ($stmt->execute()) {
        unset($_SESSION['total_price']);
        unset($_SESSION['payment_method']);

        echo "<script>
            alert('Thanh toán thành công! Đơn hàng của bạn đang chờ duyệt.');
            window.location.href = '../../pages/wishlist/wishlist.php';
        </script>";
    } else {
        echo "Lỗi khi lưu thông tin thanh toán: " . $stmt->error;
    }

    exit;
}

?>

<div class="container">
    <h2>Nhập Thông Tin Thanh Toán</h2>
    <form method="post" action="pay.php">
        <label>Họ tên:</label>
        <input type="text" name="name" required><br>

        <label>Địa chỉ:</label>
        <input type="text" name="address" required><br>

        <label>Số điện thoại:</label>
        <input type="text" name="phone" required><br>

        <label>Phương thức thanh toán:</label>
        <select name="payment_method" id="payment_method" required>
            <option value="Tiền mặt" <?php echo (isset($_SESSION['payment_method']) && $_SESSION['payment_method'] == "Tiền mặt") ? 'selected' : ''; ?>>Tiền mặt</option>
            <option value="Chuyển khoản" <?php echo (isset($_SESSION['payment_method']) && $_SESSION['payment_method'] == "Chuyển khoản") ? 'selected' : ''; ?>>Chuyển khoản</option>
        </select><br>

        <p><b>Tổng giá: </b><?php echo number_format($total_price); ?> VND</p>

        <div id="qrCodeContainer" style="display: <?php echo (isset($_SESSION['payment_method']) && $_SESSION['payment_method'] == "Chuyển khoản") ? 'block' : 'none'; ?>;">
            <p>Vui lòng quét mã QR nếu thanh toán chuyển khoản <br/>Nội dung chuyển khoản: Họ tên - địa chỉ - SDT</p>
            <img src="../../assets/images/image_page/qr_code.jpg" alt="QR Code" width="200">
        </div>

        <button type="submit" name="confirm_payment">Thanh toán</button>
    </form>
</div>

<script src="../../assets/js/pay.js"></script>
