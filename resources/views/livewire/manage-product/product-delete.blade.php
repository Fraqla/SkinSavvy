

@if($confirmingProductDeletion)
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center p-4 z-50">
        <div class="bg-white p-6 rounded shadow-lg w-1/3">
            <h2 class="text-xl font-bold mb-4 text-red-600">Confirm Deletion</h2>
            <p>Are you sure you want to delete this product? This action cannot be undone.</p>

            <div class="flex justify-end gap-2 mt-4">
                <button wire:click="$set('confirmingProductDeletion', false)"
                    class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Cancel
                </button>
                <button wire:click="deleteProduct"
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    Delete
                </button>
            </div>
        </div>
    </div>
@endif



<script>
    Livewire.on('refresh', () => {
        Livewire.rescan(); // Ensure the DOM is rescanned
    });
</script>
