<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bus Booking</title>
    <!-- Include other necessary styles and scripts -->
    <link rel="stylesheet" href="{{ asset('templete/css/style.css') }}">
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
    <!-- Include topbar and navbar -->
    @include('user.topbar')
    @include('user.navbar')

    <div class="container mt-4">
        <h1 class="mb-4">Bus Seat Booking for {{ $bus->NumberPlate }}</h1>
        <form id="bookingForm">
            <div class="form-group">
                <label for="departure_date">Departure Date:</label>
                <select id="departure_date" name="departure_date" class="form-control" required>
                    <option value="">Select a date</option>
                    @foreach($departureDates as $date)
                        <option value="{{ $date->departure_date }}">{{ $date->formatted_date }}</option>
                    @endforeach
                </select>
            </div>

            <div id="seat-selection">
                <!-- Seat map will be dynamically loaded here -->
            </div>
            <input type="hidden" id="seat_id" value="">
            <button type="submit" id="bookNowButton" class="btn btn-primary">Book Now</button>
        </form>
        <div class="legend">
            <div><div class="seat available"></div> Available</div>
            <div><div class="seat selected"></div> Selected</div>
            <div><div class="seat booked"></div> Booked</div>
        </div>
    </div>

    <!-- Include footer and other necessary scripts -->
    @include('user.footer')
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
    <script>
        document.getElementById('departure_date').addEventListener('change', function() {
            const departureDate = this.value;
            if (departureDate) {
                fetchSeats(departureDate);
            } else {
                alert('Please select a departure date.');
            }
        });

        function fetchSeats(departureDate) {
            const busId = '{{ $bus->ExternalBusID }}'; // Use the bus ID from the Blade template

            fetch(`/user/booking/${busId}/seats?departure_date=${departureDate}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadSeats(data.seats);
                    } else {
                        alert('Failed to fetch seat data.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while fetching seat data.');
                });
        }

        function loadSeats(seats) {
            const seatSelection = document.getElementById('seat-selection');
            seatSelection.innerHTML = '<div class="seat-label">Select your seat:</div><div class="seat-map"></div>';

            const seatMap = document.querySelector('.seat-map');
            seatMap.innerHTML = ''; // Clear existing seats

            // Determine the number of columns for the grid
            const cols = 4; // Number of columns (adjust as needed)
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
    </script>
</body>
</html>
