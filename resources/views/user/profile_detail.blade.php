<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>User Profile - UTeM</title>
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
    <link href="{{ asset('templete/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('templete/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('templete/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('templete/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('templete/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        .hero-header {
            margin-bottom: 30px;
        }

        .profile-container {
            margin: 20px 0;
        }

        .form-section {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            background: #f9f9f9;
        }

        .form-section h4 {
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            border-radius: 4px;
            border: 1px solid #ddd;
            padding: 10px;
            width: 100%;
        }

        .form-group input[type="file"] {
            padding: 0;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
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
                    <h1 class="display-3 text-white mb-3 animated slideInDown">User Profile</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Profile Detail Start -->
    <div class="container profile-container">
        @include('partials.flash_messages')
        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-section">
                <h4>Personal Information</h4>
                <div class="form-section">
                    <h4>Profile Photo</h4>
                    @if($user->profile_photo_path)
                    <img src="{{ asset('storage/profile_photos/' . basename($user->profile_photo_path)) }}" alt="Profile Photo">
                    @else
                        <p>No photo uploaded</p>
                    @endif
                    <div class="form-group">
                        <label for="profile_photo">Upload new photo</label>
                        <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
                </div>

                <div class="form-group">
                    <label for="matricNumber">Matric Number</label>
                    <input type="matricNumber" class="form-control" id="matricNumber" name="matricNumber" value="{{ $user->matricNumber }}" required>
                </div>

                <div class="form-group">
                    <label for="faculty">Faculty</label>
                    <select class="form-control" id="faculty" name="faculty" required>
                        <option value="" disabled>Select Faculty</option>
                        <option value="FKE" {{ old('faculty', $user->faculty) == 'FKE' ? 'selected' : '' }}>FKE</option>
                        <option value="FKEKK" {{ old('faculty', $user->faculty) == 'FKEKK' ? 'selected' : '' }}>FKEKK</option>
                        <option value="FKM" {{ old('faculty', $user->faculty) == 'FKM' ? 'selected' : '' }}>FKM</option>
                        <option value="FKP" {{ old('faculty', $user->faculty) == 'FKP' ? 'selected' : '' }}>FKP</option>
                        <option value="FTMK" {{ old('faculty', $user->faculty) == 'FTMK' ? 'selected' : '' }}>FTMK</option>
                        <option value="FPTT" {{ old('faculty', $user->faculty) == 'FPTT' ? 'selected' : '' }}>FPTT</option>
                        <option value="FTK" {{ old('faculty', $user->faculty) == 'FTK' ? 'selected' : '' }}>FTK</option>
                    </select></td>
                </div>

                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" id="age" name="age" value="{{ $user->age }}" required>
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="" disabled>Select Gender</option>
                        <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="course">Course</label>
                    <select class="form-control" id="course" name="course" required>
                        <option value="" disabled>Select a course</option>
                        <option value="Computer Science" {{ old('course', $user->course) == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                        <option value="Engineering" {{ old('course', $user->course) == 'Engineering' ? 'selected' : '' }}>Engineering</option>
                        <option value="Business Administration" {{ old('course', $user->course) == 'Business Administration' ? 'selected' : '' }}>Business Administration</option>
                        <option value="Mechanical Engineering" {{ old('course', $user->course) == 'Mechanical Engineering' ? 'selected' : '' }}>Mechanical Engineering</option>
                        <option value="Electrical Engineering" {{ old('course', $user->course) == 'Electrical Engineering' ? 'selected' : '' }}>Electrical Engineering</option>
                        <option value="Civil Engineering" {{ old('course', $user->course) == 'Civil Engineering' ? 'selected' : '' }}>Civil Engineering</option>
                        <option value="Aerospace Engineering" {{ old('course', $user->course) == 'Aerospace Engineering' ? 'selected' : '' }}>Aerospace Engineering</option>
                        <option value="Information Technology" {{ old('course', $user->course) == 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                        <!-- Add more UTeM courses as needed -->
                    </select>
                </div>



            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
    <!-- Profile Detail End -->

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

</body>

</html>
