<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.driver.view') ? 'active' : '' }}" href="{{ route('admin.driver.view') }}">Driver</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.driver.add') ? 'active' : '' }}" href="{{ route('admin.driver.add') }}">Add Driver</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.driver.report') ? 'active' : '' }}" href="{{ route('admin.driver.report') }}">Driver Reports</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.driver.help') ? 'active' : '' }}" href="{{ route('admin.driver.help') }}">Help</a>
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
