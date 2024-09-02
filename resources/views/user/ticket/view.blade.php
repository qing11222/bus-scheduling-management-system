<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bus Ticket - UTeM</title>
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
    .ticket-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .ticket-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .ticket-header h1 {
            font-size: 24px;
            margin-bottom: 5px;
            color: #343a40;
        }

        .ticket-header p {
            margin-bottom: 0;
            color: #6c757d;
        }

        .ticket-info {
            margin-bottom: 20px;
        }

        .ticket-info .row {
            margin-bottom: 10px;
        }

        .ticket-info .row .col {
            font-size: 16px;
            color: #495057;
        }

        .ticket-footer {
            text-align: center;
        }

        .ticket-footer p {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 0;
        }

        .btn-print {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-print:hover {
            background-color: #0056b3;
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
                 <h1 class="display-3 text-white animated slideInDown">Bus Ticket</h1>
                 <nav aria-label="breadcrumb">
                     <ol class="breadcrumb justify-content-center">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item"><a href="#">Pages</a></li>
                         <li class="breadcrumb-item text-white active" aria-current="page">Ticket</li>
                     </ol>
                 </nav>
             </div>
         </div>
     </div>
 </div>

    <!-- Navbar & Hero End -->
    <div id="printable-ticket">
        <!-- Ticket Start -->
        <div class="container my-5">
            <div class="ticket-container">
                <div class="ticket-header">
                    <h1>UTeM Bus Ticket</h1>
                    <p>Bus Scheduling Management System</p>
                </div>
                @foreach ($tickets as $ticket)
                <div class="ticket-info">
                    <div class="row">
                        <div class="col-6"><strong>Passenger Name:</strong></div>
                        <div class="col-6">{{ $ticket->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-6"><strong>Bus Number:</strong></div>
                        <div class="col-6">{{ $ticket->NumberPlate }}</div>
                    </div>
                    <div class="row">
                        <div class="col-6"><strong>Seat Number:</strong></div>
                        <div class="col-6">{{ $ticket->SeatNumber }}</div>
                    </div>
                    <div class="row">
                        <div class="col-6"><strong>Departure Date:</strong></div>
                        <div class="col-6">{{ $ticket->departure_date }}</div>
                    </div>
                    <div class="row">
                        <div class="col-6"><strong>Booking Date:</strong></div>
                        <div class="col-6">{{ $ticket->BookingDate }}</div>
                    </div>
                </div>
                @endforeach

                <div class="ticket-footer">
                    <button class="btn-print" onclick="printTicket()">Print Ticket</button>
                    <p>Please bring this ticket with you on the day of departure.</p>
                </div>
            </div>
        </div>
        <!-- Ticket End -->
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
    <script src="{{ asset('js/loading.js') }}"></script>
    <script>
function printTicket() {
    var ticketContents = document.querySelector('#printable-ticket').innerHTML;
    var originalContents = document.body.innerHTML;

    // Create a new window for printing
    var printWindow = window.open('', '', 'height=700,width=500');
    printWindow.document.write('<html><head><title>Bus Ticket - UTeM</title>');
    printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css">');
    printWindow.document.write('<link rel="stylesheet" href="{{ asset('templete/css/style.css') }}">'); // Include your stylesheet
    printWindow.document.write('<style>');
    printWindow.document.write('.ticket-container { background-color: #f8f9fa; padding: 20px; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); max-width: 600px; margin: 0 auto; }');
    printWindow.document.write('.ticket-header { text-align: center; margin-bottom: 20px; }');
    printWindow.document.write('.ticket-header h1 { font-size: 24px; margin-bottom: 5px; color: #343a40; }');
    printWindow.document.write('.ticket-header p { margin-bottom: 0; color: #6c757d; }');
    printWindow.document.write('.ticket-info { margin-bottom: 20px; }');
    printWindow.document.write('.ticket-info .row { margin-bottom: 10px; }');
    printWindow.document.write('.ticket-info .row .col { font-size: 16px; color: #495057; }');
    printWindow.document.write('.ticket-footer { text-align: center; }');
    printWindow.document.write('.ticket-footer p { color: #6c757d; font-size: 14px; margin-bottom: 0; }');
    printWindow.document.write('.btn-print { background-color: #007bff; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }');
    printWindow.document.write('.btn-print:hover { background-color: #0056b3; }');
    printWindow.document.write('</style></head><body>');
    printWindow.document.write(ticketContents);
    printWindow.document.write('</body></html>');

    printWindow.document.close();
    printWindow.focus();

    printWindow.print();
}


    </script>




</body>

</html>

