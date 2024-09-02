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
                <a href="{{ route('driver.main') }}" class="nav-item nav-link {{ request()->routeIs('driver.main') ? 'active' : '' }}">Home</a>
                <a href="{{route('driver.checkin')}}" class="nav-item nav-link {{ request()->routeIs('driver.checkin') ? 'active' : '' }}">Checkin</a>
                <a href="{{route('driver.checkout')}}" class="nav-item nav-link {{ request()->routeIs('driver.checkout') ? 'active' : '' }}">Checkout</a>
                <a href="{{ route('driver.tracking') }}" class="nav-item nav-link {{ request()->routeIs('driver.tracking') ? 'active' : '' }}">GPS Tracking</a>
                <a href="{{route('driver.attendance')}}" class="nav-item nav-link {{ request()->routeIs('driver.attendance') ? 'active' : '' }}">My Attendance</a>


            </div>
            @include('driver.check_profile')
        </div>
    </nav>


</div>
