<!DOCTYPE html>
<html>
<head>
    <title>GPS Tracking</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 600px;
            width: 100%;
            position: relative;
        }
        #refreshButton {
            position: absolute;
            top: 10px;
            left: 50px;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1000; /* Ensure the button is above the map */
        }
        #lastUpdate {
            position: absolute;
            top: 50px;
            left: 50px;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 10px;
            border-radius: 5px;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <div id="map">
        <button id="refreshButton">Refresh Location</button>
        <div id="lastUpdate">Last Update Time: Not updated yet</div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Initialize the map with default coordinates
        var map = L.map('map').setView([0, 0], 13);

        // Set up the tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Initialize a marker at default coordinates
        var marker = L.marker([0, 0]).addTo(map);

        var currentPosition = { latitude: 0, longitude: 0 }; // To store the current position
        var lastUpdateTime = 'Not updated yet'; // To store the last update time

        function updateLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    currentPosition.latitude = position.coords.latitude;
                    currentPosition.longitude = position.coords.longitude;

                    // Update marker position and map view
                    marker.setLatLng([currentPosition.latitude, currentPosition.longitude]);
                    map.setView([currentPosition.latitude, currentPosition.longitude], 13);

                    // Update last update time
                    lastUpdateTime = new Date().toISOString();
                    document.getElementById('lastUpdate').innerText = 'Last Update Time: ' + lastUpdateTime;

                    // Send the updated location data to the server
                    fetch('/update-location', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            latitude: currentPosition.latitude,
                            longitude: currentPosition.longitude
                        })
                    }).then(response => response.json())
                      .then(data => console.log('Server Response:', data))
                      .catch(error => console.error('Error:', error));
                }, errorHandler, {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function errorHandler(error) {
            console.warn('ERROR(' + error.code + '): ' + error.message);
        }

        // Set up the interval to update location every 3 minutes (180000 ms)
        var intervalID = setInterval(updateLocation, 180000); // 180000 ms = 3 minutes

        // Initial call to set up the map with the current location
        updateLocation();

        // Add an event listener to the refresh button
        document.getElementById('refreshButton').addEventListener('click', () => {
            updateLocation(); // Call updateLocation function on button click
        });
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</body>
</html>
