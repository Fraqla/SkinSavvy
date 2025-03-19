@if($confirmingDeletion)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Are you sure you want to delete this category?</h2>

            <div class="flex justify-between">
                <button wire:click="deleteConfirmed" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    Yes, Delete
                </button>
                <button wire:click="$set('confirmingDeletion', false)"
                    class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Cancel
                </button>
            </div>
        </div>
    </div>
@endif
