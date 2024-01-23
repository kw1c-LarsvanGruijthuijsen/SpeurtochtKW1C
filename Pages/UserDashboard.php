<?php
include '../Includes/head.php';
include '../Includes/header.php';
?>

<script>
    // Function to fetch content from the specified URL and update the target container
    function fetchContent(url, targetContainer) {
        fetch(url)
            .then(response => response.text())
            .then(content => {
                targetContainer.innerHTML = content;
            })
            .catch(error => console.error('Error fetching content:', error));
    }

    // Function to load the initial page
    function loadInitialPage() {
        const initialPageContainer = document.getElementById('content-container');
        fetchContent('User/GroupCreation.php', initialPageContainer);
    }

    // Function to load pages in a specific order
    function loadPagesInOrder() {
        const order = [
            'Page1.php',
            'Page2.php',
            // Add more pages in the desired order
        ];

        order.forEach(page => {
            const pageContainer = document.getElementById('content-container');
            fetchContent('User/' + page, pageContainer);
        });
    }

    // Fetch and load the initial page on page load
    document.addEventListener('DOMContentLoaded', function () {
        loadInitialPage();
        // Uncomment the line below if you also want to load other pages in a specific order on page load
        // loadPagesInOrder();
    });
</script>

