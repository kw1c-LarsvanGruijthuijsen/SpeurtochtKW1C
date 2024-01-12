<?php
session_start();

// Establish the database connection
include '../Includes/db-functions.php';
$conn = db_connect();

// Retrieve the username from the session
$username = $_SESSION['username'];

// Update IsLoggedIn to 0 in the database
$updateLogoutStatusSql = "UPDATE Users SET IsLoggedIn = 0 WHERE UserName = ?";
$updateLogoutStatusParams = array($username);
$updateLogoutStatusStmt = sqlsrv_query($conn, $updateLogoutStatusSql, $updateLogoutStatusParams);

// Check if the update was successful
if ($updateLogoutStatusStmt === false) {
    die("Failed to update logout status: " . print_r(sqlsrv_errors(), true));
}

// Close the database connection
sqlsrv_close($conn);

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page after logout
header('location: login.php');
exit();
?>
