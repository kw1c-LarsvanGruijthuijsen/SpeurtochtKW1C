<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header('location: ../Login/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>

<h1>Welcome, <?php echo $_SESSION['username']; ?></h1>

<!--  user dashboard content goes here -->

<!-- Logout button -->
<form method="post" action="../Login/logout.php">
    <button type="submit">Logout</button>
</form>

</body>
</html>
