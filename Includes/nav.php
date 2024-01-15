<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

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
        <h1 id="welcome">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <span class="navbar-brand custom-navbar-brand mb-4">Overzicht</span>

        <ul class="navbar-nav flex-column custom-width">
            <li class="nav-item">
                <a id="groepen-link" class="nav-link rounded-pill px-3 py-2 mb-2 text-white bg-primary d-flex justify-content-between align-items-center"
                   href="groups.php" data-target="content-container">Groepen<i class='bx bx-menu'></i>
                </a>
            </li>
            <li class="nav-item">
                <a id="fotos-link" class="nav-link rounded-pill px-3 py-2 mb-2 text-white bg-primary d-flex justify-content-between align-items-center"
                   href="pictures.php" data-target="content-container">Foto's<i class='bx bx-menu'></i>
                </a>
            </li>
            <li class="nav-item">
                <a id="puntenstelling-link" class="nav-link rounded-pill px-3 py-2 mb-2 text-white bg-primary d-flex justify-content-between align-items-center"
                   href="points.php" data-target="content-container">Puntenstelling<i class='bx bx-menu'></i>
                </a>
            </li>
            <li class="nav-item">
                <a id="vragen-link" class="nav-link rounded-pill px-3 py-2 mb-4 text-white bg-primary d-flex justify-content-between align-items-center"
                   href="questions.php" data-target="content-container">Vragen<i class='bx bx-menu'></i>
                </a>
            </li>
            <!-- Add more links as needed -->

            <!-- Move the logout button above the reset button -->
            <li class="nav-item">
                <form method="post" action="../Login/logout.php">
                    <button type="submit" class="nav-link rounded-pill px-3 py-2 mb-4 text-white bg-primary d-flex justify-content-center align-items-center w-100">
                        Logout
                    </button>
                </form>
            </li>

            <!-- Add a new reset button with red styling below the logout button -->
            <li class="nav-item mt-4">
                <button id="reset-button" class="nav-link rounded-pill px-3 py-2 mb-2 text-white bg-danger d-flex justify-content-center align-items-center w-100"
                        onclick="resetEverything()">Reset
                </button>
            </li>
        </ul>
    </nav>

    <div class="flex-grow-1 p-3" id="content-container">
        <!-- Admin dashboard content goes here -->

    </div>
</div>


<!-- Include Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    let activeLink = null;

    // Function to handle link click
    function handleLinkClick(link) {
        // Toggle the hamburger and close (X) icons
        const menuIcon = link.querySelector('i');
        if (menuIcon.classList.contains('bx-menu')) {
            menuIcon.classList.replace('bx-menu', 'bx-x');
        } else {
            menuIcon.classList.replace('bx-x', 'bx-menu');
        }

        // Check if the clicked link is already active
        const isAlreadyActive = link.classList.contains('active-link');

        // Reset the styles for the previously active link
        if (activeLink && !isAlreadyActive) {
            activeLink.classList.remove('active-link');
            // Reset the icon to hamburger menu
            const activeMenuIcon = activeLink.querySelector('i');
            activeMenuIcon.classList.replace('bx-x', 'bx-menu');
        }

        // Set the active styles for the clicked link
        link.classList.toggle('active-link');
        activeLink = link;

        // Load content from the specified URL into the target container
        const targetContainerId = link.getAttribute('data-target');
        const targetContainer = document.getElementById(targetContainerId);

        // If the clicked link is already active, load overview.php content
        if (isAlreadyActive) {
            fetchContent('overview.php', targetContainer);
        } else {
            // Otherwise, load content from the clicked link's href
            fetchContent(link.href, targetContainer);
        }
    }

    // Function to reset styles for all links
    function resetLinks() {
        const links = document.querySelectorAll('.navbar-nav .nav-link');
        links.forEach(link => {
            link.classList.remove('active-link');
        });
    }

    // Function to fetch content from the specified URL and update the target container
    function fetchContent(url, targetContainer) {
        fetch(url)
            .then(response => response.text())
            .then(content => {
                targetContainer.innerHTML = content;
            })
            .catch(error => console.error('Error fetching content:', error));
    }

    // Fetch and load overview.php on page load
    document.addEventListener('DOMContentLoaded', function() {
        const overviewContainer = document.getElementById('content-container');
        fetchContent('overview.php', overviewContainer);
    });

    // Add click event listeners to each link
    const links = document.querySelectorAll('.navbar-nav .nav-link');
    links.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior
            handleLinkClick(this);
        });
    });
</script>


</body>
</html>
