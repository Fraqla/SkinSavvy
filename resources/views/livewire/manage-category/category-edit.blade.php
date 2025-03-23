<div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-semibold mb-4">Edit Category</h2>
        <input type="text" wire:model="name" placeholder="Category Name"
            class="w-full border p-2 rounded mb-2">
        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        <div class="flex justify-end gap-2">
            <button wire:click="update" class="bg-yellow-500 px-4 py-2 text-white rounded hover:bg-yellow-600">Update</button>
            <button type="button" wire:click="cancel"
                    class="bg-gray-400 px-4 py-2 text-white rounded hover:bg-gray-500">Cancel</button>
        </div>
    </div>
</div>
