<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in to your JPF account</title>
    <script type="text/javascript" src="https://www.termsfeed.com/public/cookie-consent/4.2.0/cookie-consent.js" charset="UTF-8"></script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <x-navigation></x-navigation>
    <div class="login-banner">
        <div class="hero-logo">
            <img src="/image/logos/jpfitnesslogo2025.jpg" alt="" width="" height="">
        </div>
    </div>
    
    <main class="container">
        @yield('content')
    </main>

    <x-footer></x-footer>
    <div id="modals"></div>
</body>
</html>