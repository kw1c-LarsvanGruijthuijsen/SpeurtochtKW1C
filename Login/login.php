<?php
include 'server.php'; // Include the login logic

if (isset($_SESSION['username'])) {
    header('location: ../index.php'); // Redirect if already logged in
    exit();
}

include '../Includes/head.php';
include '../Includes/header.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


<form method="post" action="login.php">
    <!-- Display errors here -->
    <?php if (count($errors) > 0): ?>
        <div>
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach ?>
        </div>
    <?php endif ?>

    <div  class="input-group" class="mb-3" >
  <label for="exampleFormControlInput1" class="form-label">Gebruikersnaam</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="gebruikersnaam" name="username" required>
</div>
<div  class="input-group" class="mb-3" >
<label for="exampleFormControlInput1" class="form-label">Wachtwoord</label>
  <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="wachtwoord" name="password" required>
</div>

    <div class="input-group">
        <button type="submit" class="btn" name="login_user">Login</button>
    </div>
</form>
</body>
</html>
