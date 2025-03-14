<?php
// assignments.php - Quản lý hướng dẫn (cho bộ môn)

// Kết nối đến cơ sở dữ liệu
require_once '../config/config.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Lấy danh sách các hướng dẫn từ cơ sở dữ liệu
$query = "SELECT * FROM assignments";
$result = mysqli_query($conn, $query);

// Xử lý khi có yêu cầu thêm hoặc xóa hướng dẫn
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_assignment'])) {
        // Thêm hướng dẫn mới
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $query = "INSERT INTO assignments (title, description) VALUES ('$title', '$description')";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['delete_assignment'])) {
        // Xóa hướng dẫn
        $assignment_id = intval($_POST['assignment_id']);
        $query = "DELETE FROM assignments WHERE id = $assignment_id";
        mysqli_query($conn, $query);
    }
    header('Location: assignments.php');
    exit();
}

// Bao gồm header và navbar
include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="container">
    <h1>Quản lý hướng dẫn</h1>

    <form method="POST" action="">
        <input type="text" name="title" placeholder="Tiêu đề" required>
        <textarea name="description" placeholder="Mô tả" required></textarea>
        <button type="submit" name="add_assignment">Thêm hướng dẫn</button>
    </form>

    <h2>Danh sách hướng dẫn</h2>
    <ul>
        <?php while ($assignment = mysqli_fetch_assoc($result)): ?>
            <li>
                <strong><?php echo $assignment['title']; ?></strong>
                <p><?php echo $assignment['description']; ?></p>
                <form method="POST" action="">
                    <input type="hidden" name="assignment_id" value="<?php echo $assignment['id']; ?>">
                    <button type="submit" name="delete_assignment">Xóa</button>
                </form>
            </li>
        <?php endwhile; ?>
    </ul>
</div>

<?php
// Bao gồm footer
include '../includes/footer.php';
?>