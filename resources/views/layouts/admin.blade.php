<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome </title>
    @vite(['resources/js/app.js'])
</head>
<body>
    <x-navigation></x-navigation>
    <x-admin-sidebar></x-admin-sidebar>

    <main class="container">
        <div class="admin-container">
            @yield('content')
        </div>
    </main>
    
    <x-footer class="{{$data['footer_class']}}"></x-footer>
</body>
</html>