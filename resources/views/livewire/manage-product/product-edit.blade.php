<div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center p-4">
    <div class="bg-white p-6 rounded shadow-lg w-1/2">
        <h2 class="text-xl font-bold mb-4">Edit Product</h2>

        <form wire:submit.prevent="update" enctype="multipart/form-data" class="space-y-4">
            <input type="text" wire:model="name" placeholder="Product Name" class="w-full px-4 py-2 border rounded"
                required />

            <select wire:model="category_id" class="w-full px-4 py-2 border rounded" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <input type="text" wire:model="ingredient" placeholder="Ingredient" class="w-full px-4 py-2 border rounded" />

            <!-- Show the existing image if available -->
            @if ($existingImage && !$image)
                <div class="mb-2">
                    <p class="text-sm text-gray-500">Current Image:</p>
                    <img src="{{ asset('storage/' . $existingImage) }}" class="w-32 h-32 object-cover rounded-lg" />
                </div>
            @endif

            <!-- Image Upload Input -->
            <input type="file" wire:model="image" class="w-full px-4 py-2 border rounded" />

            <textarea wire:model="description" placeholder="Product Description"
                class="w-full px-4 py-2 border rounded"></textarea>

            <div class="flex justify-end gap-2">
                <button type="button" wire:click="cancel"
                    class="bg-gray-400 px-4 py-2 text-white rounded hover:bg-gray-500">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    window.addEventListener('openEditModal', () => {
        document.querySelector('[x-data]').__x.$data.open = true;
    });
</script>
