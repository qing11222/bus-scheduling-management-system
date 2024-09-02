<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        #message {
            display: none;
            color: red;
            text-align: center;
            margin: 20px;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <div id="message">No location data available.</div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('map').setView([0, 0], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var markers = [];
            var path = []; // To hold the path coordinates

            @if ($locationDatas->isNotEmpty())
                @foreach($locationDatas as $locationData)
                    var lat = {{ $locationData->latitude }};
                    var lng = {{ $locationData->longitude }};
                    var userId = "{{ $locationData->userName }}";
                    var timestamp = "{{ $locationData->timestamp }}";

                    var popupContent = "<strong>Driver Name:</strong> " + userId + "<br>" +
                                       "<strong>Timestamp:</strong> " + timestamp + "<br>" +
                                       "<strong>Latitude:</strong> " + lat + "<br>" +
                                       "<strong>Longitude:</strong> " + lng;

                    var marker = L.marker([lat, lng]).addTo(map);
                    marker.bindPopup(popupContent);
                    markers.push(marker);

                    path.push([lat, lng]); // Add coordinate to path
                @endforeach

                if (path.length > 1) {
                    L.polyline(path, {color: 'blue'}).addTo(map); // Draw the path
                }
                map.setView([path[path.length - 1][0], path[path.length - 1][1]], 13);
            @else
                Swal.fire({
                    icon: 'info',
                    title: 'No Location Data',
                    text: 'No location data available.',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
</body>
</html>
