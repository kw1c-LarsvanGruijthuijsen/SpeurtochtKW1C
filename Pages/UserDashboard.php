<?php
include '../Includes/head.php';
include '../Includes/header.php';
?>

<!-- Add a container element to display fetched content -->
<div id="contentContainer"></div>

<script>
    // Function to fetch and display content
    function fetchAndDisplayContent(page) {
        fetch(`User/${page}.php`)
            .then(response => response.text())
            .then(data => {
                // Display the fetched content in the container
                document.getElementById('contentContainer').innerHTML = data;
            })
            .catch(error => console.error('Error fetching content:', error));
    }

    // Fetch content from GroupCreation.php and display it when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        fetchAndDisplayContent('GroupCreation');
    });

    // Example: You can add event listeners or other logic to fetch content from other pages based on user interactions
    // document.getElementById('someButton').addEventListener('click', function() {
    //     fetchAndDisplayContent('SomeOtherPage');
    // });
</script>

<?php
// Add any additional content or scripts for the UserDashboard.php file
?>
