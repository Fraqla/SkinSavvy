<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkinSavvy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    @include('livewire.layout.navigation')

    <!-- Page Layout -->
    <div class="flex h-screen">

        <!-- Sidebar Component -->
        <div class=" bg-gray-800 text-white p-4">
            @livewire('sidebar')
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 p-6 overflow-auto">
            @yield('content')
        </div>

    </div>

    @livewireScripts
</body>
</html>
