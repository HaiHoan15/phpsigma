<!-- trang chủ -->
<?php 
include 'header.php'; 
include 'config/database.php'; 
?>
<header class="hero-section text-center">
    <h1>Chào mừng đến với shop giường nằm</h1>
</header>
<!-- Danh sách sản phẩm -->
<div class="container my-5">
    <div class="row">
        <?php
        if (!isset($conn)) {
            die("Lỗi kết nối database.");
        }

        $sql = "SELECT id, image, title, description FROM products"; 
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '    <div class="card h-100">'; 
                echo '        <img src="'.$row["image"].'" class="card-img-top" alt="'.$row["title"].'" style="height: 200px; object-fit: cover;">';
                echo '        <div class="card-body d-flex flex-column justify-content-between" style="min-height: 180px;">';
                echo '            <h5 class="card-title">'.$row["title"].'</h5>';
                echo '            <p class="card-text">'.$row["description"].'</p>';
                echo '            <a href="product_information.php?id='.$row["id"].'" class="btn btn-primary mt-auto">Xem chi tiết</a>'; 
                echo '        </div>';
                echo '    </div>';
                echo '</div>';
            }
        } else {
            echo "<p>Không có sản phẩm nào.</p>";
        }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
