<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header('location: ../Login/login.php');
    exit();
}

include '../Includes/head.php';
?>
<body class="d-flex flex-column min-vh-100">

<!-- Header bar -->
<?php include '../Includes/header.php'; ?>

<div class="d-flex flex-row">

    <!-- Navigation bar -->
    <nav class="navbar navbar-dark flex-column custom-navbar">
        <span class="navbar-brand custom-navbar-brand">Overzicht</span>
        <ul class="navbar-nav flex-column custom-width">
            <li class="nav-item">
                <a id="groepen-link" class="nav-link rounded-pill px-3 py-2 mb-2 text-white bg-primary d-flex justify-content-between align-items-center" href="#" onclick="loadContent('groepen', 'groepen-link')">
                    Groepen
                    <i class='bx bx-menu'></i>
                </a>
            </li>
            <li class="nav-item">
                <a id="fotos-link" class="nav-link rounded-pill px-3 py-2 mb-2 text-white bg-primary d-flex justify-content-between align-items-center" href="#" onclick="loadContent('fotos', 'fotos-link')">
                    Foto's
                    <i class='bx bx-menu'></i>
                </a>
            </li>
            <li class="nav-item">
                <a id="puntenstelling-link" class="nav-link rounded-pill px-3 py-2 mb-2 text-white bg-primary d-flex justify-content-between align-items-center" href="#" onclick="loadContent('puntenstelling', 'puntenstelling-link')">
                    Puntenstelling
                    <i class='bx bx-menu'></i>
                </a>
            </li>
            <li class="nav-item">
                <a id="vragen-link" class="nav-link rounded-pill px-3 py-2 mb-2 text-white bg-primary d-flex justify-content-between align-items-center" href="#" onclick="loadContent('vragen', 'vragen-link')">
                    Vragen
                    <i class='bx bx-menu'></i>
                </a>
            </li>
            <!-- Add more links as needed -->
        </ul>
        <div class="text-right pr-2">
            <!-- This div is removed as the icons are now part of each nav link -->
        </div>
    </nav>

    <div class="flex-grow-1 p-3" id="content-container">
        <!-- Admin dashboard content goes here -->
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

        <!-- Logout button -->
        <form method="post" action="../Login/logout.php">
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

</div>

<!-- Include Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    function loadContent(page, linkId) {
        // Reset the color and icon of all links
        resetLinks();

        // Toggle the 'active-link' class to indicate whether the menu is open or closed
        const link = document.getElementById(linkId);
        link.classList.toggle('active-link');

        // Update the icon based on the menu state
        const icon = link.querySelector('i');
        if (link.classList.contains('active-link')) {
            icon.className = 'bx bx-x';
        } else {
            icon.className = 'bx bx-menu';
        }

        // Toggle the visibility of the content container
        const contentContainer = document.getElementById('content-container');
        if (link.classList.contains('active-link')) {
            // You can customize the content based on the clicked menu link
            fetchContent(page, contentContainer);
        } else {
            contentContainer.innerHTML = '';
        }
    }

    function fetchContent(page, container) {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    container.innerHTML = this.responseText;
                } else {
                    console.error(`Failed to fetch content for ${page}. Status: ${this.status}`);
                }
            }
        };
        xhttp.open("GET", `${page}.php`, true);
        xhttp.send();
    }


    function resetLinks() {
        // Reset the color and icon of all links
        const links = document.querySelectorAll('.navbar-nav .nav-link');
        links.forEach(link => {
            link.classList.remove('active-link');
            const icon = link.querySelector('i');
            icon.className = 'bx bx-menu';
        });

        // Hide the content container when resetting links
        const contentContainer = document.getElementById('content-container');
        contentContainer.style.display = 'none';
    }
</script>



</body>
</html>
