<x-app-layout>
    <!-- Main Layout with Sidebar -->
    <div class="flex">

        <!-- Sidebar -->
        <div class="sidebar">
            <x-schedule-sidebar />
        </div>


        <!-- Main Content -->
        <div class="container">
            <!-- Breadcrumb -->
            @include('partials.flash_messages')
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Schedules</li>
                </ol>
              </nav>
            <h1 class="table-title">Schedule Content</h1>
        <table class="google-form-table">
            <thead>
                <tr>
                    <th>Bus Plate Number</th>
                    <th>Date</th>
                    <th>Semester</th>
                    <th>Time</th>
                    <th>Route</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->bus->NumberPlate }}</td>
                    <td>{{ $schedule->date }}</td>
                    <td>{{ $schedule->semester->Name }} ({{ \Carbon\Carbon::parse($schedule->semester->date)->year }})</td>
                    <td>{{ $schedule->Time }}</td>
                    <td>{{ $schedule->routes->Origin }} - {{ $schedule->routes->Destination }}</td>
                    <td>
                        <a href="{{ route('admin.schedule.edit', $schedule->ScheduleID) }}" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    </x-app-layout>
