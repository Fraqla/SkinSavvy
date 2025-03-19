<div class="flex h-screen bg-gray-100">
    {{-- Sidebar --}}
    @livewire('sidebar')

    <div class="p-4 w-full overflow-auto">
        <h2 class="text-2xl font-bold mb-4">Pending Admin Consultant Approvals</h2>

        <!-- Flash Messages -->
        @if (session()->has('success'))
            <div class="text-green-500">{{ session('success') }}</div>
        @endif
        @if (session()->has('error'))
            <div class="text-red-500">{{ session('error') }}</div>
        @endif

        <!-- Approval Table -->
        <div class="w-full overflow-x-auto shadow-lg rounded-lg border border-gray-200">
            <table class="min-w-full table-auto border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2 text-left">Name</th>
                        <th class="border p-2 text-left">Email</th>
                        <th class="border p-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingAdmins as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="border p-2">{{ $user->name }}</td>
                            <td class="border p-2">{{ $user->email }}</td>
                            <td class="border p-2">
                                <!-- Approve Button -->
                                <button wire:click="approve({{ $user->id }})"
                                        class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-700">
                                    Approve
                                </button>

                                <!-- Remove Button with Confirmation -->
                                <button wire:click="$emit('confirmRemove', {{ $user->id }})"
                                        class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-700 ml-2">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center p-4 text-gray-500">No pending admin consultants.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- SweetAlert for Confirm Remove -->
<script>
    window.livewire.on('confirmRemove', userId => {
        if (confirm('Are you sure you want to remove this admin consultant?')) {
            Livewire.emit('remove', userId);
        }
    });
</script>
