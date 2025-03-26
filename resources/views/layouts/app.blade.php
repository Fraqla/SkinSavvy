<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkinSavvy</title>

    <!-- Vite assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire styles -->
    @livewireStyles

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Trix Editor -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    @include('livewire.layout.navigation')

    <!-- Page Layout -->
    <div class="flex h-screen">

        <!-- Sidebar Component -->
        <div class="w-64 bg-gray-800 text-white p-4">
            @livewire('sidebar')
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 p-6 overflow-auto">
            @yield('content')
        </div>

    </div>

    <!-- Livewire scripts -->
    @livewireScripts

</body>

</html>
