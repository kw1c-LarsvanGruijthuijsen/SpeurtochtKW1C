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
    function successCallback(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;

        document.getElementById('location-info').innerHTML = 'Your current location: ' + latitude + ', ' + longitude;

        console.log('Current Coordinates:', latitude, longitude);
    }

    function errorCallback(error) {
        document.getElementById('location-info').innerHTML = 'Error getting location: ' + error.message;
    }

    const options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
    };

    // Requesting continuous geolocation updates
    const watchId = navigator.geolocation.watchPosition(successCallback, errorCallback, options);

    // To stop watching the position (optional)
    // navigator.geolocation.clearWatch(watchId);
</script>
    
        </body>
</html>