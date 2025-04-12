<div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50 overflow-y-auto">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto transform transition-all duration-300 my-8">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-gradient-to-r from-pink-50 to-purple-50 px-6 py-4 border-b border-gray-200 z-10">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Skin Knowledge
                </h2>
                <button wire:click="hideForms" class="text-gray-400 hover:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Content -->
        <form wire:submit.prevent="store" enctype="multipart/form-data" class="p-6 space-y-6">
            <div class="grid grid-cols-1 gap-6">
                
                <!-- Skin Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Skin Type</label>
                    <input type="text" wire:model="skin_type" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition duration-200" required />
                    @error('skin_type') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <!-- Characteristics -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Characteristics</label>

                    <!-- Add Characteristic Input -->
                    <div class="flex space-x-3">
                        <div class="flex-1 relative">
                            <input type="text" wire:model="newCharacteristic"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition duration-200 shadow-sm"
                                placeholder="Add new characteristic">
                            @error('newCharacteristic')
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        <button type="button" wire:click="addCharacteristic"
                            class="px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                            Add
                        </button>
                    </div>
                    @error('newCharacteristic')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- Current Characteristics List -->
                    <div class="mt-4 space-y-3">
                        @foreach($characteristics as $index => $item)
                            <div class="flex items-center space-x-3 group">
                                <span
                                    class="flex-1 px-4 py-2.5 bg-gray-50 rounded-lg border border-gray-200 group-hover:bg-white group-hover:border-purple-200 transition duration-200">{{ $item }}</span>
                                <button type="button" wire:click="removeCharacteristic({{ $index }})"
                                    class="p-2 text-gray-400 hover:text-red-500 rounded-full hover:bg-red-50 transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    @error('characteristics')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Best Ingredients -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Best Ingredients</label>

                    <!-- Add Ingredient Input -->
                    <div class="flex space-x-3">
                        <div class="flex-1 relative">
                            <input type="text" wire:model="newIngredient"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition duration-200 shadow-sm"
                                placeholder="Add new ingredient">
                            @error('newIngredient')
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        <button type="button" wire:click="addIngredient"
                            class="px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                            Add
                        </button>
                    </div>
                    @error('newIngredient')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- Current Ingredients List -->
                    <div class="mt-4 space-y-3">
                        @foreach($best_ingredient as $index => $item)
                            <div class="flex items-center space-x-3 group">
                                <span
                                    class="flex-1 px-4 py-2.5 bg-gray-50 rounded-lg border border-gray-200 group-hover:bg-white group-hover:border-purple-200 transition duration-200">{{ $item }}</span>
                                <button type="button" wire:click="removeIngredient({{ $index }})"
                                    class="p-2 text-gray-400 hover:text-red-500 rounded-full hover:bg-red-50 transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    @error('bestIngredients')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-between items-center mt-6">
                <button type="button" wire:click="hideForms" class="text-gray-500 hover:text-gray-700 text-sm">
                    Cancel
                </button>
                <button type="submit"
                    class="px-6 py-3 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
