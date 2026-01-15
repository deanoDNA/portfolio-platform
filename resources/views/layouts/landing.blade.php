<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CV Builder</title>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
      <style>
        /* Reset margin and make body full height */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        /* Full-screen background with reduced opacity */
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset('images/logo.png') }}') no-repeat center center;
            background-size: cover;
            opacity: 0.6; /* Change this to control opacity */
            z-index: -1; /* Keep behind content */
            animation: float 6s infinite alternate;
        }

        /* Content on top of background */
        .content {
            position: relative;
            z-index: 1;
            color: white;
            text-align: center;
            padding-top: 30vh; /* vertically center-ish */
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.5rem;
        }
    </style>
</head>

<body>


     
<!-- Top Navbar -->
<header class="top-nav">
    <div class="logo-text">db tech-production CV Builder</div>
    <div class="nav-links">
        <a href="/login">Login</a>
        <a href="/register" class="btn">Register</a>
    </div>
</header>
<div class="background"></div>

<!-- Page Content -->
@yield('content')

<!-- Footer -->
<footer class="footer">
    © {{ date('Y') }} db tech-production. All rights reserved.
</footer>

</body>
</html>
