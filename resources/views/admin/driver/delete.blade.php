<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}"> <!-- Include your CSS file -->
    <!-- Main Layout with Sidebar -->
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
                    <li class="breadcrumb-item active" aria-current="page">Delete</li>
                  </ol>
              </nav>
            <h1 class="table-title">Drivers</h1>
        <table class="google-form-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>License Number</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($drivers as $driver)
                <tr>
                    <td>{{ $driver->name }}</td>
                    <td>{{ $driver->license_number }}</td>
                    <td>{{ $driver->phone }}</td>
                    <td>
                        <form action="{{ route('admin.driver.delete', ['id' => $driver->DriverID]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this driver?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-2">Delete Driver</button>
                        </form>
                      </td>
                </tr>
            @endforeach
        </tbody>
        </table>

        </div>
    </div>
 </div>
    </x-app-layout>
