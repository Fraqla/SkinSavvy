<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth Layout</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    @livewireStyles
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    {{ $slot }} {{-- Livewire will inject content here --}}

    @livewireScripts
</body>
</html>
