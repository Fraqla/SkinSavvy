<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold">Product Details</h3>
                <button wire:click="$set('isDetailsModalVisible', false)" class="text-gray-500 hover:text-gray-700">
                    &times;
                </button>
            </div>

            <div class="space-y-4">
                @if($product->image)
                <div class="flex justify-center">
                    <img src="{{ asset('storage/'.$product->image) }}" class="h-40 object-contain rounded-lg">
                </div>
                @endif

                <div>
                    <h4 class="text-sm font-medium text-gray-500">Product Name</h4>
                    <p class="mt-1 text-gray-900">{{ $product->product_name }}</p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-500">Detected Poison</h4>
                    <p class="mt-1 text-gray-900">{{ $product->detected_poison ?? 'Not specified' }}</p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-500">Effect</h4>
                    <p class="mt-1 text-gray-900 whitespace-pre-line">{{ $product->effect ?? 'Not specified' }}</p>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button wire:click="$set('isDetailsModalVisible', false)" 
                        class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>