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
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.driver.view')}}">Drivers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
            <div class="form-custom">
                @include('partials.flash_messages')

                <form action="{{ route('admin.bus.update', ['id' => $bus->BusID]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <table class="google-form-table">
                        <tbody>
                            <tr>
                                <td><label for="NumberPlate">Number Plate</label></td>
                                <td><input type="text" name="NumberPlate" id="NumberPlate" class="form-control" value="{{ $bus->NumberPlate }}" required></td>
                            </tr>
                            <tr>
                                <td><label for="Capacity">Capacity</label></td>
                                <td><input type="number" name="Capacity" id="Capacity" class="form-control" value="{{ $bus->Capacity }}" required></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center" style="text-align: center;">
                            <button type="submit" class="btn btn-primary">Update Bus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
