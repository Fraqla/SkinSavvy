<div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50 overflow-y-auto">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto transform transition-all duration-300 my-8">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-gradient-to-r from-pink-50 to-purple-50 px-6 py-4 border-b border-gray-200 z-10">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="p-2 rounded-lg bg-white shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Edit Promotion</h2>
                </div>
                <button wire:click="$dispatch('hide-edit-promotion')" class="p-1.5 rounded-full hover:bg-gray-100 text-gray-500 hover:text-gray-700 transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Content -->
        <div class="p-6 space-y-5">
            <form wire:submit.prevent="update" class="space-y-5">
                <!-- Title Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Promotion Title</label>
                    <div class="relative">
                        <input type="text" wire:model="title" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition duration-200 shadow-sm hover:shadow"
                            placeholder="Enter promotion title">
                        @error('title')
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        @enderror
                    </div>
                    @error('title') 
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p> 
                    @enderror
                </div>

                <!-- Description Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <div class="relative">
                        <textarea wire:model="description" rows="4" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition duration-200 shadow-sm hover:shadow"
                            placeholder="Enter promotion details"></textarea>
                        @error('description')
                            <div class="absolute top-3 right-3">
                                <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        @enderror
                    </div>
                    @error('description') 
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p> 
                    @enderror
                </div>

                <!-- Date Range -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                        <div class="relative">
                            <input type="date" wire:model="start_date" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition duration-200 shadow-sm hover:shadow">
                            @error('start_date')
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('start_date') 
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p> 
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                        <div class="relative">
                            <input type="date" wire:model="end_date" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition duration-200 shadow-sm hover:shadow">
                            @error('end_date')
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('end_date') 
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p> 
                        @enderror
                    </div>
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Promotion Image</label>
                    
                    @if($image && !$image instanceof \Livewire\TemporaryUploadedFile)
                        <div class="mb-4 relative group">
                            <img src="{{ asset('storage/' . $image) }}" class="w-full h-48 object-cover rounded-lg shadow-md">
                            <div class="absolute inset-0 bg-black/20 rounded-lg opacity-0 group-hover:opacity-100 transition duration-200 flex items-center justify-center">
                                <span class="text-white font-medium">Current Image</span>
                            </div>
                        </div>
                    @endif
                    
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col w-full h-32 border-2 border-dashed border-gray-300 hover:border-gray-400 rounded-lg cursor-pointer transition duration-200 hover:bg-gray-50">
                            <div class="flex flex-col items-center justify-center pt-7">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="pt-1 text-sm text-gray-500">
                                    {{ $image ? 'Change image' : 'Upload new image (JPEG, PNG)' }}
                                </p>
                            </div>
                            <input type="file" wire:model="image" class="opacity-0 absolute top-0 left-0 w-full h-full cursor-pointer">
                        </label>
                    </div>
                    @error('image') 
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p> 
                    @enderror
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200/60">
                    <button type="button" wire:click="$dispatch('hide-edit-promotion')" 
                        class="px-6 py-2.5 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition duration-200 shadow-sm">
                        Cancel
                    </button>
                    <button type="submit" 
                    class="px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                        Update Promotion
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>