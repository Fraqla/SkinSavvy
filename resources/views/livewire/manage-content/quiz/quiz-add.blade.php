<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold">Add New Quiz Question</h3>
                <button wire:click="hideForms" class="text-gray-500 hover:text-gray-700">
                    &times;
                </button>
            </div>

            <form wire:submit.prevent="store">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Question</label>
                        <input type="text" wire:model="question" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('question') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Answer Options</label>
                        <div class="mt-1 space-y-2">
                            <div class="flex space-x-2">
                                <input type="text" wire:model="newAnswer" 
                                       class="flex-1 rounded-md border-gray-300 shadow-sm">
                                <button type="button" wire:click="addAnswer" 
                                        class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                    Add
                                </button>
                            </div>
                            @error('newAnswer') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            
                            <div class="space-y-2 mt-2">
                                @foreach($answers as $index => $answer)
                                <div class="flex items-center space-x-2">
                                    <span class="flex-1 p-2 bg-gray-100 rounded">{{ $answer }}</span>
                                    <button type="button" wire:click="removeAnswer({{ $index }})" 
                                            class="text-red-500 hover:text-red-700">
                                        &times;
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @error('answers') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" wire:click="hideForms" 
                            class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>