<div class="fixed inset-0 bg-gray-900/70 backdrop-blur-sm flex items-center justify-center p-4 z-50 transition-opacity duration-300 ease-in-out"
    wire:click.away="$set('showProductDetails', false)">
    <div
        class="bg-white rounded-2xl shadow-xl w-full max-w-3xl max-h-[90vh] overflow-y-auto transform transition-all duration-300 ease-out">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-white z-10 px-8 py-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="p-2 rounded-full bg-pink-50 text-pink-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ $productDetails['name'] }}
                    </h2>
                </div>
                <button wire:click="$set('showProductDetails', false)"
                    class="p-2 rounded-full hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-2 flex items-center space-x-2">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                    {{ $productDetails['category_name'] }}
                </span>
            </div>
        </div>

        <!-- Modal Content -->
        <div class="p-8 space-y-8">
            <!-- Product Image Gallery -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="relative group rounded-xl overflow-hidden shadow-lg border border-gray-100">
                    <img src="{{ asset('storage/' . $productDetails['image']) }}" alt="Product Image"
                        class="w-full h-80 object-cover transition-transform duration-500 group-hover:scale-105">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                </div>

                <!-- Key Details -->
                <div class="space-y-6">
                    <div class="prose prose-sm text-gray-600">
                        <h3 class="text-sm font-semibold text-gray-900 mb-2">Description</h3>
                        <p class="whitespace-pre-line">{{ $productDetails['description'] }}</p>
                    </div>

                    <!-- Product Brand -->
                <div class="prose prose-sm text-gray-600">
                    <h3 class="text-sm font-semibold text-gray-900 mb-2">Brand</h3>
                    <p class="text-gray-700">{{ $productDetails['brand'] ?? '-' }}</p>
                </div>

                <!-- Product Suitability -->
                <div class="prose prose-sm text-gray-600">
                    <h3 class="text-sm font-semibold text-gray-900 mb-2">Suitability</h3>
                    <p class="text-gray-700">{{ $productDetails['suitability'] ?? '-' }}</p>
                </div>


                    <!-- Key Ingredient moved here -->
                    <div class="border-t border-gray-100 pt-4">
                        <h3 class="text-sm font-semibold text-gray-900 mb-2">Key Ingredient</h3>
                        <p class="text-gray-700">{{ $productDetails['ingredient'] }}</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Positive Effect</h3>
                            <ul class="space-y-2">
                                @if(is_array($productDetails['positive']) && count($productDetails['positive']) > 0)
                                    @foreach($productDetails['positive'] as $positiveReview)
                                        <li class="flex items-start">
                                            <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-gray-700">{{ $positiveReview }}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <p class="text-gray-500 italic">No benefits information available</p>
                                @endif
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Negative Effect</h3>
                            <ul class="space-y-2">
                                @if(is_array($productDetails['negative']) && count($productDetails['negative']) > 0)
                                    @foreach($productDetails['negative'] as $negativeReview)
                                        <li class="flex items-start">
                                            <svg class="h-5 w-5 text-amber-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            <span class="text-gray-700">{{ $negativeReview }}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <p class="text-gray-500 italic">No benefits information available</p>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-100">
                <button wire:click="$set('showProductDetails', false)"
                    class="px-6 py-3 border border-gray-300 text-sm font-medium rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    Back to Products
                </button>
            </div>
        </div>
    </div>
</div>