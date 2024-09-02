<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tourist - Travel Agency HTML Template</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <style>
        .custom-bg-light {
            background-color: #ffffff; /* Customize your background color here */
        }
        #calendar {
            width: 80%;
            margin: 40px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .fc-unthemed .fc-today {
            background-color: #ffffff; /* Highlight today's date in the calendar */
        }

        .fc-widget-content td, /* Content cell borders */
        .fc-widget-header,
        .fc-day, /* Border around each day cell */
        .fc-day-top, /* Top border of each day cell */
        .fc-day-grid-event, /* Border around each event */
        .fc-time-grid-event, /* Border around each time grid event */
        .fc-time-grid .fc-slats td, /* Border around each time grid slot */
        .fc-row, /* Border around each row */
        .fc-row th, /* Border around each row header */
        .fc-content-skeleton, /* Border around month view cells */
        .fc-day-grid-container, /* Border around day grid */
        .fc-head th, /* Border around the header cells */
        .fc-body td, /* Border around the body cells */
        .fc-day-header { /* Border around the day headers */
            border-color: #000000 !important; /* Change border color to black */
        }
        .fc-day-header {
            border: 1px solid #000000; /* Explicitly set border for day headers */
        }
    </style>
</head>

<body>


     <!-- Topbar Start -->
     @include('user.topbar')



    <!-- Navbar & Hero Start -->
    @include('driver.navbar')
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Checkin</h1>


                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Driver Checkin</h6>
                <h1 class="mb-5">Calender </h1>
                
            </div>
            <div class="row g-5 align-items-center">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>



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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#calendar').fullCalendar({
                events: '{{ route('driver.events') }}',
                selectable: true,
                selectHelper: true,
                editable: true,
                select: function(start, end) {
                    var now = moment().format('YYYY-MM-DD HH:mm:ss');
                    var confirmCheckin = confirm('Are you sure you want to check in at ' + now + '?');
                    if (confirmCheckin) {
                        $.ajax({
                            url: '{{ route('driver.checkin.store') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                checkin_time: now
                            },
                            success: function(response) {
                                $('#calendar').fullCalendar('refetchEvents');
                                alert(response.success);
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                                alert('An error occurred while checking in. Please try again later.');
                            }
                        });
                    }
                }
            });
        });
    </script>


</body>

</html>

