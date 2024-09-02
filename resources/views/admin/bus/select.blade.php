<x-app-layout>

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
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.driver.view') }}">Drivers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Bus for Driver: {{ $drivers->name }}</li>
                </ol>
            </nav>

            <div class="form-custom">
                <h1>Select Bus for Driver: {{ $drivers->name }}</h1>
                @include('partials.flash_messages')

                <form action="{{ route('admin.bus.attach', ['id' => $drivers->DriverID]) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="bus">Select Bus:</label>
                        <select class="form-control" id="bus" name="bus">
                            @foreach($buses as $bus)
                                <option value="{{ $bus->BusID }}">{{ $bus->NumberPlate }} - Capacity: {{ $bus->Capacity }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary">Add Bus</button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
