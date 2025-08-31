<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/image/icons/jpfitnesslogoicon.png">
    
    @if(isset($data['meta_description']))
        <meta name="description" content="{{ $data['meta_description'] }}">
    @endif

    @if(isset($data['meta_title']))
        <title>{{  $data['meta_title'] }}</title>
    @endif
    
    <script type="text/javascript" src="https://www.termsfeed.com/public/cookie-consent/4.2.0/cookie-consent.js" charset="UTF-8"></script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <x-navigation></x-navigation>
    <x-banner></x-banner>

    <main class="container">
        @yield('content')
    </main>
    
    <x-footer></x-footer>
    
    <div id="modals"></div>
</body>
</html>