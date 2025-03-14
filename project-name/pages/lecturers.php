<?php
// lecturers.php - Page for managing lecturer records

// Include configuration file
require_once '../config/config.php';

// Start session
session_start();

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Fetch lecturers from the database
$lecturers = [];
$query = "SELECT * FROM lecturers";
$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $lecturers[] = $row;
    }
}

// Include header and navbar
include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="container">
    <h1>Manage Lecturers</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lecturers as $lecturer): ?>
                <tr>
                    <td><?php echo htmlspecialchars($lecturer['id']); ?></td>
                    <td><?php echo htmlspecialchars($lecturer['name']); ?></td>
                    <td><?php echo htmlspecialchars($lecturer['email']); ?></td>
                    <td>
                        <a href="edit_lecturer.php?id=<?php echo $lecturer['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete_lecturer.php?id=<?php echo $lecturer['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="add_lecturer.php" class="btn btn-primary">Add Lecturer</a>
</div>

<?php
// Include footer
include '../includes/footer.php';
?>