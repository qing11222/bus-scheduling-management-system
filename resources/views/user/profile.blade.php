<div class="ms-3 relative">
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        @auth
            {{ auth()->user()->name }}
        @endauth
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <!-- Dropdown items here -->
            <li><a class="dropdown-item" href="{{ route('user.profile') }}" id="viewProfile">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form id="logoutForm" class="dropdown-item" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link">Log Out</button>
                </form>
            </li>
        </ul>
    </div>
</div>
