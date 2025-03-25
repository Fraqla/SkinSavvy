<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-semibold mb-4">Add Skin Knowledge</h2>

        <!-- Skin Type Input -->
        <div class="mb-4">
            <label class="block text-gray-700">Skin Type</label>
            <input type="text" wire:model="skin_type" class="w-full px-4 py-2 border rounded">
            @error('skin_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Dynamic Characteristics Input -->
        <div class="mb-4">
            <label class="block text-gray-700">Characteristics</label>
            @foreach($characteristics as $index => $characteristic)
                <div class="flex items-center gap-2 mb-2">
                    <input type="text" wire:model="characteristics.{{ $index }}" class="w-full px-4 py-2 border rounded">
                    <button wire:click.prevent="removeCharacteristic({{ $index }})" class="bg-red-500 text-white px-2 py-1 rounded">-</button>
                </div>
            @endforeach
            <button wire:click.prevent="addCharacteristic" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-2">+ Add Characteristic</button>
        </div>

        <!-- Dynamic Best Ingredients Input -->
        <div class="mb-4">
            <label class="block text-gray-700">Best Ingredients</label>
            @foreach($best_ingredients as $index => $ingredient)
                <div class="flex items-center gap-2 mb-2">
                    <input type="text" wire:model="best_ingredient.{{ $index }}" class="w-full px-4 py-2 border rounded">
                    <button wire:click.prevent="removeIngredient({{ $index }})" class="bg-red-500 text-white px-2 py-1 rounded">-</button>
                </div>
            @endforeach
            <button wire:click.prevent="addIngredient" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-2">+ Add Ingredient</button>
        </div>

        <!-- Image Upload -->
        <div class="mb-4">
            <label class="block text-gray-700">Image</label>
            <input type="file" wire:model="image" class="w-full px-4 py-2 border rounded">
            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            @if($image)
                <img src="{{ $image->temporaryUrl() }}" class="mt-2 h-20 w-20 object-cover">
            @endif
        </div>

        <!-- Save/Cancel Buttons -->
        <div class="flex justify-end space-x-2">
            <button wire:click="save" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Save
            </button>
            <button wire:click="$set('isAddFormVisible', false)" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancel
            </button>
        </div>
    </div>
</div>
