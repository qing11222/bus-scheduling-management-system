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
                    <li class="breadcrumb-item active" aria-current="page">Add External Bus</li>
                </ol>
            </nav>
            <br>

            <h1 class="table-title">Edit External Bus</h1>

            <form action="{{ route('admin.external_bus.store') }}" method="POST">
                @csrf

                <table class="google-form-table">
                    <tbody>
                        <tr>
                            <td> <label for="number_plate">Number Plate</label></td>
                            <td><input type="text" id="number_plate" name="number_plate" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td><label for="capacity">Capacity</label></td>
                            <td>   <input type="number" id="capacity" name="capacity" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td><label for="Zone">Zone</label></td>
                            <td><select name="zone" id="zone" class="form-select" required>
                                <option value="" disabled selected>Select Zone</option>
                                <option value="Pantai Timur">Pantai Timur</option>
                                <option value="Utara">Utara</option>
                                <option value="Tengah">Tengah</option>
                                <option value="Selatan">Selatan</option>
                            </select></td>
                        </tr>

                    </tbody>
                </table>

                <button type="submit" class="btn btn-primary">Add External Bus</button>
            </form>
        </div>
    </div>
</x-app-layout>
