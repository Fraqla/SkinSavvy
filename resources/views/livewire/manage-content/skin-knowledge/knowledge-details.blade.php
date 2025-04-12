<div
    class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50 transition-opacity duration-300">
    <div
        class="bg-white rounded-xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto transform transition-all duration-300">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-gradient-to-r from-pink-50 to-purple-50 px-6 py-4 border-b border-gray-200 z-10">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl font-bold text-gray-800">
                    <span class="text-purple-600">Skin Type:</span> {{ $skinKnowledge->skin_type }}
                </h3>
                <button wire:click="hideForms" class="text-gray-400 hover:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Content -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Image Section -->
                <div class="md:col-span-1">
                    <div class="relative h-72 w-full rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                        @if($skinKnowledge->image)
                            <img src="{{ asset('storage/' . $skinKnowledge->image) }}" class="w-full h-72 object-cover">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-10 flex items-center justify-center opacity-0 hover:opacity-100 transition duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        @else
                            <div class="h-72 w-full bg-gray-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Details Section -->
                <div class="md:col-span-2 space-y-6">
                    <!-- Characteristics -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-800 flex items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Key Characteristics
                        </h4>
                        @if(is_array($skinKnowledge->characteristics))
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($skinKnowledge->characteristics as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-600">{{ $skinKnowledge->characteristics }}</p>
                        @endif
                    </div>

                    <!-- Best Ingredients -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-800 flex items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-pink-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                            Recommended Ingredients
                        </h4>
                        @if(is_array($skinKnowledge->best_ingredient))
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($skinKnowledge->best_ingredient as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-600">{{ $skinKnowledge->best_ingredient }}</p>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-800 flex items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                            </svg>
                            Detailed Description
                        </h4>
                        <p class="text-gray-600 whitespace-pre-line">{{ $skinKnowledge->description }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="sticky bottom-0 bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex justify-end">
                <button wire:click="hideForms"
                    class="px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
