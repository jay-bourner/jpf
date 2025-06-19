<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/js/app.js'])
    <title>Document</title>
</head>
<body>
    <x-navigation></x-navigation>
    @yield('content')
    
    <x-footer></x-footer>
</body>
</html>