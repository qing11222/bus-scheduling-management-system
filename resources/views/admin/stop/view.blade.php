<x-app-layout>
    <!-- Main Layout with Sidebar -->
    <div class="flex">

        <!-- Sidebar -->
        <div class="sidebar">
            <x-schedule-sidebar />
        </div>



        <!-- Main Content -->
        <div class="container">
            @include('partials.flash_messages')
            <!-- Breadcrumb -->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Schedules</li>
                </ol>
              </nav>
              <br>
            <h1 class="table-title">Schedule Content</h1>
            <a href="{{ route('admin.stop.add') }}" class="btn btn-primary mb-3">Add Stop</a>
        <table class="google-form-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stops as $stop)
                <tr>
                    <td>{{ $stop->Name }}</td>
                    <td>{{ $stop->Location }}</td>
                    <td>{{ $stop->Latitude }}</td>
                    <td>{{ $stop->Longitude }}</td>
                    <td>
                        @if ($stop->picture)
                        <img src="{{ $stop->picture }}" alt="Stop Image" style="width: 100px; height: auto;">
                    @else
                        No image
                    @endif</td>


                    </td>
                    <td>
                        <form action="{{ route('admin.stop.delete', ['id' => $stop->StopID]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this stop?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>
        </div>
    </div>
    </x-app-layout>
