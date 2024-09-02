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
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Schedule</li>
                </ol>
            </nav>
            <h1 class="table-title">Driver Content</h1>
            <form action="{{ route('admin.schedule.update', $schedule->ScheduleID) }}" method="POST">
                @csrf
                @method('PUT')
                <table class="google-form-table">
                    <tbody>
                        <tr>
                            <td><label for="SemesterID">Semester</label></td>
                            <td>
                                <select name="SemesterID" id="SemesterID" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach($semesters as $semester)
                                        <option value="{{ $semester->SemesterID }}"
                                                data-start="{{ $semester->Start_Date }}"
                                                data-end="{{ $semester->End_Date }}"
                                                {{ old('SemesterID', $schedule->SemesterID) == $semester->SemesterID ? 'selected' : '' }}>
                                            {{ $semester->Name }} - {{ \Carbon\Carbon::parse($semester->Start_Date)->toDateString() }}- {{ \Carbon\Carbon::parse($semester->End_Date)->toDateString() }}
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
                                <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $schedule->date) }}" required>
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td><label for="Time">Time</label></td>
                            <td>
                                <input type="time" name="Time" class="form-control" value="{{ old('Time', $schedule->Time) }}" required>
                                @error('Time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td><label for="BusID">Bus</label></td>
                            <td>
                                <select name="BusID" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach ($buses as $bus)
                                        <option value="{{ $bus->BusID }}" {{ old('BusID', $schedule->BusID) == $bus->BusID ? 'selected' : '' }}>
                                            {{ $bus->BusID }} - PlateNum: {{ $bus->NumberPlate }}
                                        </option>
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
                                        <option value="{{ $route->RouteID }}" {{ old('RouteID', $schedule->RouteID) == $route->RouteID ? 'selected' : '' }}>
                                            {{ $route->Name }} - {{ $route->Description }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('RouteID')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Update Schedule</button>
            </form>
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
                    // Reset the date input attributes if no semester is selected
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
