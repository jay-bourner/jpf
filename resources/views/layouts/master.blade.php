<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(isset($data['meta_description']))
        <meta name="description" content="{{ $data['meta_description'] }}">
    @endif

    @if(isset($data['meta_title']))
        <title>{{  $data['meta_title'] }}</title>
    @endif
    
    @vite(['resources/js/app.js'])
</head>
<body>
    <x-navigation></x-navigation>
    <x-banner></x-banner>

    <main class="container">
        @yield('content')
    </div>
    
    <x-footer></x-footer>
</body>
</html>