<!-- Add Product Modal -->

    <div x-show="open" x-cloak class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center p-4">
        <div class="bg-white p-6 rounded shadow-lg w-1/2">
            <h2 class="text-xl font-bold mb-4">Add Product</h2>

            <form wire:submit.prevent="store" class="space-y-4">
                <input type="text" wire:model="name" placeholder="Product Name" class="w-full px-4 py-2 border rounded" required />
                
                <select wire:model="category_id" class="w-full px-4 py-2 border rounded" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <input type="text" wire:model="ingredient" placeholder="Ingredient" class="w-full px-4 py-2 border rounded" />
                <input type="file" wire:model="image" class="w-full px-4 py-2 border rounded" />

                <textarea wire:model="description" placeholder="Product Description" class="w-full px-4 py-2 border rounded"></textarea>

                <div class="flex justify-end gap-2">
                <button wire:click="$set('showAddForm', false)"
                    class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Cancel
                </button>
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    Livewire.on('refresh', () => {
        Livewire.rescan(); // Ensure the DOM is rescanned
    });
</script>
