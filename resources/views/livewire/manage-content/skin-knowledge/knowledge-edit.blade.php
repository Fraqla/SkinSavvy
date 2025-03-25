<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-semibold mb-4">Add Skin Knowledge</h2>

        <!-- Skin Type Input -->
        <div class="mb-4">
            <label class="block text-gray-700">Skin Type</label>
            <input type="text" wire:model="skin_type" class="w-full px-4 py-2 border rounded">
            @error('skin_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Characteristics Input (Dynamic Array) -->
        <div class="mt-4">
            <label for="characteristics">characteristics:</label>
            @foreach ($characteristics as $index => $characteristic)
                <div class="flex gap-2 items-center">
                    <input type="text" wire:model="characteristics.{{ $index }}" class="form-input">
                    <button type="button" wire:click="removeCharacteristic({{ $index }})" class="text-red-500">Remove</button>
                </div>
            @endforeach
            <button type="button" wire:click="addCharacteristic" class="mt-2 text-blue-500">+ Add characteristic</button>
        </div>

        <div class="mt-4">
            <label for="best_ingredients">Best Ingredients:</label>
            @foreach ($best_ingredients as $index => $ingredient)
                <div class="flex gap-2 items-center">
                    <input type="text" wire:model="best_ingredients.{{ $index }}" class="form-input">
                    <button type="button" wire:click="removeIngredient({{ $index }})" class="text-red-500">Remove</button>
                </div>
            @endforeach
            <button type="button" wire:click="addIngredient" class="mt-2 text-blue-500">+ Add Ingredient</button>
        </div>



        <!-- Image Upload -->
        <div class="mb-4">
            <label class="block text-gray-700">Image</label>
            <input type="file" wire:model="image" class="w-full px-4 py-2 border rounded">
            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            @if($image)
                <img src="{{ $image instanceof \Livewire\TemporaryUploadedFile ? $image->temporaryUrl() : asset('storage/' . $image) }}"
                    class="mt-2 h-20 w-20 object-cover">

            @endif
        </div>

        <!-- Save/Cancel Buttons -->
        <div class="flex justify-end space-x-2">
            <button wire:click="save" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Save
            </button>
            <button wire:click="$set('isAddFormVisible', false)"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancel
            </button>
        </div>
    </div>
</div>

<!-- Skin Details Modal -->
@if($showSkinDetails)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-semibold mb-4">Skin Knowledge Details</h2>
            <p><strong>Skin Type:</strong> {{ $skinDetails['skin_type'] }}</p>
            <p><strong>Characteristics:</strong></p>
            <ul class="list-disc ml-6">
                @foreach(json_decode($skinDetails['characteristics'], true) as $char)
                    <li>{{ $char }}</li>
                @endforeach
            </ul>
            <p><strong>Best Ingredients:</strong> {{ implode(', ', json_decode($skinDetails['best_ingredients'], true)) }}</p>

            @if($skinDetails['image'])
                <img src="{{ asset('storage/' . $skinDetails['image']) }}" class="mt-2 h-40 w-40 object-cover">
            @endif
            <button wire:click="closeDetails"
                class="mt-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Close</button>
        </div>
    </div>
@endif