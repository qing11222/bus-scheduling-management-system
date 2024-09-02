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
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

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
            top: -10px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .print-only {
            display: none;
        }

        @media print {
            body * {
                visibility: hidden;
                margin: 0;
                padding: 0;

            }

            #scheduleTable,
            #scheduleTable *,
            .print-header,
            .print-date,
            .print-logo {
                visibility: visible;
            }

            #scheduleTable {
                position: absolute;
                left: 0;
                top: 120px;
                width: 100%;
            }

            .container-xxl {
                width: 100%;
                max-width: none;
                padding: 0;
            }

            h1,
            h6,
            .btn {
                display: none;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
                font-family: Arial, sans-serif;
            }

            th,
            td {
                border: 1px solid #ddd;
                padding: 12px;
                text-align: left;
            }

            th {
                background-color: #f8f9fa;
                font-weight: bold;
                color: #0d6efd;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            .print-header {
                text-align: center;
                margin-bottom: 10px;
                font-size: 24px;
                color: #0d6efd;
                position: absolute;
                top: 20px;
                left: 0;
                right: 0;
            }

            .print-date {
                text-align: right;
                font-style: italic;
                color: #6c757d;
                margin-bottom: 10px;
                position: absolute;
                top: 60px;
                right: 20px;
            }

            .print-logo {
                position: absolute;
                top: 20px;
                left: 20px;
                width: 100px;
                /* Adjust as needed */
                height: auto;
            }

            .print-only {
                display: block;
                visibility: visible;
            }

            @page {
                size: A4 landscape;
                margin: 2cm;
            }
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
                    <h1 class="display-3 text-white animated slideInDown">Bus Schedule</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Bus Schedule</li>
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
                <h6 class="section-title bg-white text-center text-primary px-3">Bus Schedule</h6>
                <h1 class="mb-5">Find Your Bus Schedule</h1>
            </div>
            <div class="text-center pb-4">
                <a href="{{ route('user.schedule.view', ['week' => 'current']) }}" class="btn btn-primary">This Week</a>
                <a href="{{ route('user.schedule.view', ['week' => 'next']) }}" class="btn btn-secondary">Next Week</a>
                <a href="{{ route('user.schedule.view', ['week' => 'last']) }}" class="btn btn-info">Last Week</a>
            </div>
            <div class="row g-5 align-items-center">
                <div class="col-md-12">
                    <button class="btn btn-primary mb-4" onclick="printSchedule()">Print Schedule</button>

                    <!-- Print-only elements -->
                    <div class="print-only">
                        <img src="{{ asset('images/utemlogo.png') }}" alt="Company Logo" class="print-logo">
                        <div class="print-header">Bus Schedule</div>
                        <div class="print-date">Printed on:
                            <script>
                                document.write(new Date().toLocaleDateString())
                            </script>
                        </div>
                    </div>

                    <table class="table table-bordered table-hover" id="scheduleTable">
                        <thead>
                            <tr>
                                <th>Bus Number Plate</th>
                                <th>Date</th>
                                <th>Departure</th>
                                <th>From</th>
                                <th>To</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->bus->NumberPlate }}</td>
                                    <td>{{ $schedule->date }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->Time)->format('h:i A') }}</td>
                                    <td>{{ $schedule->routes->Origin }}</td>
                                    <td>{{ $schedule->routes->Destination }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Bus Schedule End -->

    <!-- Footer Start -->
    <div class="no-print">
        @include('user.footer')
    </div>
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
    <script>
        function printSchedule() {
            // Remove the footer
            const footer = document.querySelector('.no-print');
            const parent = footer.parentNode;
            parent.removeChild(footer);

            // Print the schedule
            window.print();

            // Restore the footer after printing
            parent.appendChild(footer);
        }
    </script>

</body>

</html>
