<?php
include '../Includes/db-functions.php';
session_start();

// Establish the database connection
$conn = db_connect();

// Function to hash passwords
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Add Groups
$groupsData = array(
    'Group1',
    'Group2',
    'Group3',
    'Group4',
    'Group5',
    'Group6',
    'Group7',
    'Group8'
);

foreach ($groupsData as $groupName) {
    $sqlInsertGroup = "INSERT INTO Groups (GroupName, IsTemporaryGroup) VALUES (?, 0)";
    $paramsInsertGroup = array($groupName);
    $stmtInsertGroup = sqlsrv_query($conn, $sqlInsertGroup, $paramsInsertGroup);

    if ($stmtInsertGroup) {
        echo "Group '$groupName' added successfully.<br>";
    } else {
        die("Error adding group '$groupName': " . print_r(sqlsrv_errors(), true));
    }
}

// Add Admins
$adminsData = array(
    array('Lars', 'Password'),
    array('dylan', 'Password'),
    array('Tijn', 'Password'),
    array('Janneke', 'Password'),
    array('Joris', 'Password')
);

foreach ($adminsData as $adminData) {
    $adminUsername = $adminData[0];
    $adminPassword = $adminData[1];
    $adminPasswordHash = hashPassword($adminPassword);

    $sqlInsertAdmin = "INSERT INTO Users (UserName, PasswordHash, IsAdmin) VALUES (?, ?, 1)";
    $paramsInsertAdmin = array($adminUsername, $adminPasswordHash);
    $stmtInsertAdmin = sqlsrv_query($conn, $sqlInsertAdmin, $paramsInsertAdmin);

    if ($stmtInsertAdmin) {
        echo "Admin '$adminUsername' added successfully.<br>";
    } else {
        die("Error adding admin '$adminUsername': " . print_r(sqlsrv_errors(), true));
    }
}

// Add Users
$usersData = array(
    array('user1', 'Password1'),
    array('user2', 'Password2'),
    array('user3', 'Password3'),
    array('user4', 'Password4'),
    array('user5', 'Password5'),
    array('user6', 'Password6'),
    array('user7', 'Password7'),
    array('user8', 'Password8')
);

foreach ($usersData as $key => $userData) {
    $username = $userData[0];
    $password = $userData[1];
    $passwordHash = hashPassword($password);

    // Determine GroupID dynamically based on available groups
    $groupID = $key < count($groupsData) ? $key + 1 : 1; // Use Group1 if not enough groups

    $sqlInsertUser = "INSERT INTO Users (UserName, PasswordHash, IsAdmin, GroupID) VALUES (?, ?, 0, ?)";
    $paramsInsertUser = array($username, $passwordHash, $groupID);
    $stmtInsertUser = sqlsrv_query($conn, $sqlInsertUser, $paramsInsertUser);

    if ($stmtInsertUser) {
        echo "User '$username' added successfully and linked to Group $groupID.<br>";
    } else {
        die("Error adding user '$username': " . print_r(sqlsrv_errors(), true));
    }
}

// Close the database connection
sqlsrv_close($conn);
?>
