<!-- Sidebar -->
<div class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.user.view') ? 'active' : '' }}" href="{{ route('admin.user.view') }}">User</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin.user.viewdelete') ? 'active' : '' }}" href="{{ route('admin.user.viewdelete') }}">Delete User</a>
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
</div>
