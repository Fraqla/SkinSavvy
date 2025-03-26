<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-bold text-gray-800">{{ $ingredient->ingredient_name }}</h3>
                <button wire:click="closeDetailsModal" class="text-gray-500 hover:text-gray-700 text-2xl">
                    &times;
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Image Section -->
                <div class="md:col-span-1">
                    @if($ingredient->image)
                        <img src="{{ asset('storage/' . $ingredient->image) }}" 
                             class="w-full h-48 object-cover rounded-lg shadow-md">
                    @else
                        <div class="w-full h-48 bg-gray-100 rounded-lg flex items-center justify-center">
                            <span class="text-gray-400">No image available</span>
                        </div>
                    @endif
                </div>

                <!-- Details Section -->
                <div class="md:col-span-2 space-y-4">
                    <!-- Function -->
                    <div>
                        <h4 class="text-lg font-semibold text-gray-700">Function</h4>
                        <p class="mt-1 text-gray-600 whitespace-pre-line">{{ $ingredient->function }}</p>
                    </div>

                    <!-- Facts -->
                    @if($ingredient->facts)
                    <div>
                        <h4 class="text-lg font-semibold text-gray-700">Facts</h4>
                        <p class="mt-1 text-gray-600 whitespace-pre-line">{{ $ingredient->facts }}</p>
                    </div>
                    @endif

                    <!-- Benefits -->
                    @if($ingredient->benefits)
                    <div>
                        <h4 class="text-lg font-semibold text-gray-700">Benefits</h4>
                        <p class="mt-1 text-gray-600 whitespace-pre-line">{{ $ingredient->benefits }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-gray-200 flex justify-end">
                <button wire:click="closeDetailsModal" 
                        class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>