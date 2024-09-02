<x-app-layout>
    <!-- Main Layout with Sidebar -->
    <div class="flex">

        <!-- Sidebar -->
        <div class="sidebar">
            <x-driver-sidebar />
        </div>



        <!-- Main Content -->
        <div class="container">
            @include('partials.flash_messages')
            <!-- Breadcrumb -->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.driver.view') }}">Drivers</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Buses</li>
                </ol>
              </nav>
              <br>
              <div>
                <a href="{{ route('admin.bus.add',['id' => $drivers->DriverID]) }}" class="btn btn-primary mr-2">Add a New Bus</a>
                <a href="{{ route('admin.bus.select', ['id' => $drivers->DriverID]) }}" class="btn btn-primary">Update Bus</a>
            </div>
            <h1 class="table-title">Bus Content</h1>

        <table class="google-form-table">
            <thead>
                <tr>
                    <th>BusID</th>
                    <th>NumberPlate</th>
                    <th>Capacity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buses as $bus)
                <tr>
                    <td>{{ $bus->BusID }}</td>
                    <td>{{ $bus->NumberPlate }}</td>
                    <td>{{ $bus->Capacity }}</td>
                    <td>
                        <a href="{{ route('admin.bus.edit', ['id' => $bus->BusID]) }}" class="btn btn-warning btn-sm mr-1">Edit<i class="fas fa-edit"></i></a>
                     
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        </div>
    </div>
    </x-app-layout>
