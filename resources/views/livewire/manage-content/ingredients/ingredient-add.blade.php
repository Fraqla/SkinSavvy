<div
    class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50 transition-opacity duration-300 overflow-y-auto">
    <div
        class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto transform transition-all duration-300 my-8">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-gradient-to-r from-pink-50 to-purple-50 px-6 py-4 border-b border-gray-200 z-10">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="p-2 rounded-lg bg-white shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Add New Ingredient</h3>
                </div>
                <button wire:click="hideForms"
                    class="p-1.5 rounded-full hover:bg-gray-100 text-gray-500 hover:text-gray-700 transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Content -->
        <div class="p-6 space-y-6">
            <form wire:submit.prevent="store" enctype="multipart/form-data">
                <class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Ingredient Name -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ingredient Name</label>
                        <div class="relative">
                            <input type="text" wire:model="ingredient_name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition duration-200 shadow-sm hover:shadow"
                                placeholder="e.g. Hyaluronic Acid">
                            @error('ingredient_name')
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('ingredient_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                        <div class="relative">
                            <div class="flex items-center justify-center w-full">
                                <label
                                    class="flex flex-col w-full h-32 border-2 border-dashed border-gray-300 hover:border-gray-400 rounded-lg cursor-pointer transition duration-200 hover:bg-gray-50">
                                    <div class="flex flex-col items-center justify-center pt-7">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="pt-1 text-sm text-gray-500">
                                            {{ $image ? $image->getClientOriginalName() : 'Click to upload image' }}
                                        </p>
                                    </div>
                                    <input type="file" wire:model="image"
                                        class="opacity-0 absolute top-0 left-0 w-full h-full cursor-pointer">
                                </label>
                            </div>
                            @error('image')
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        @if($tempImage)
                            <div class="mt-4">
                                <div class="relative group">
                                    <img src="{{ $tempImage }}" class="h-40 w-full object-cover rounded-lg shadow-md">
                                    <div
                                        class="absolute inset-0 bg-black/20 rounded-lg opacity-0 group-hover:opacity-100 transition duration-200 flex items-center justify-center">
                                        <span class="text-white font-medium">Image Preview</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Function -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Function</label>
                        <div class="relative">
                            <textarea wire:model="function" rows="4" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition duration-200 shadow-sm hover:shadow"
                                placeholder="Describe the ingredient's primary function"></textarea>
                            @error('function')
                                <div class="absolute top-3 right-3">
                                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('function')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Facts -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Facts</label>

                        <!-- Add Facts Input -->
                        <div class="flex space-x-3">
                            <div class="flex-1 relative">
                                <input type="text" wire:model="newFact"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition duration-200 shadow-sm"
                                    placeholder="Add new facts">
                                @error('newFact')
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @enderror
                            </div>
                            <button type="button" wire:click="addFact"
                                class="px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                                Add
                            </button>
                        </div>
                        @error('newFact')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Current Facts List -->
                        <div class="mt-4 space-y-3">
                            @foreach($facts as $index => $ingredient)
                                <div class="flex items-center space-x-3 group">
                                    <span
                                        class="flex-1 px-4 py-2.5 bg-gray-50 rounded-lg border border-gray-200 group-hover:bg-white group-hover:border-purple-200 transition duration-200">{{ $ingredient }}</span>
                                    <button type="button" wire:click="removeFact({{ $index }})"
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
                        @error('facts')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                        


                    <!-- Benefits -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Benefits</label>

                        <!-- Add Benefits Input -->
                        <div class="flex space-x-3">
                            <div class="flex-1 relative">
                                <input type="text" wire:model="newBenefit"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition duration-200 shadow-sm"
                                    placeholder="Add new ibenefit">
                                @error('newBenefit')
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @enderror
                            </div>
                            <button type="button" wire:click="addBenefit"
                                class="px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                                Add
                            </button>
                        </div>
                        @error('newBenefit')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Current Benefits List -->
                        <div class="mt-4 space-y-3">
                            @foreach($benefits as $index => $ingredient)
                                <div class="flex items-center space-x-3 group">
                                    <span
                                        class="flex-1 px-4 py-2.5 bg-gray-50 rounded-lg border border-gray-200 group-hover:bg-white group-hover:border-purple-200 transition duration-200">{{ $ingredient }}</span>
                                    <button type="button" wire:click="removeBenefit({{ $index }})"
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
                        @error('benefits')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Modal Footer -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <button type="button" wire:click="hideForms"
                            class="px-6 py-3 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 shadow-sm">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                            Save Ingredient
                        </button>
                    </div>
                    </class>
            </form>
        </div>
    </div>
</div>