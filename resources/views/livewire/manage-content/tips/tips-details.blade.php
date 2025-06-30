<div class="fixed inset-0 bg-gray-900/70 backdrop-blur-sm flex items-center justify-center p-4 z-50 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto transform transition-all duration-300 ease-out border border-gray-100/50">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-4 border-b border-gray-200/60 z-10 backdrop-blur-sm">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="p-2 rounded-lg bg-white shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16V7a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h8m0 0l3-3m-3 3l3 3"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Tip Details</h3>
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
            @if($currentTip)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tip Image -->
                    <div class="md:col-span-1">
                        <div class="relative rounded-xl overflow-hidden shadow-lg bg-gray-50">
                            @if($currentTip->image)
                                <img src="{{ asset('storage/' . $currentTip->image) }}" 
                                    class="w-full h-64 object-cover transition duration-300 hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            @else
                                <div class="w-full h-64 flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100">
                                    <div class="text-center p-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="mt-2 text-gray-500 font-medium">No image available</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Tip Details -->
                    <div class="md:col-span-1 space-y-4">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-700">Title</h4>
                            <p class="mt-1 text-gray-800">{{ $currentTip->title }}</p>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold text-gray-700">Description</h4>
                            <div class="mt-1 prose prose-indigo text-gray-600">
                                {!! $currentTip->description !!}
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-200/60">
                            <p class="text-sm text-gray-500">Created: {{ $currentTip->created_at->format('M d, Y') }}</p>
                            @if($currentTip->updated_at != $currentTip->created_at)
                                <p class="text-sm text-gray-500">Updated: {{ $currentTip->updated_at->format('M d, Y') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Modal Footer -->
        <div class="sticky bottom-0 bg-gradient-to-b from-white/80 to-white px-6 py-4 border-t border-gray-200/60 z-10 backdrop-blur-sm">
            <div class="flex justify-end space-x-3">
                <button wire:click="$set('isDetailsModalVisible', false)" 
                    class="px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>