<!DOCTYPE html>
<html lang="en">
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

    <!-- Topbar Start -->
    @include('user.topbar')



    <!-- Navbar & Hero Start -->
    @include('user.navbar')
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Find Bus Result</h1>
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

    <!-- Container for Search Results -->
    <div class="container py-5">
        <h2 class="mb-4">Bus Schedule Results</h2>

        @if($buses->isEmpty())
            <div class="alert alert-info">
                No buses found for the destination "{{ $destination }}".
            </div>
        @else
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Bus Number Plate</th>
                        <th>Destination</th>
                        <th>Schedule Date</th>
                        <th>Departure Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buses as $bus)
                        <tr>
                            <td>{{ $bus->NumberPlate }}</td>
                            <td>{{ $bus->Destination }}</td>
                            <td>{{ $bus->date }}</td>
                            <td>{{ \Carbon\Carbon::parse($bus->Time)->format('h:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Footer -->
    @include('user.footer')  <!-- Make sure to include the correct path to your footer -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
