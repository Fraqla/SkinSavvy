<div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50 transition-opacity duration-300">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto transform transition-all duration-300">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-gradient-to-r from-pink-50 to-purple-50 px-6 py-4 border-b border-gray-200 z-10">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="p-2 rounded-lg bg-white shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16V7a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h8m0 0l3-3m-3 3l3 3"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Product Safety Details</h3>
                </div>
                <button wire:click="$set('isDetailsModalVisible', false)" class="p-1.5 rounded-full hover:bg-gray-100 text-gray-500 hover:text-gray-700 transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Content -->
        <div class="p-6 space-y-6">
            @if($product->image)
            <div class="relative group rounded-xl overflow-hidden bg-gray-50 shadow-inner">
                <img src="{{ asset('storage/'.$product->image) }}" 
                     class="w-full h-48 object-contain mx-auto transition duration-300 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent"></div>
            </div>
            @endif

            <div class="space-y-5">
                <!-- Product Name -->
                <div class="bg-white p-4 rounded-lg border border-gray-200/60 shadow-sm hover:shadow-md transition duration-200">
                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Product Name</h4>
                    <p class="mt-1 text-lg font-medium text-gray-900">{{ $product->product_name }}</p>
                </div>

                <!-- Detected Poison -->
                <div class="bg-white p-4 rounded-lg border border-gray-200/60 shadow-sm hover:shadow-md transition duration-200">
                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Detected Poison</h4>
                    <p class="mt-1 text-lg font-medium text-red-600">
                        {{ $product->detected_poison ?? 'No toxic substances detected' }}
                    </p>
                </div>

                <!-- Effect -->
                <div class="bg-white p-4 rounded-lg border border-gray-200/60 shadow-sm hover:shadow-md transition duration-200">
                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Health Effects</h4>
                    <p class="mt-1 text-gray-700 whitespace-pre-line leading-relaxed">
                        {{ $product->effect ?? 'No effect information available' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="sticky bottom-0 bg-gradient-to-b from-white/80 to-white px-6 py-4 border-t border-gray-200/60 z-10 backdrop-blur-sm">
            <div class="flex justify-end">
                <button wire:click="$set('isDetailsModalVisible', false)" 
                class="px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                    Close Details
                </button>
            </div>
        </div>
    </div>
</div>