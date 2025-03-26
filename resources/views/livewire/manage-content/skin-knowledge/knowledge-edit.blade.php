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

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Skin Type Image</label>
                    
                    @if ($tempImage)
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 mb-2">{{ $image ? 'New Image Preview' : 'Current Image' }}</p>
                            <div class="relative w-40 h-40 rounded-lg overflow-hidden border border-gray-200">
                                <img src="{{ $tempImage }}" 
                                     class="w-full h-full object-cover" />
                                <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center opacity-0 hover:opacity-100 transition duration-200">
                                    <span class="text-white text-sm font-medium">{{ $image ? 'New' : 'Current' }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-200">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500">
                                    <span class="font-semibold">Click to upload</span> or drag and drop
                                </p>
                                <p class="text-xs text-gray-500">PNG, JPG (MAX. 5MB)</p>
                            </div>
                            <input type="file" wire:model="image" class="hidden" />
                        </label>
                    </div>
                    @error('image') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <!-- Characteristics -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Characteristics</label>
                    <textarea wire:model="characteristics" rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition duration-200"></textarea>
                    @error('characteristics') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <!-- Best Ingredients -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Best Ingredients</label>
                    <textarea wire:model="best_ingredient" rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition duration-200"></textarea>
                    @error('best_ingredient') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea wire:model="description" rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition duration-200"></textarea>
                    @error('description') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="sticky bottom-0 bg-white pt-4 pb-2 border-t border-gray-200">
                <div class="flex justify-end space-x-3">
                    <button type="button" wire:click="hideForms"
                            class="px-6 py-2.5 border border-gray-300 text-sm font-medium rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                        Update Skin Type
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>