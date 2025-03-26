<div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50 transition-opacity duration-300" wire:click.away="$set('showProductDetails', false)">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl overflow-hidden transform transition-all duration-300">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-pink-50 to-purple-50 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                    </svg>
                    Product Details
                </h2>
                <button wire:click="$set('showProductDetails', false)" class="text-gray-400 hover:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Content -->
        <div class="p-6 space-y-6">
            <!-- Product Image -->
            <div class="flex justify-center">
                <div class="relative w-64 h-64 rounded-lg overflow-hidden shadow-md border border-gray-100">
                    <img src="{{ asset('storage/' . $productDetails['image']) }}" alt="Product Image" 
                         class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                </div>
            </div>

            <!-- Product Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Name:</span>
                        <span class="text-sm font-medium text-black-500 w-24">{{ $productDetails['name'] }}</span>
                    </div>
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Category:</span>
                        <span class="flex-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                {{ $productDetails['category_name'] }}
                            </span>
                        </span>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Key Ingredient:</span>
                        <span class="text-sm font-medium text-black-500 w-24">{{ $productDetails['ingredient'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="border-t border-gray-200 pt-4">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Description</h3>
                <p class="text-gray-700 whitespace-pre-line">{{ $productDetails['description'] }}</p>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end">
            <button wire:click="$set('showProductDetails', false)"
                class="px-6 py-2.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                Close
            </button>
        </div>
    </div>
</div>