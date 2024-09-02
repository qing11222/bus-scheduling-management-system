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
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Drivers</li>
                </ol>
              </nav>
            <h1 class="table-title">Driver Content</h1>
            <form action="{{ route('admin.driver.update', ['id' => $driver->DriverID]) }}" method="POST">
                @csrf
                @method('PUT')
            <table class="google-form-table">
            <tbody>
                <tr>
                    <td><label for="name">Name</label></td>
                    <td><input type="text" name="name" id="name" class="form-control" value="{{ $driver->name }}" required></td>
                </tr>
                <tr>
                    <td><label for="license_number">License Number</label></td>
                    <td><input type="text" name="license_number" id="license_number" class="form-control" value="{{ $driver->license_number }}" required></td>
                </tr>
                <tr>
                    <td><label for="phone">Phone</label></td>
                    <td><input type="text" name="phone" id="phone" class="form-control" value="{{ $driver->phone }}" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="email" name="email" id="email" class="form-control" value="{{$driver->email}}" ></td>
                <tr>
                    <td colspan="2" class="text-center" style="text-align: center;">
                        <button type="submit" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff; color: #fff; padding: 10px 20px; border-radius: 5px;">
                            Update Driver
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
            </form>
        </div>
    </div>
    </x-app-layout>
