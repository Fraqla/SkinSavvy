<!-- Add Product Modal -->
<div x-show="open" x-cloak class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center p-4">
    <div class="bg-white p-6 rounded shadow-lg w-1/2">
        <h2 class="text-xl font-bold mb-4">Add Product</h2>

        <!-- Form -->
        <form wire:submit.prevent="store" enctype="multipart/form-data" class="space-y-4">
            <input type="text" wire:model="name" placeholder="Product Name" class="w-full px-4 py-2 border rounded"
                required />

            <!-- Category Dropdown -->
            <select wire:model="category_id" class="w-full px-4 py-2 border rounded" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <!-- Image Upload -->
            <input type="file" wire:model="image" class="w-full px-4 py-2 border rounded" />

            <!-- Description -->
            <textarea wire:model="description" placeholder="Product Description"
                class="w-full px-4 py-2 border rounded"></textarea>
                <input type="text" wire:model="ingredient" placeholder="Ingredient"
                class="w-full px-4 py-2 border rounded" />
            <!-- Buttons -->
            <div class="flex justify-end gap-2">
                <button type="button" wire:click="cancel"
                    class="bg-gray-400 px-4 py-2 text-white rounded hover:bg-gray-500">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    Livewire.on('refresh', () => {
        Livewire.rescan(); // Ensure the DOM is rescanned
    });
</script>
