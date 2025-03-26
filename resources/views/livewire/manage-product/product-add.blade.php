<!-- Add Product Modal -->
<div x-show="open" x-cloak class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50 overflow-y-auto">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto my-8 transform transition-all duration-300">
        <!-- Modal Header (Sticky) -->
        <div class="sticky top-0 bg-gradient-to-r from-pink-50 to-purple-50 px-6 py-4 border-b border-gray-200 z-10">
            <div class="flex items-center justify-between">
                <h2 class="text-xl md:text-2xl font-semibold text-gray-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 mr-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add New Product
                </h2>
                <button wire:click="cancel" class="text-gray-400 hover:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Content -->
        <form wire:submit.prevent="store" enctype="multipart/form-data" class="p-4 md:p-6 space-y-4 md:space-y-6">
            <div class="grid grid-cols-1 gap-4 md:gap-6">
                <!-- Product Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                    <input type="text" wire:model="name" id="name" placeholder="e.g. Hydrating Facial Serum"
                        class="w-full px-3 py-2 md:px-4 md:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition duration-200 text-sm md:text-base" required />
                </div>

                <!-- Category Dropdown -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select wire:model="category_id" id="category"
                        class="w-full px-3 py-2 md:px-4 md:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition duration-200 text-sm md:text-base" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Key Ingredient -->
                <div>
                    <label for="ingredient" class="block text-sm font-medium text-gray-700 mb-1">Key Ingredient</label>
                    <input type="text" wire:model="ingredient" id="ingredient" placeholder="e.g. Hyaluronic Acid"
                        class="w-full px-3 py-2 md:px-4 md:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition duration-200 text-sm md:text-base" />
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="image" class="flex flex-col items-center justify-center w-full h-28 md:h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-200">
                            <div class="flex flex-col items-center justify-center pt-4 pb-5 md:pt-5 md:pb-6 px-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-8 md:w-8 text-gray-400 mb-1 md:mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="mb-1 text-xs md:text-sm text-gray-500 text-center">
                                    <span class="font-semibold">Click to upload</span> or drag and drop
                                </p>
                                <p class="text-[10px] md:text-xs text-gray-500">PNG, JPG (MAX. 5MB)</p>
                            </div>
                            <input id="image" type="file" wire:model="image" class="hidden" />
                        </label>
                    </div>
                    @error('image') <span class="text-xs md:text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea wire:model="description" id="description" rows="3" placeholder="Describe the product benefits and features..."
                        class="w-full px-3 py-2 md:px-4 md:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition duration-200 text-sm md:text-base"></textarea>
                </div>
            </div>

            <!-- Modal Footer (Sticky) -->
            <div class="sticky bottom-0 bg-white pt-3 pb-2 border-t border-gray-200 -mx-4 md:-mx-6 px-4 md:px-6">
                <div class="flex justify-end space-x-2 md:space-x-3">
                    <button type="button" wire:click="cancel"
                        class="px-4 py-2 md:px-6 md:py-2.5 border border-gray-300 text-xs md:text-sm font-medium rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 md:px-6 md:py-2.5 border border-transparent text-xs md:text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                        Save Product
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>