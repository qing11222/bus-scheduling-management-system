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
     <!-- Chart.js -->
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <h1 class="display-3 text-white mb-3 animated slideInDown">My Attendance</h1>

                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">My Attendance</h6>
                <h1 class="mb-5">Table </h1>

            </div>
            <div class="row g-5 align-items-center">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Driver Name</th>
                            <th>Checkin</th>
                            <th>Checkout</th>
                            <th>Total Work Time</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($checkins as $checkin)
                        <tr>
                            <td>{{ $checkin->user_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($checkin->checkin_time)->format('M j, Y g:i A') }}</td>
                            <td>{{ $checkin->checkout_time? \Carbon\Carbon::parse($checkin->checkout_time)->format('M j, Y g:i A') : 'N/A' }}</td>
                            <td>
                                @if($checkin->checkout_time)
                                {{ \Carbon\Carbon::parse($checkin->checkout_time)->diff(\Carbon\Carbon::parse($checkin->checkin_time))->format('%h hours %i minutes') }}
                            @else
                                N/A
                            @endif
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="row g-5 align-items-center mt-5">
                    <div class="col-12">
                        <h2 class="text-center mb-4">Work Time Chart</h2>
                        <canvas id="attendanceChart"></canvas>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>




    <!-- Service Start -->

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
    @php
    $workTimesFormatted = $checkins->map(function($checkin) {
    if ($checkin->checkout_time) {
        $checkinTime = new DateTime($checkin->checkin_time);
        $checkoutTime = new DateTime($checkin->checkout_time);

        // Calculate the difference in minutes
        $interval = $checkoutTime->diff($checkinTime);
        $diffInMinutes = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;

        // Calculate hours and minutes
        $hours = intdiv($diffInMinutes, 60); // Calculate hours
        $minutes = $diffInMinutes % 60;      // Calculate remaining minutes

        // Return formatted string
        return "$hours hours $minutes minutes";
    }
    return "N/A"; // Return "N/A" if no checkout
});
@endphp


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('attendanceChart').getContext('2d');

        // Pass formatted PHP data to JavaScript
        var labels = @json($checkins->pluck('checkin_time')->map(function($time) {
            return (new DateTime($time))->format('M j, Y');
        }));
        var data = @json($workTimesFormatted); // Use formatted data

        var attendanceChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Work Time',
                    data: data.map(item => {
                        // Extract hours and minutes from the formatted string for numeric values
                        const parts = item.split(' ');
                        return parseFloat(parts[0]) + (parseFloat(parts[2]) / 60); // Convert to hours
                    }),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            autoSkip: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>



</body>

</html>

