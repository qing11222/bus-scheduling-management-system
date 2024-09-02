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
                <h1>Add Driver</h1>
                @include('partials.flash_messages')

                <form action="{{ route('admin.driver.add') }}" method="POST">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <td><label for="name">Name</label></td>
                            <td><input type="text" class="form-control" id="name" name="name" placeholder="Name" {{ old('name') }}" required></td>
                        </tr>
                        <tr>
                            <td><label for="license_number">License Number</label></td>
                            <td><input type="text" class="form-control" id="license_number" name="license_number" placeholder="License Number"{{ old('license_number') }}" required></td>
                        </tr>
                        <tr>
                            <td><label for="phone">Phone</label></td>
                            <td><input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" {{ old('phone') }}" required></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td><input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required></td>
                        </tr>
                        <tr>
                            <td><label for="password">Password</label></td>
                            <td><input type="password" class="form-control" id="password" name="password"  required></td>
                        </tr>
                        <tr>
                            <td><label for="password_confirmation">Confirm Password</label></td>
                            <td><input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required></td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-primary">Add Driver</button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
