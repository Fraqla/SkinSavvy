<div class="flex min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Sidebar -->
    @livewire('sidebar')

    <!-- Main Content -->
    <div class="flex-1 p-6 overflow-auto">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">User Management</h1>
                <p class="text-gray-500 text-sm mt-1">Manage system users and permissions</p>
            </div>
        </div>

        <!-- Role Filter -->
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <label for="roleFilter" class="block text-sm font-medium text-gray-700 mb-2">Filter by Role</label>
            <select wire:model="selectedRole" id="roleFilter">
    @foreach($roles as $role)
        <option value="{{ $role }}">{{ ucfirst($role) }}</option>
    @endforeach
</select>

        </div>

        <!-- User Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-pink-50 to-purple-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            User
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Role
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-pink-100 to-purple-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                                {{ $user->role_name }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-lg font-medium text-gray-500">No users found</p>
                                <p class="text-sm mt-1">Try selecting a different role</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination - Only show if users is a paginator instance -->
        @if(method_exists($users, 'links'))
        <div class="mt-6">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>