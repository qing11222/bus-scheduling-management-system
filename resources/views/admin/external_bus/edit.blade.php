<x-app-layout>
    <!-- Main Layout with Sidebar -->
    <div class="flex">

        <div class="container">
            @include('partials.flash_messages')

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.external_bus.view') }}">External Buses</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Bus</li>
                </ol>
            </nav>
            <br>

            <h1 class="table-title">Edit External Bus</h1>

            <form action="{{ route('admin.external_bus.update', ['bus' => $bus->ExternalBusID]) }}" method="POST">
                @csrf
                @method('PUT')

                <table class="google-form-table">
                    <tbody>
                        <tr>
                            <td><label for="NumberPlate">Number Plate</label></td>
                            <td><input type="text" name="NumberPlate" id="NumberPlate" class="form-control" value="{{ old('NumberPlate', $bus->NumberPlate) }}" required></td>
                        </tr>
                        <tr>
                            <td><label for="Capacity">Capacity</label></td>
                            <td><input type="number" name="Capacity" id="Capacity" class="form-control" value="{{ old('Capacity', $bus->Capacity) }}" required></td>
                        </tr>
                        <tr>
                            <td><label for="Zone">Zone</label></td>
                            <td><input type="text" name="Zone" id="Zone" class="form-control" value="{{ old('Zone', $bus->Zone) }}" required></td>
                        </tr>
                        <tr>
                            <td><label for="DepartureDate">Departure Date</label></td>
                            <td>
                                <input type="date" name="DepartureDate" id="DepartureDate" class="form-control" value="{{ old('DepartureDate', $bus->departureDate ? $bus->departureDate->departure_date->format('Y-m-d') : '') }}" required>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.external_bus.view') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
