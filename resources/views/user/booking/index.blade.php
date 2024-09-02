<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bus Schedule</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <!-- Animate CSS -->
    <link href="{{ asset('templete/lib/animate/animate.min.css') }}" rel="stylesheet">
    <!-- Owl Carousel CSS -->
    <link href="{{ asset('templete/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <!-- Tempus Dominus CSS -->
    <link href="{{ asset('templete/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('templete/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="{{ asset('templete/css/style.css') }}">
    <style>
        .notification-count {
            position: absolute;
            top: -10px; /* Adjust according to your layout */
            right: -10px; /* Adjust according to your layout */
            background-color: red; /* Badge background color */
            color: white; /* Text color */
            border-radius: 50%;
            width: 20px; /* Badge width */
            height: 20px; /* Badge height */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px; /* Font size */
            font-weight: bold;
        }
        .zone-info ul {
            list-style-type: disc;
            padding-left: 20px;
        }
    </style>
</head>

<body>

    <!-- Topbar Start -->
    @include('user.topbar')
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    @include('user.navbar')
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Bus Booking</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Booking</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Zone Explanation Start -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="mb-4">Bus Zones Explained</h3>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Zon Pantai Timur</h5>
                                <ul>
                                    <li>Pahang</li>
                                    <li>Kelantan</li>
                                </ul>
                                <p class="card-text">Covers the eastern coastal region with routes connecting major cities and towns along the east coast.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Zon Utara</h5>
                                <ul>
                                    <li>Perlis</li>
                                    <li>Kedah</li>
                                    <li>Penang</li>
                                </ul>
                                <p class="card-text">Includes the northern regions with routes connecting to key destinations in the north.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Zon Tengah</h5>
                                <ul>
                                    <li>Perak</li>
                                    <li>Selangor</li>
                                    <li>Kuala Lumpur</li>
                                </ul>
                                <p class="card-text">Serves the central region with routes covering major cities and towns in the middle of the country.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Zon Selatan</h5>
                                <ul>
                                    <li>Johor</li>
                                    <li>Malacca</li>
                                    <li>Negeri Sembilan</li>
                                </ul>
                                <p class="card-text">Encompasses the southern regions with routes connecting key destinations in the south.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Zone Explanation End -->

    <!-- Bus Schedule Start -->
    <div class="container py-5">
        <div class="row">
            @foreach($buses as $bus)
            <!-- Dummy Data for Buses -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="{{ asset('images/bus1.jpg') }}" class="card-img-top" alt="Bus 1">
                    <div class="card-body">
                        <h5 class="card-title">Bus: {{ $bus->NumberPlate }}</h5>
                        <p class="card-text">Capacity: {{ $bus->Capacity }} seats</p>
                        <p class="card-text">Zone: {{ $bus->Zone }}</p>
                        <p>Departure Date: {{ $bus->departure_date}}</p>
                        <a href="{{ route('user.booking.seats', ['busId' => $bus->ExternalBusID]) }}" class="btn btn-primary">View All Seats</a>

                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    <!-- Bus Schedule End -->

    <!-- Footer Start -->
    @include('user.footer')
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('templete/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('templete/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('templete/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('templete/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('templete/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('templete/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('templete/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('templete/js/main.js') }}"></script>
</body>

</html>
