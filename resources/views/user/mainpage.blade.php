<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bus Scheduling - UTeM</title>
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
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">

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

    </style>
</head>

<body>
    @include('components.loading')

     <!-- Topbar Start -->
     @include('user.topbar')



    <!-- Navbar & Hero Start -->
    @include('user.navbar')
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Welcome to Our Bus Scheduling System</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">   Our advanced bus scheduling system ensures that you have the most reliable and convenient transportation options available. Whether you're commuting to work, school, or traveling across the city, our system provides real-time updates, route information, and easy booking options.</p>
                    <div class="position-relative w-75 mx-auto animated slideInDown">
                        <form action="{{ route('user.find.bus') }}" method="GET">
                            <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="text" name="destination" placeholder="Enter Destination" required>
                            <button type="submit" class="btn btn-primary rounded-pill py-2 px-4 position-absolute top-0 end-0 me-2" style="margin-top: 7px;">Find Bus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->


    <!-- About Start -->
    @include('user.about')
    <!-- About End -->


    <!-- Service Start -->
    @include('user.service')
    <!-- Service End -->


     <!-- Footer Start -->
    @include('user.footer')



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
    <script src="{{ asset('js/loading.js') }}"></script>
    <script>
        // Show loading spinner when navigating to the main page
        document.addEventListener('DOMContentLoaded', function() {
            showLoading(); // Show spinner
            setTimeout(function() {
                hideLoading(); // Hide spinner after a few seconds
            }, 3000); // Adjust the time as needed (3000 ms = 3 seconds)
        });
    </script>



</body>

</html>

