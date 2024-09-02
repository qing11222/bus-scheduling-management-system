<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"> <!-- Include your CSS file -->
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
                    <li class="breadcrumb-item"><a href="{{route('admin.schedule.view')}}">Schedule</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
            <div class="form-custom">
                <h1>Add Stop</h1>
                @include('partials.flash_messages')

                <form action="{{ route('admin.stop.store') }}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <td><label for="Name">Stop Name</label></td>
                            <td><input type="text" name="Name" placeholder="name" class="form-control" value="{{ old('Name') }}" required></td>
                        </tr>
                        <tr>
                            <td><label for="Location">Location</label></td>
                            <td><input type="text" name="Location" placeholder="location" class="form-control" value="{{ old('Location') }}" required></td>
                        </tr>
                        <tr>
                            <td><label for="picture">Picture:</label></td>
                            <td> <input type="file" name="picture" id="picture"></td>
                        </tr>
                        <tr>
                            <td  colspan="2"><input type="hidden" id="Latitude" name="Latitude">
                                <input type="hidden" id="Longitude" name="Longitude">
                                <div id="map"></div></td>

                        </tr>

                    </table>
                    <button type="submit" class="btn btn-primary">Add Bus Stop</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script>
         document.addEventListener('DOMContentLoaded', function() {
            // Initialize the map with default view set to Melaka, Malaysia
            var map = L.map('map', {
                dragging: true // Enable dragging on the map
            }).setView([2.1896, 102.2501], 13);

            // Add the OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            // Add the geocoder control to the map
            var geocoder = L.Control.geocoder({
                defaultMarkGeocode: false
            }).on('markgeocode', function(e) {
                var latlng = e.geocode.center;
                L.marker(latlng).addTo(map);
                map.setView(latlng, map.getZoom());
                document.getElementById('Latitude').value = latlng.lat;
                document.getElementById('Longitude').value = latlng.lng;
            }).addTo(map);

            // Optional: add a placeholder for the geocoder input
            L.Control.geocoder({
                collapsed: false,
                placeholder: 'Search for a location'
            }).addTo(map);

            // Event listener for click on the map
            map.on('click', function(e) {
                // Clear previous markers
                map.eachLayer(function(layer) {
                    if (layer instanceof L.Marker) {
                        map.removeLayer(layer);
                    }
                });

                // Add marker at clicked location
                var marker = L.marker(e.latlng).addTo(map);

                // Update form fields with clicked coordinates
                document.getElementById('Latitude').value = e.latlng.lat;
                document.getElementById('Longitude').value = e.latlng.lng;
            });
        });
    </script>
</x-app-layout>
