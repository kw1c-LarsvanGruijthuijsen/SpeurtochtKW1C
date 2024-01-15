<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../Includes/db-functions.php';
session_start();

$errors = array(); // Initialize an empty array to store errors

// Function to check and clear username and password fields if errors exist
function clearFieldsOnErrors($errors) {
    if (in_array("Username and password are required", $errors) || in_array("Wrong username or password combination", $errors)) {
        // Clear the username and password fields
        $_POST['username'] = '';
        $_POST['password'] = '';
    }
}

// Establish the database connection
$conn = db_connect();

// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        array_push($errors, "Username and password are required");
    } else {
        // SQL query for login
        $selectUserSql = "SELECT * FROM Users WHERE UserName = ?";
        $selectUserParams = array($username);
        $selectUserStmt = sqlsrv_query($conn, $selectUserSql, $selectUserParams);

        if ($selectUserStmt) {
            $user = sqlsrv_fetch_array($selectUserStmt, SQLSRV_FETCH_ASSOC);

            if ($user) {
                if (password_verify($password, $user['PasswordHash'])) { // Verify password
                    if ($user['IsLoggedIn'] == 1) {
                        array_push($errors, "User is already logged in");
                    } else {
                        // Set IsLoggedIn to 1
                        $updateLoginStatusSql = "UPDATE Users SET IsLoggedIn = 1 WHERE UserID = ? AND IsLoggedIn = 0";
                        $updateLoginStatusParams = array($user['UserID']);
                        $updateLoginStatusStmt = sqlsrv_query($conn, $updateLoginStatusSql, $updateLoginStatusParams);

                        if ($updateLoginStatusStmt === false || sqlsrv_rows_affected($updateLoginStatusStmt) === 0) {
                            // If the update affected 0 rows, someone else may have already updated the status
                            array_push($errors, "Failed to update login status: User may already be logged in");
                        } else {
                            // Continue with the rest of the login process

                            $_SESSION['username'] = $user['UserName'];
                            $_SESSION['isAdmin'] = $user['IsAdmin'];
                            $_SESSION['success'] = "You are now logged in";

                            // Check user role and redirect accordingly
                            if ($user['IsAdmin']) {
                                header('location: ../AdminDashboard.php');
                            } else {
                                header('location: ../UserDashboard.php');
                            }
                        }
                    }
                } else {
                    array_push($errors, "Invalid username or password");
                }
            } else {
                array_push($errors, "Invalid username or password");
            }
        } else {
            array_push($errors, "Login failed: " . print_r(sqlsrv_errors(), true));
        }
    }
}

// Close the database connection
sqlsrv_close($conn);
?>
