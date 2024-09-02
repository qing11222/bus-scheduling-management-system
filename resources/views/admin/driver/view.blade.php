<x-app-layout>
    <!-- Main Layout with Sidebar -->
    <div class="flex">

        <!-- Sidebar -->
        <div class="sidebar">
            <x-driver-sidebar />
        </div>


        <!-- Main Content -->
        <div class="container">
            <!-- Breadcrumb -->
            @include('partials.flash_messages')
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Drivers</li>
                </ol>
              </nav>
            <h1 class="table-title">Driver Content</h1>
        <table class="google-form-table">
            <thead>
                <tr>
                    <th>Driver Name</th>
                    <th>Details</th>
                    <th>View Buses</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($drivers as $driver)
                <tr>
                    <td>{{ $driver->name }}</td>
                    <td>
                        <a href="{{route('admin.driver.detail', ['id' => $driver->DriverID])}}" class="btn btn-primary btn-sm mr-1">View<i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.driver.edit', ['id' => $driver->DriverID]) }}" class="btn btn-warning btn-sm mr-1">Edit<i class="fas fa-edit"></i></a>
                        <th>
                            <a href="{{ route('admin.bus.view', ['id' => $driver->DriverID]) }}" class="btn btn-primary btn-sm">
                                View Buses
                            </button>
                        </th>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        </div>
    </div>
    </x-app-layout>
