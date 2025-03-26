<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="p-6">
            <h3 class="text-lg font-bold mb-4">Delete Product</h3>
            <p class="mb-6">Are you sure you want to delete this product? This action cannot be undone.</p>

            <div class="flex justify-end space-x-3">
                <button wire:click="hideForms" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">
                    Cancel
                </button>
                <button wire:click="delete" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>  