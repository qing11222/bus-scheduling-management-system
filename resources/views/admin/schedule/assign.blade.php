<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"> <!-- Include your CSS file -->
    <div class="flex">

        <!-- Sidebar -->
        <div class="sidebar">
            <x-schedule-sidebar />
        </div>

        <!-- Main Content -->
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.schedule.view')}}">Schedules</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Assign Schedules</li>
                </ol>
            </nav>
            <div class="form-custom">
                <h1>Assign Schedule</h1>
                @include('partials.flash_messages')

                <form action="{{ route('admin.link.store') }}" method="POST">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <td><label for="ScheduleID">Select Schedule:</label></td>
                            <td>
                                <select name="ScheduleID" id="ScheduleID" class="form-control">
                                    @foreach($schedules as $schedule)
                                    @php
                                        $route = $schedule->routes; // Assuming 'route' is the method or relationship to fetch route details
                                    @endphp
                                    <option value="{{ $schedule->ScheduleID }}">
                                        {{ $schedule->Time }} at {{ $schedule->date }} ( Route Name:
                                        {{ $route ? $route->Origin : 'N/A' }} to {{ $route ? $route->Destination : 'N/A' }})
                                    </option>
                                @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="StopID">Select Stop:</label></td>
                            <td>
                                <select name="StopID" id="StopID" class="control">
                                    @foreach($stops as $stop)
                                        <option value="{{ $stop->StopID }}">{{ $stop->Name }} - {{ $stop->Location }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                    </table>
                    <button type="submit" class="btn btn-primary">Assign Schedule</button>
                </form>
            </div>
            <table class="google-form-table">
                <thead>
                    <tr>
                        <th>Schedule Time</th>
                        <th>Schedule Date</th>
                        <th>Route Origin</th>
                        <th>Route Destination</th>
                        <th>Stop</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($linkedStops as $linkedStop)
                    @if($linkedStop->schedule !== null)
                        @foreach($linkedStop->schedule as $schedule)
                        @php
                            $route = $schedule->routes; // Assuming 'routes' is the method or relationship to fetch route details
                        @endphp
                            <tr>
                                <td>{{ $schedule->Time }}</td>
                                <td>{{ $schedule->date }}</td>
                                <td>{{ $route ? $route->Origin : 'N/A' }}</td>
                                <td>{{ $route ? $route->Destination : 'N/A' }}</td>
                                <td>{{ $linkedStop->Name }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.link.destroy', [$linkedStop->StopID, $schedule->pivot->ScheduleID]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="2">No schedules found for stop {{ $linkedStop->StopID }}.</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
