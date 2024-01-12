<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header('location: Login/login.php');
    exit();
}

// Check if the user is an admin
$isAdmin = isset($_SESSION['isAdmin']) ? $_SESSION['isAdmin'] : false;

// Redirect to the appropriate dashboard
if ($isAdmin) {
    header('location: Pages/AdminDashboard.php');
    exit();
} else {
    header('location: Pages/UserDashboard.php');
    exit();
}
?>

<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

<p><a href="logout.php">Logout</a></p>-->

</body>
</html>
