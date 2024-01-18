<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geolocation Example</title>
</head>
<body>
    <h1>Walking Route with Quiz</h1>
    <p id="location-info">Waiting for location...</p>

    <script>
        // Function to handle successful geolocation retrieval
        function successCallback(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            document.getElementById('location-info').innerHTML = Your current location: ${latitude}, ${longitude};

            // You can now use these coordinates to check against your predefined locations and trigger the quiz.
            // For simplicity, let's log the coordinates to the console.
            console.log('Current Coordinates:', latitude, longitude);
        }

        // Function to handle geolocation error
        function errorCallback(error) {
            document.getElementById('location-info').innerHTML = Error getting location: ${error.message};
        }

        // Options for geolocation (optional)
        const options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
        };

        // Requesting geolocation
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback, options);
    </script>
</body>
</html>