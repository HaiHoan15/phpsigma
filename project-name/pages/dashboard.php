<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include the header and navigation bar
include('../includes/header.php');
include('../includes/navbar.php');

// Fetch user data from the session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username']; // Assuming username is stored in session

// Display the dashboard content
?>

<div class="container">
    <h1>Welcome to your Dashboard, <?php echo htmlspecialchars($username); ?>!</h1>
    <p>This is your personal dashboard where you can manage your profile and access various features.</p>
    
    <h2>Your Information</h2>
    <p>User ID: <?php echo htmlspecialchars($user_id); ?></p>
    <p>Username: <?php echo htmlspecialchars($username); ?></p>
    
    <h2>Quick Links</h2>
    <ul>
        <li><a href="students.php">Manage Students</a></li>
        <li><a href="lecturers.php">Manage Lecturers</a></li>
        <li><a href="assignments.php">Manage Assignments</a></li>
    </ul>
</div>

<?php
// Include the footer
include('../includes/footer.php');
?>