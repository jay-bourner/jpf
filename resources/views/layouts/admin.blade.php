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
    
    <main id="jpf-admin" class="admin-main">
        <x-admin-sidebar></x-admin-sidebar>

        <div class="admin-container">
            <x-admin-content :attributes="$attributes">
                @yield('content')
            </x-admin-content>
        </div>
    </main>
</body>
</html>