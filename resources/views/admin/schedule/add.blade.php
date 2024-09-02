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
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.schedule.view') }}">Schedules</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Schedules</li>
                </ol>
            </nav>
            <div class="form-custom">
                <h1>Add Schedule</h1>
                @include('partials.flash_messages')

                <form action="{{ route('admin.schedule.store') }}" method="POST">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <td><label for="SemesterID">Semester</label></td>
                            <td>
                                <select name="SemesterID" id="SemesterID" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach($semesters as $semester)
                                        <option value="{{ $semester->SemesterID }}"
                                                data-start="{{ $semester->Start_Date }}"
                                                data-end="{{ $semester->End_Date }}">
                                            {{ $semester->Name }} - {{ \Carbon\Carbon::parse($semester->Start_Date)->toDateString() }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('SemesterID')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td><label for="date">Date</label></td>
                            <td>
                                <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td><label for="Time">Time</label></td>
                            <td><input type="time" name="Time" class="form-control" value="{{ old('Time') }}" required></td>
                        </tr>
                        <tr>
                            <td><label for="BusID">Bus</label></td>
                            <td>
                                <select name="BusID" class="form-control" required>
                                    @foreach ($buses as $bus)
                                        <option value="{{ $bus->BusID }}">{{ $bus->BusID }} - PlateNum: {{ $bus->NumberPlate }}</option>
                                    @endforeach
                                </select>
                                @error('BusID')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>

                        <tr>
                            <td><label for="RouteID">Route</label></td>
                            <td>
                                <select name="RouteID" id="RouteID" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach($routes as $route)
                                        <option value="{{ $route->RouteID }}">{{ $route->Name }} - {{ $route->Description }}</option>
                                    @endforeach
                                </select>
                                @error('RouteID')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-primary">Add Schedule</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dateInput = document.getElementById('date');
            var semesterSelect = document.getElementById('SemesterID');

            function updateDateRange() {
                var selectedOption = semesterSelect.options[semesterSelect.selectedIndex];
                var startDate = selectedOption.getAttribute('data-start');
                var endDate = selectedOption.getAttribute('data-end');

                if (startDate && endDate) {
                    dateInput.setAttribute('min', startDate);
                    dateInput.setAttribute('max', endDate);
                } else {
                    dateInput.removeAttribute('min');
                    dateInput.removeAttribute('max');
                }
            }

            // Add event listener to update date range on semester change
            semesterSelect.addEventListener('change', updateDateRange);

            // Set initial date range based on pre-selected semester
            updateDateRange();
        });
    </script>
</x-app-layout>
