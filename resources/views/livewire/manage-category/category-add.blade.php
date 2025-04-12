<div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all duration-300">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-pink-50 to-purple-50 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                    Add New Category
                </h2>
                <button wire:click="cancel" class="text-gray-400 hover:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Content -->
        <div class="p-6">
            <div class="space-y-4">
                <div>
                    <label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                    <input type="text" wire:model="name" id="categoryName" placeholder="e.g. Skincare Essentials"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition duration-200">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="px-6 pb-6 space-y-2">
    <label for="categoryImage" class="block text-sm font-medium text-gray-700">Category Image</label>
    
    <div class="flex items-center space-x-4">
        <input type="file" wire:model="image" id="categoryImage"
            class="w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-gradient-to-r file:from-pink-500 file:to-purple-500 file:text-white
            hover:file:from-pink-600 hover:file:to-purple-600
            transition duration-200 cursor-pointer" />
    </div>

    @error('image') 
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror

    @if ($image)
        <div class="mt-3">
            <p class="text-sm text-gray-500 mb-1">Preview:</p>
            <img src="{{ $image->temporaryUrl() }}" alt="Preview"
                class="w-32 h-32 object-cover rounded-lg border border-gray-300 shadow-sm">
        </div>
    @endif
</div>



        <!-- Modal Footer -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
            <button type="button" wire:click="cancel"
                class="px-6 py-2 border border-gray-300 text-sm font-medium rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                Cancel
            </button>
            <button wire:click="store"
                class="px-6 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                Save Category
            </button>
        </div>
    </div>
</div>