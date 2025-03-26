<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold">Edit Ingredient</h3>
                <button wire:click="hideForms" class="text-gray-500 hover:text-gray-700">
                    &times;
                </button>
            </div>

            <form wire:submit.prevent="store" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Ingredient Name</label>
                        <input type="text" wire:model="ingredient_name" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('ingredient_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" wire:model="image" 
                               class="mt-1 block w-full text-sm text-gray-500">
                        @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        @if($tempImage)
                            <div class="mt-2">
                                <img src="{{ $tempImage }}" class="h-20 object-cover rounded">
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $image ? 'New image preview' : 'Current image' }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Function</label>
                        <textarea wire:model="function" rows="3" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        @error('function') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Facts (Optional)</label>
                        <textarea wire:model="facts" rows="3" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Benefits (Optional)</label>
                        <textarea wire:model="benefits" rows="3" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" wire:click="hideForms" 
                            class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>