<div class="flex h-screen bg-gray-100">
    @livewire('sidebar')

    <div class="flex-1 p-6">
        @if ($editing)
            <h2 class="font-bold mb-4">Edit Permissions for {{ $currentRole->name }}</h2>

            @foreach ($allPermissions as $permission)
                <label class="block">
                    <input type="checkbox" wire:model="permissions" value="{{ $permission->name }}">
                    {{ $permission->name }}
                </label>
            @endforeach

            <button wire:click="updatePermissions" class="bg-green-500 px-2 py-1 mt-2">Save</button>
            <button wire:click="cancelEdit" class="bg-gray-500 px-2 py-1 mt-2 ml-2">Cancel</button>

        @else
            <h2 class="font-bold mb-4">Roles</h2>
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2">Role</th>
                        <th class="border p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td class="border p-2">{{ $role->name }}</td>
                            <td class="border p-2">
                                <button wire:click="editPermissions({{ $role->id }})" class="bg-blue-500 px-2 py-1">Edit Permissions</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
