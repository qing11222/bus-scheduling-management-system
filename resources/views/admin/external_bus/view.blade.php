<x-app-layout>
    <!-- Main Layout with Sidebar -->
    <div class="flex">

        <div class="container">
            @include('partials.flash_messages')

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">External Buses</li>
                </ol>
            </nav>
            <br>
            <a href="{{ route('admin.external_bus.add') }}" class="btn btn-primary mb-3">Add New Bus</a>
            <h1 class="table-title">External Bus Content</h1>

                <table class="google-form-table">
                    <thead>
                        <tr>
                            <th>NumberPlate</th>
                            <th>Capacity</th>
                            <th>Zone</th>
                            <th>DepartureDate</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($buses as $bus)
                        <tr>
                            <td>{{ $bus->NumberPlate }}</td>
                            <td>{{ $bus->Capacity }}</td>
                            <td>{{ $bus->Zone }}</td>
                            <td>{{ $bus->departureDate ? $bus->departureDate->departure_date->format('Y-m-d') : 'N/A' }}</td>
                            <td>
                                <!-- Edit Button -->
                                <a href="{{ route('admin.external_bus.edit', ['bus' => $bus->ExternalBusID]) }}" class="btn btn-warning btn-sm">Edit</a>

                                <!-- Delete Form -->
                                <form action="{{ route('admin.external_bus.destroy', ['bus' => $bus->ExternalBusID]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this bus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

        </div>
    </div>
</x-app-layout>
