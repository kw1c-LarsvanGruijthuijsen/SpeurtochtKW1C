<?php
include 'server.php'; // Include the login logic

if (isset($_SESSION['username'])) {
    header('location: ../index.php'); // Redirect if already logged in
    exit();
}

include '../Includes/head.php';
include '../Includes/header.php';

?>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <form method="post" action="login.php" class="loginForm">
                <!-- Display errors here -->
                <?php if (count($errors) > 0): ?>
                    <div>
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>

                <div class="text-center mb-4">
                    <h1>Login</h1>
                </div>

                <div class="form-group">
                    <label for="username">Gebruikersnaam</label>
                    <input type="text" class="form-control" id="username" placeholder="gebruikersnaam" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Wachtwoord</label>
                    <input type="password" class="form-control" id="password" placeholder="wachtwoord" name="password" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="login_user">Inloggen</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
