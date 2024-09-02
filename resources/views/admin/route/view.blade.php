
<x-app-layout>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <style>
    #map {
        height: 400px;
    }
    </style>
    <!-- Main Layout with Sidebar -->
    <div class="flex">

        <!-- Sidebar -->
        <div class="sidebar">
            <x-schedule-sidebar />
        </div>


        <!-- Main Content -->
        <div class="container">
            <!-- Breadcrumb -->
            @include('partials.flash_messages')
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Routes</li>
                </ol>
              </nav>
            <h1 class="table-title">Route Content</h1>
            <a href="{{ route('admin.route.add') }}" class="btn btn-primary mb-3">Add Route</a>
        <table class="google-form-table">
            <thead>
                <tr>
                   <th>RouteID</th>
                   <th>Origin</th>
                   <th>Destination</th>
                   <th>Description</th>
                   <th>Actions</th>

               </tr>
           </thead>
                   <tbody>
                   @foreach ($routes as $route)
                       <tr>
                        <td>{{ $route->RouteID }}</td>
                        <td>{{ $route->Origin }}</td>
                        <td>{{ $route->Destination }}</td>
                        <td>{{ $route->Description }}</td>
                        <td>
                           <form action="{{ route('admin.route.delete', ['id' => $route->RouteID]) }}" method="post">
                               @csrf
                               @method('delete')
                               <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this route?')">Delete</button>
                           </form>
                       </td>

                       </tr>
                         @endforeach
                    </tbody>
        </table>
        <div id="map"></div>
        </div>
    </div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script>
    var map = L.map('map').setView([2.1896, 102.2501], 13);

    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Function to generate a random color
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    // Add routes for each route
    @foreach ($routes as $route)
        (function() {
            // Origin and destination coordinates
            var origin = [{{ $route->OriginLatitude }}, {{ $route->OriginLongitude }}];
            var destination = [{{ $route->DestinationLatitude }}, {{ $route->DestinationLongitude }}];
            // Add origin marker
            var originMarker = L.marker(origin).bindPopup('<b>Origin: {{ $route->Origin }}</b><br>{{ $route->Description }}').addTo(map);
            // Add destination marker
            var destinationMarker = L.marker(destination).bindPopup('<b>Destination: {{ $route->Destination }}</b><br>{{ $route->Description }}').addTo(map);


            // Add routing control
            var control = L.Routing.control({
                waypoints: [
                    L.latLng(origin[0], origin[1]),
                    L.latLng(destination[0], destination[1])
                ],
                routeWhileDragging: true,
                addWaypoints: false,
                createMarker: function() { return null; }, // No markers for waypoints
                lineOptions: {
                    styles: [{ color: getRandomColor(), opacity: 0.6, weight: 4, dashArray: '5, 10' }]
                }
            }).addTo(map);

            // Hide the route control UI
            control.getContainer().style.display = 'none';
        })();
    @endforeach
</script>
    </x-app-layout>
