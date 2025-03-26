<div class="flex min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Sidebar -->
    @livewire('sidebar')

    <!-- Main Content -->
    <div class="flex-1 p-6 overflow-auto">
        <div class="max-w-6xl mx-auto">
            @if ($editing)
                <!-- Edit Permissions View -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-blue-50">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">
                                    <span class="text-purple-600">Editing</span> Permissions for 
                                    <span class="text-blue-600">{{ $currentRole->name }}</span>
                                </h2>
                                <p class="text-sm text-gray-500 mt-1">Manage access controls for this role</p>
                            </div>
                            <div class="flex flex-col sm:flex-row gap-2">
                                <button wire:click="cancelEdit" 
                                    class="px-4 py-2.5 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition duration-200 flex items-center justify-center">
                                    Cancel
                                </button>
                                <button wire:click="updatePermissions" 
                                    class="px-4 py-2.5 bg-gradient-to-r from-green-500 to-teal-500 text-white rounded-lg shadow hover:from-green-600 hover:to-teal-600 transition duration-200 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($allPermissions as $permission)
                                <label class="relative flex items-start p-4 space-x-3 border border-gray-200 rounded-lg hover:border-purple-300 hover:bg-purple-50 transition duration-200 cursor-pointer">
                                    <div class="flex items-center h-5">
                                        <input type="checkbox" wire:model="permissions" value="{{ $permission->name }}" 
                                            class="h-5 w-5 text-purple-600 rounded border-gray-300 focus:ring-purple-500">
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <span class="block text-sm font-medium text-gray-700">{{ $permission->name }}</span>
                                        <span class="block text-xs text-gray-500 mt-1">Allows {{ str_replace('.', ' ', $permission->name) }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <!-- Roles List View -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-blue-50">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Role Management</h2>
                                <p class="text-sm text-gray-500 mt-1">Manage system roles and permissions</p>
                            </div>
                            <div class="relative w-full md:w-64">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" wire:model.debounce.300ms="search" placeholder="Search roles..." 
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            </div>
                        </div>
                    </div>

                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Permissions
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($roles as $role)
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-purple-100 to-blue-100 flex items-center justify-center text-purple-600 font-bold">
                                                    {{ strtoupper(substr($role->name, 0, 1)) }}
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $role->name }}</div>
                                                    <div class="text-xs text-gray-500">Created {{ $role->created_at->diffForHumans() }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-wrap gap-1 max-w-xs">
                                                @foreach($role->permissions->take(3) as $permission)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                        {{ $permission->name }}
                                                    </span>
                                                @endforeach
                                                @if($role->permissions->count() > 3)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        +{{ $role->permissions->count() - 3 }} more
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button wire:click="editPermissions({{ $role->id }})" 
                                                class="text-white bg-gradient-to-r from-purple-500 to-blue-500 hover:from-purple-600 hover:to-blue-600 px-4 py-2 rounded-lg shadow-sm transition duration-200 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Manage
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if(method_exists($roles, 'links'))
                        <div class="px-6 py-3 bg-gray-50 border-t border-gray-200">
                            {{ $roles->onEachSide(1)->links() }}
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>