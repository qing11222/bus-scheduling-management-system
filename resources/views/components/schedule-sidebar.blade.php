<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.schedule.view') ? 'active' : '' }}" href="{{ route('admin.schedule.view') }}">Schedule</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.schedule.add') ? 'active' : '' }}" href="{{ route('admin.schedule.add') }}">Add Schedule</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.schedule.beforedelete') ? 'active' : '' }}" href="{{ route('admin.schedule.beforedelete') }}">Delete Schedule</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.route.view') ? 'active' : '' }}" href="{{ route('admin.route.view') }}">Available Routes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.stop.view') ? 'active' : '' }}" href="{{ route('admin.stop.view') }}">Available Stops</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.link.create') ? 'active' : '' }}" href="{{ route('admin.link.create') }}">Assign Schedule</a>
    </li>
    
    <li class="nav-item">
        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Log Out') }}
        </a>
        <!-- Logout Form -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf <!-- Laravel CSRF protection token -->
        </form>
    </li>
</ul>
