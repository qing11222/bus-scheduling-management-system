<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"> <!-- Include your CSS file -->
    <div class="flex">

        <!-- Sidebar -->
        <div class="sidebar">
            <x-driver-sidebar />
        </div>

        <!-- Main Content -->
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.driver.view')}}">Drivers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
            <div class="form-custom">
                <h1>Add Bus for Driver: {{ $driver->name }}</h1>
                @include('partials.flash_messages')

                <form action="{{ route('admin.bus.store',['id' => $driver->DriverID]) }}" method="POST">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <td><label for="NumberPlate">Number Plate</label></td>
                            <td><input type="text" name="NumberPlate" id="NumberPlate" class="form-control" required></td>
                        </tr>
                        <tr>
                           <td> <label for="Capacity" class="form-label">Capacity</label><br></td>
                           <td> <input type="number" name="Capacity" class="control" value="{{ old('capacity') }}" required></td>
                        </tr>

                    </table>
                    <button type="submit" class="btn btn-primary">Add Buses</button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
