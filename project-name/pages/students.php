<?php
// students.php - Quản lý sinh viên (dành cho admin)

// Kết nối đến cơ sở dữ liệu
include '../config/config.php';

// Lấy danh sách sinh viên từ cơ sở dữ liệu
$query = "SELECT * FROM students";
$result = mysqli_query($conn, $query);

// Kiểm tra xem có sinh viên nào không
if (mysqli_num_rows($result) > 0) {
    echo "<h1>Quản lý sinh viên</h1>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Tên</th><th>Email</th><th>Hành động</th></tr>";
    
    // Hiển thị danh sách sinh viên
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td><a href='edit_student.php?id=" . $row['id'] . "'>Sửa</a> | <a href='delete_student.php?id=" . $row['id'] . "'>Xóa</a></td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "<h1>Không có sinh viên nào.</h1>";
}

// Đóng kết nối
mysqli_close($conn);
?>