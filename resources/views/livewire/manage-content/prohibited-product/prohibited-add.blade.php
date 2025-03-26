<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold">Add New Product</h3>
                <button wire:click="hideForms" class="text-gray-500 hover:text-gray-700">
                    &times;
                </button>
            </div>

            <form wire:submit.prevent="store">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" wire:model="product_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('product_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Detected Poison</label>
                        <input type="text" wire:model="detected_poison" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('detected_poison') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Effect</label>
                        <textarea wire:model="effect" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        @error('effect') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
    <label class="block text-sm font-medium text-gray-700">Product Image</label>
    <input type="file" wire:model="image" class="mt-1 block w-full text-sm text-gray-500">
    @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    
    @if($tempImage)
        <div class="mt-2">
            <img src="{{ $tempImage }}" class="h-20 object-cover rounded">
        </div>
    @elseif(isset($product) && $product->image)
        <div class="mt-2">
            <img src="{{ asset('storage/'.$product->image) }}" class="h-20 object-cover rounded">
        </div>
    @endif
</div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" wire:click="hideForms" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>