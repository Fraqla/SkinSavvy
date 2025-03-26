<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="p-6">
            <h3 class="text-lg font-bold mb-4">Edit Tip</h3>

            <form wire:submit.prevent="save">
                <div class="space-y-4">
                    <div>
                        <label for="editTitle" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" wire:model="title" id="editTitle"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="editImage" class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" wire:model="image" id="editImage"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                        @if($existingImage)
                            <div class="mt-2">
                                <span class="text-sm text-gray-500">Current Image:</span>
                                <img src="{{ asset('storage/' . $existingImage) }}" class="h-20 w-20 object-cover mt-1">
                                <button type="button" wire:click="$set('existingImage', null)"
                                    class="mt-1 text-xs text-red-500 hover:text-red-700">
                                    Remove Image
                                </button>
                            </div>
                        @endif
                    </div>

                    <div>
                        <label for="editDescription" class="block text-sm font-medium text-gray-700">Description</label>
                        <input type="text" wire:model="description" id="editDescription"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" wire:click="hideEditForm"
                        class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>