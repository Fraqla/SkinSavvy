<div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50 transition-opacity duration-300">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto transform transition-all duration-300">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-gradient-to-r from-pink-50 to-purple-50 px-6 py-4 border-b border-gray-200 z-10">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="p-2.5 rounded-xl bg-gradient-to-r from-purple-100 to-indigo-100 shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">
                        <span class="text-purple-600">{{ $ingredient->ingredient_name }}</span>
                    </h3>
                </div>
                <button wire:click="closeDetailsModal" class="p-1.5 rounded-full hover:bg-gray-100 text-gray-500 hover:text-gray-700 transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Content -->
        <div class="p-8 space-y-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Image Section -->
                <div class="lg:col-span-1">
                    <div class="relative rounded-xl overflow-hidden shadow-lg bg-gray-50">
                        @if($ingredient->image)
                            <img src="{{ asset('storage/' . $ingredient->image) }}" 
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

                <!-- Details Section -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Function -->
                    <div class="bg-white p-5 rounded-xl border border-gray-200/60 shadow-sm hover:shadow-md transition duration-200">
                        <h4 class="text-xl font-semibold text-gray-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Function
                        </h4>
                        <div class="mt-3 prose prose-indigo text-gray-600 max-w-none">
                            {{ $ingredient->function }}
                        </div>
                    </div>

                    <!-- Facts -->
                    @if($ingredient->facts)
                    <div class="bg-white p-5 rounded-xl border border-gray-200/60 shadow-sm hover:shadow-md transition duration-200">
                        <h4 class="text-xl font-semibold text-gray-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Key Facts
                        </h4>
                        <div class="mt-3 prose prose-indigo text-gray-600 max-w-none">
                            {{ $ingredient->facts }}
                        </div>
                    </div>
                    @endif

                    <!-- Benefits -->
                    @if($ingredient->benefits)
                    <div class="bg-white p-5 rounded-xl border border-gray-200/60 shadow-sm hover:shadow-md transition duration-200">
                        <h4 class="text-xl font-semibold text-gray-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                            Skin Benefits
                        </h4>
                        <div class="mt-3 prose prose-indigo text-gray-600 max-w-none">
                            {{ $ingredient->benefits }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="sticky bottom-0 bg-gradient-to-b from-white/80 to-white px-8 py-4 border-t border-gray-200/60 z-10 backdrop-blur-sm">
            <div class="flex justify-end">
                <button wire:click="closeDetailsModal" 
                class="px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                    Close Details
                </button>
            </div>
        </div>
    </div>
</div>