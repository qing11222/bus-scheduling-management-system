<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bus Schedule - Travel Agency</title>
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
</head>

<body>

    <!-- Topbar Start -->
    @include('user.topbar')
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    @include('driver.navbar')
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Bus Schedule</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">GPS Tracking</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Bus Schedule Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Bus Tracking</h6>
                <h1 class="mb-5">Driver Tracking </h1>
            </div>
            <div class="row g-5 align-items-center">
                <div class="col-md-12">
                    @include('driver.gps')

                </div>
            </div>
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

</body>

</html>
