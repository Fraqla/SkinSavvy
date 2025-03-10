<div class="flex h-screen bg-gray-100">
    {{-- Sidebar --}}
    @livewire('sidebar')

    {{-- Main Content --}}
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <div class="grid grid-cols-3 gap-6 mt-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold">Total Users</h2>
                <p class="text-3xl font-bold">120</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold">Total Products</h2>
                <p class="text-3xl font-bold">35</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold">Total Sales</h2>
                <p class="text-3xl font-bold">$15,230</p>
            </div>
        </div>
    </div>
</div>
