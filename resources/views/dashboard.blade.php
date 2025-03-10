<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-md p-5">
            <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
            <ul class="mt-5">
                <li class="p-3 hover:bg-gray-200 rounded"><a href="#">Home</a></li>
                <li class="p-3 hover:bg-gray-200 rounded"><a href="#">Users</a></li>
                <li class="p-3 hover:bg-gray-200 rounded"><a href="#">Settings</a></li>
                <li class="p-3 hover:bg-gray-200 rounded text-red-500"><a href="#">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-10">
            <h1 class="text-3xl font-bold mb-5">Welcome to Dashboard</h1>
            <div class="grid grid-cols-3 gap-5">
                <div class="bg-white p-5 shadow rounded-lg">
                    <h3 class="text-lg font-semibold">Users</h3>
                    <p class="text-gray-500">1,234 Registered</p>
                </div>
                <div class="bg-white p-5 shadow rounded-lg">
                    <h3 class="text-lg font-semibold">Sales</h3>
                    <p class="text-gray-500">$45,000 Revenue</p>
                </div>
                <div class="bg-white p-5 shadow rounded-lg">
                    <h3 class="text-lg font-semibold">Messages</h3>
                    <p class="text-gray-500">25 New Messages</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
