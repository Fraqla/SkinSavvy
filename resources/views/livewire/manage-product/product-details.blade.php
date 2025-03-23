<div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center p-4" wire:click.away="$set('showProductDetails', false)">
    <div class="bg-white p-6 rounded shadow-lg w-1/2">
        <h2 class="text-xl font-bold mb-4">Product Details</h2>
        
        <div class="space-y-4">
            <div class="text-center">
                <img src="{{ asset('storage/' . $productDetails['image']) }}" alt="Product Image" class="mx-auto h-40 rounded shadow">
            </div>
            <div>
                <strong>Name:</strong> {{ $productDetails['name'] }}
            </div>
            <div>
                <strong>Category:</strong> {{ $productDetails['category_name'] }}
            </div>
            <div>
                <strong>Ingredient:</strong> {{ $productDetails['ingredient'] }}
            </div>
            <div>
                <strong>Description:</strong>
                <p class="text-gray-700">{{ $productDetails['description'] }}</p>
            </div>

            <div class="flex justify-end mt-4">
                <button wire:click="$set('showProductDetails', false)"
                    class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Close</button>
            </div>
        </div>
    </div>
</div>

