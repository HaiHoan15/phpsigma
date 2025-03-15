<!-- thông tin sản phẩm -->
<?php 
include 'header.php'; 
include 'config/database.php'; 

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Sản phẩm không tồn tại.");
}

$product_id = $_GET['id'];

$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Không tìm thấy sản phẩm.");
}

$product = $result->fetch_assoc();
?>

<!-- Chi tiết sản phẩm -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo $product['image']; ?>" 
                class="img-fluid" 
                alt="<?php echo $product['title']; ?>" 
                style="width: 100%; height: 300px; object-fit: cover; border-radius: 10px;">
        </div>

        <div class="col-md-6">
            <h2><?php echo $product['title']; ?></h2>
            <p><strong>Chất liệu:</strong> <?php echo $product['material']; ?></p>
            <p><strong>Kích thước:</strong> <?php echo $product['size']; ?></p>
            <p><strong>Nhà cung cấp:</strong> <?php echo $product['supplier']; ?></p>
            <p><strong>Giá cả:</strong> <?php echo number_format($product['price'], 2); ?> VND</p>
            <p><strong>Mô tả chi tiết:</strong> <?php echo $product['moredescription']; ?></p>
            <a href="home.php" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
