<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="" class="navbar-brand p-0">
            <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>UTeM Bus Scheduling</h1>
            <!-- <img src="img/logo.png" alt="Logo"> -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('user.mainpage') }}" class="nav-item nav-link {{ request()->routeIs('user.mainpage') ? 'active' : '' }}">Home</a>
                <a href="{{ route('user.about') }}" class="nav-item nav-link {{ request()->routeIs('user.about') ? 'active' : '' }}">About</a>
                <a href="{{route('user.service')}}" class="nav-item nav-link {{ request()->routeIs('user.service') ? 'active' : '' }}">Services</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('user.schedule.view') }}" class="dropdown-item {{ request()->routeIs('user.schedule.view') ? 'active' : '' }}">Schedule</a>
                        <a href="{{ route('user.stop.view') }}" class="dropdown-item {{ request()->routeIs('user.stop.view') ? 'active' : '' }}">Stops</a>
                        <a href="{{route('user.tracking')}}" class="dropdown-item {{ request()->routeIs('user.tracking') ? 'active' : '' }}">Bus Tracking</a>
                        <a href="{{route('user.booking.index')}}" class="dropdown-item {{ request()->routeIs('user.booking.index') ? 'active' : '' }}">Booking</a>
                        <a href="{{route('user.ticket.show')}}" class="dropdown-item {{ request()->routeIs('user.ticket.show') ? 'active' : '' }}">Ticket</a>
                    </div>
                </div>
            </div>

            @include('user.profile')
            <!-- Notification Bell -->
            <div class="notification-icon" style="position: relative; margin-left: 25px;">
                <i class="fas fa-bell" style="font-size: 24px; cursor: pointer;" id="bell-icon"></i>
                <span id="notification-count" class="notification-count">0</span>

                <!-- Notification Dropdown -->
                <div id="notification-dropdown" style="display: none; position: absolute; right: 0; top: 100%; width: 300px; background: #fff; border: 1px solid #ddd; box-shadow: 0 4px 8px rgba(0,0,0,0.1); z-index: 1000;">
                    <div style="padding: 10px; border-bottom: 1px solid #ddd;">
                        <strong>Notifications</strong>
                    </div>
                    <div style="max-height: 300px; overflow-y: auto;">
                        @forelse ($announcements as $announcement)
                            <div style="position: relative; padding: 10px; border-bottom: 1px solid #ddd;">
                                <button type="button" style="position: absolute; top: 10px; right: 10px; font-size: 18px; background: transparent; border: none; cursor: pointer; color: #000;" onclick="this.parentElement.style.display='none';">&times;</button>
                                <strong>{{ $announcement->Title }}</strong>
                                <p class="mb-0">Reason: {{ $announcement->Description }}</p>
                                <p class="mb-0">Bus Plate {{ $announcement->NumberPlate }}</p>
                                <small class="text-muted">{{ $announcement->DatePosted }}</small>
                            </div>
                        @empty
                            <div style="padding: 10px; border-bottom: 1px solid #ddd;">No announcements available.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var bellIcon = document.getElementById('bell-icon');
        var notificationDropdown = document.getElementById('notification-dropdown');
        var notificationCount = document.getElementById('notification-count');

        // Example function to update notification count
        function updateNotificationCount(count) {
            if (count > 0) {
                notificationCount.textContent = count;
                notificationCount.style.display = 'flex'; // Show badge
            } else {
                notificationCount.style.display = 'none'; // Hide badge if no notifications
            }
        }

        // Toggle the dropdown when the bell icon is clicked
        bellIcon.addEventListener('click', function() {
            if (notificationDropdown.style.display === 'none' || notificationDropdown.style.display === '') {
                notificationDropdown.style.display = 'block';
            } else {
                notificationDropdown.style.display = 'none';
            }
        });

        // Close the dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!bellIcon.contains(event.target) && !notificationDropdown.contains(event.target)) {
                notificationDropdown.style.display = 'none';
            }
        });

        // Example of setting notification count
        var unreadCount = {{ $announcements->count() }}; // Pass this from the server-side
        updateNotificationCount(unreadCount);
    });
</script>
