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
                    <li class="breadcrumb-item"><a href="{{route('admin.driver.view')}}">Drivers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Report</li>
                  </ol>
              </nav>
              <h1 class="table-title">Driver Report</h1>
              <table class="google-form-table">
                  <thead>
                      <tr>
                          <th>Driver Name</th>
                          <th>Driver Email</th>
                          <th>Driver Phone</th>
                          <th>Driver Check-In</th>
                          <th>Driver Check-Out</th>
                          <th>Duration</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($drivers as $driver)
                    <tr>
                        <td>{{ $driver->name }}</td>
                        <td>{{ $driver->email }}</td>
                        <td>{{ $driver->phone }}</td>
                        <td>{{ $driver->checkin_time }}</td>
                        <td>{{ $driver->checkout_time }}</td>
                        <td data-checkin="{{ $driver->checkin_time }}" data-checkout="{{ $driver->checkout_time }}" class="duration"></td> <!-- Duration Column -->
                    </tr>
                    @endforeach
                  </tbody>
              </table>
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const durations = document.querySelectorAll('.duration');

                    durations.forEach(function(durationCell) {
                        const checkinTime = new Date(durationCell.dataset.checkin);
                        const checkoutTime = new Date(durationCell.dataset.checkout);

                        const duration = new Date(checkoutTime - checkinTime);
                        const hours = duration.getUTCHours();
                        const minutes = duration.getUTCMinutes();

                        durationCell.textContent = `${hours} hours ${minutes} minutes`;
                    });
                });
            </script>
          </div>

    </div>
</div>
    </x-app-layout>
