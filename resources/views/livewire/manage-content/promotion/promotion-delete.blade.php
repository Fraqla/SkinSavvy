<!-- delete-promotion.blade.php -->
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" wire:ignore.self>
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-semibold mb-4 text-red-600">Delete Promotion</h2>

        <p>Are you sure you want to delete this promotion?</p>

        <div class="flex justify-end space-x-2 mt-4">
            <button wire:click="delete" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
            <button type="button" wire:click="$dispatch('hide-delete-promotion')"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancel
            </button>

        </div>
    </div>
</div>