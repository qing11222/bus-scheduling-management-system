<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bus Seat Booking</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">


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
        .seat {
            width: 60px;
            height: 60px;
            text-align: center;
            line-height: 60px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            margin: 5px;
        }
        .seat:hover {
            transform: scale(1.1);
        }
        .available { background-color: #c8e6c9; }
        .booked { background-color: #ffcdd2; cursor: not-allowed; }
        .selected { background-color: #64b5f6; color: white; }
        .seat-map {
            display: grid;
            gap: 10px;
            justify-content: center;
            margin: 0 auto;
        }
        .seat-label {
            margin-bottom: 20px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004080;
        }
        .legend {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            font-size: 16px;
        }
        .legend div {
            margin-right: 20px;
            display: flex;
            align-items: center;
        }
        .legend .seat {
            width: 40px;
            height: 40px;
            margin: 0 5px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    @include('partials.flash_messages')
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

    <div class="container mt-4">
        <h1 class="mb-4">Bus Seat Booking</h1>
        <form id="bookingForm">
            <div class="form-group">
                <h3>Selected Bus: {{ $bus->NumberPlate }}</h3>
            </div>
            <input type="hidden" id="bus_id" name="bus_id" value="{{ $bus->ExternalBusID }}">
            <div class="form-group">
                <label for="departure_date">Departure Date: {{ $departureDates->formatted_date}}</label>
            </div>
            <input type="hidden" id="departure_date" name="departure_date" value="{{$departureDates->departure_date}}">

            <div id="seat-selection">
                <!-- Seat map will be dynamically loaded here -->
            </div>
            <input type="hidden" id="seat_id" name="seat_id" value="">
            <button type="submit" id="bookNowButton" class="btn btn-primary">Book Now</button>
        </form>
        <div class="legend">
            <div><div class="seat available" style="background-color: #c8e6c9;"></div> Available</div>
            <div><div class="seat selected" style="background-color: #64b5f6;"></div> Selected</div>
            <div><div class="seat booked" style="background-color: #ffcdd2;"></div> Booked</div>
        </div>
    </div>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
    // Pass PHP data to JavaScript
    const seatsData = @json($seats);

    function loadSeats(seats) {
        const seatSelection = document.getElementById('seat-selection');
        seatSelection.innerHTML = '<div class="seat-label">Select your seat:</div><div class="seat-map"></div>';

        const seatMap = document.querySelector('.seat-map');
        seatMap.innerHTML = ''; // Clear existing seats

        // Determine the number of columns for the grid
        const cols = 4; // Number of columns (adjust as needed)
        const rows = Math.ceil(seats.length / cols);

        seatMap.style.gridTemplateColumns = `repeat(${cols}, 60px)`; // Set columns

        seats.forEach((seat) => {
            const seatElement = document.createElement('div');
            seatElement.classList.add('seat');
            seatElement.classList.add(seat.IsBooked ? 'booked' : 'available');
            seatElement.textContent = seat.SeatNumber;
            seatElement.dataset.seatId = seat.SeatID;
            seatElement.addEventListener('click', function() {
                if (!seat.IsBooked) {
                    document.querySelectorAll('.seat').forEach(seat => seat.classList.remove('selected'));
                    seatElement.classList.add('selected');
                    document.getElementById('seat_id').value = seatElement.dataset.seatId;
                }
            });
            seatMap.appendChild(seatElement);
        });
    }
    document.addEventListener('DOMContentLoaded', function() {
    loadSeats(seatsData);

    // SweetAlert confirmation dialog
    Swal.fire({
        title: 'Are you sure?',
        text: "Each student can buy only one ticket. Do you want to proceed?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, proceed!'
    }).then((result) => {
        if (!result.isConfirmed) {
            return; // Stop the form submission if the user cancels
        }

        document.getElementById('bookingForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Logging values before sending the request
            console.log('Seat ID:', document.getElementById('seat_id').value);
            console.log('Departure Date:', document.getElementById('departure_date').value);
            console.log('Bus ID:', document.getElementById('bus_id').value);

            const seatId = document.getElementById('seat_id').value;
            const departureDate = document.getElementById('departure_date').value;
            const busId = document.getElementById('bus_id').value;

            if (!seatId) {
                Swal.fire('Oops!', 'Please select a seat.', 'error');
                return;
            }

            fetch('{{ route('user.booking.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    seat_id: seatId,
                    departure_date: departureDate,
                    bus_id: busId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Booked!', 'Booking confirmed successfully.', 'success');
                    loadSeats(data.seats); // Reload seats to update booked status
                } else {
                    Swal.fire('Failed!', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'An error occurred. Please try again.', 'error');
            });
        });
    });
});




</script>


</body>

</html>
