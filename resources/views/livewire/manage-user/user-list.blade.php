<div class="flex h-screen bg-gray-100">
    {{-- Sidebar --}}
    @livewire('sidebar')
    <div class="p-4 w-full overflow-auto">
    <h1 class="text-xl font-semibold mb-4">Manage Users</h1>

    <!-- Role Filter Dropdown -->
    <select wire:model="selectedRole" class="mb-4 p-2 border rounded">
        @foreach($roles as $role)
            <option value="{{ $role }}">{{ ucfirst($role) }}</option>
        @endforeach
    </select>

    <!-- User List Table -->
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">Role</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->role_name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-4">No users found for this role.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
