<div class="flex min-h-screen bg-gray-50">
    {{-- Sidebar --}}
    @livewire('sidebar')

    {{-- Main Content --}}
    <div class="flex-1 p-6 overflow-auto">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Dashboard Overview</h1>
            <p class="text-gray-600 mt-1">Key metrics and statistics for your application</p>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                {{-- Total Users Card --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Users</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalUsers }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <span>12% from last month</span>
                    </div>
                </div>

                {{-- Total Products Card --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Products</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalProducts }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <span>5 new this month</span>
                    </div>
                </div>

                {{-- Pending Approvals Card --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pending Approvals</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $pendingUsers }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin-approval') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center">
                            Review requests
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Recent Activity Section --}}
            <div class="mt-8 bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Recent Activity</h2>
                <!-- Activity content would go here -->
                <div class="text-center text-gray-500 py-8">
                    <p>Recent user activities will appear here</p>
                </div>
            </div>
        </div>
    </div>
</div>