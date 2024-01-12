<?php
include 'server.php'; // Include the login logic

if (isset($_SESSION['username'])) {
    header('location: ../index.php'); // Redirect if already logged in
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
    <img class="img" src="../Images/Logo_KW1C.svg" alt="Description of the image" width="100" height="75">
    <h2 class="header-txt">Login</h2>
</div>

<form method="post" action="login.php">
    <!-- Display errors here -->
    <?php if (count($errors) > 0): ?>
        <div>
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach ?>
        </div>
    <?php endif ?>

    <div class="input-group">
        <label>Gebruikersnaam</label>
        <input type="text" name="username" required>
    </div>

    <div class="input-group">
        <label>Wachtwoord</label>
        <input type="password" name="password" required>
    </div>

    <div class="input-group">
        <button type="submit" class="btn" name="login_user">Login</button>
    </div>
</form>
</body>
</html>
