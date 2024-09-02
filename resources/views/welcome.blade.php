<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to UTeM Bus Scheduling Management System</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
           background: linear-gradient(to right, #ffffff, #91c0ff);
        }
        .container {
            text-align: center;
        }
        .logo {
            width: 300px;
            margin-bottom: 20px;
        }
        .title {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }
        .subtitle {
            font-size: 1rem;
            color: #666;
            margin-bottom: 30px;
        }
        .button {
            background-color: #525CEB;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #e62117;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="/Images/utemlogo.png" alt="Bus Logo" class="logo"> <!-- Updated image URL -->
        <div class="title">Welcome to UTeM Bus Scheduling Management System</div>
        <div class="subtitle">Please log in or register to access the system</div>

        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('home') }}" class="button">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="button">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="button">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</body>
</html>
