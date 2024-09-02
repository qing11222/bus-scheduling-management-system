<x-app-layout>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        #map {
            height: 400px;
            margin-bottom: 20px;
        }
    </style>
    <div class="flex">

        <!-- Sidebar -->
        <div class="sidebar">
            <x-schedule-sidebar />
        </div>

        <!-- Main Content -->
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.route.view')}}">Route</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
            <div class="form-custom">
                <h1>Add Route</h1>
                @include('partials.flash_messages')

                <form action="{{ route('admin.route.store') }}" method="POST">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <label for="Origin">Origin</label>
                            <input type="text" name="Origin" class="form-control" value="{{ old('Origin') }}" required>
                        </tr>
                        <tr>
                            <label for="Destination">Destination</label>
                            <input type="text" name="Destination" class="form-control" value="{{ old('Destination') }}" required>
                        </tr>
                        <tr>
                            <label for="Description">Description</label>
                            <input type="text" name="Description" class="form-control" value="{{ old('Description') }}" required>
                        </tr>
                        <br>
                        <tr>
                            <div id="map"></div>
                            <!-- Hidden inputs to store latitude and longitude for origin -->
                            <input type="hidden" name="OriginLatitude" id="OriginLatitude">
                            <input type="hidden" name="OriginLongitude" id="OriginLongitude">

                            <!-- Hidden inputs to store latitude and longitude for destination -->
                            <input type="hidden" name="DestinationLatitude" id="DestinationLatitude">
                            <input type="hidden" name="DestinationLongitude" id="DestinationLongitude">
                        </tr>

                    </table>
                    <button type="submit" class="btn btn-primary">Add Route</button>
                </form>
            </div>
        </div>
    </div>
<!-- Leaflet.js library for interactive maps -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
    // Initialize the map and set its view to Melaka
    var map = L.map('map').setView([2.1896, 102.2501], 13);

    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Initialize variables to store origin and destination markers
    var originMarker, destinationMarker;

    // Function to handle click events on the map
    function onMapClick(e) {
        if (!originMarker) {
            // Add origin marker
            originMarker = L.marker(e.latlng).addTo(map);
            document.getElementById('OriginLatitude').value = e.latlng.lat;
            document.getElementById('OriginLongitude').value = e.latlng.lng;
        } else if (!destinationMarker) {
            // Add destination marker
            destinationMarker = L.marker(e.latlng).addTo(map);
            document.getElementById('DestinationLatitude').value = e.latlng.lat;
            document.getElementById('DestinationLongitude').value = e.latlng.lng;
        } else {
            // Remove existing markers and add new origin marker
            map.removeLayer(originMarker);
            map.removeLayer(destinationMarker);
            originMarker = L.marker(e.latlng).addTo(map);
            document.getElementById('OriginLatitude').value = e.latlng.lat;
            document.getElementById('OriginLongitude').value = e.latlng.lng;
            destinationMarker = null;
        }
    }

    // Add click event listener to the map
    map.on('click', onMapClick);

    // Add search bar
    var geocoder = L.Control.geocoder({
        defaultMarkGeocode: false
    }).addTo(map);

    // Handle geocoding results
   geocoder.on('markgeocode', function(event) {
   var latlng = event.geocode.center;
   var name = event.geocode.name;

   if (!originMarker) {
       // Add origin marker
       originMarker = L.marker(latlng).addTo(map);
       document.getElementById('OriginLatitude').value = latlng.lat;
       document.getElementById('OriginLongitude').value = latlng.lng;
   } else if (!destinationMarker) {
       // Add destination marker
       destinationMarker = L.marker(latlng).addTo(map);
       document.getElementById('DestinationLatitude').value = latlng.lat;
       document.getElementById('DestinationLongitude').value = latlng.lng;
   } else {
       // Remove existing markers and add new origin marker
       map.removeLayer(originMarker);
       map.removeLayer(destinationMarker);
       originMarker = L.marker(latlng).addTo(map);
       document.getElementById('OriginLatitude').value = latlng.lat;
       document.getElementById('OriginLongitude').value = latlng.lng;
       destinationMarker = null;
   }
});
</script>
</x-app-layout>
