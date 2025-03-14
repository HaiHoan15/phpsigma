<?php
// reports.php

// Include the configuration file
include_once '../config/config.php';

// Start session
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../pages/login.php');
    exit();
}

// Fetch reports from the database
$query = "SELECT * FROM reports"; // Adjust the query as needed
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reports</title>
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Adjust the path as needed -->
</head>
<body>

<?php include '../includes/navbar.php'; ?>
<?php include '../includes/header.php'; ?>

<h1>Admin Reports</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Report Title</th>
            <th>Date Created</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <a href="view_report.php?id=<?php echo $row['id']; ?>">View</a>
                        <a href="delete_report.php?id=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No reports found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>

</body>
</html>