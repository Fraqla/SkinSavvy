<div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50 transition-opacity duration-300 overflow-y-auto">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto transform transition-all duration-300 my-8">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-gradient-to-r from-pink-50 to-purple-50 px-6 py-4 border-b border-gray-200 z-10">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="p-2 rounded-lg bg-white shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Add New Quiz Question</h3>
                </div>
                <button wire:click="hideForms" class="p-1.5 rounded-full hover:bg-gray-100 text-gray-500 hover:text-gray-700 transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Content -->
        <div class="p-6 space-y-6">
            <form wire:submit.prevent="store">
                <div class="space-y-6">
                    <!-- Question Field -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Question</label>
                        <div class="relative">
                            <input type="text" wire:model="question" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition duration-200 shadow-sm hover:shadow"
                                placeholder="Enter your question here">
                            @error('question')
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('question') 
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p> 
                        @enderror
                    </div>

                    <!-- Answer Options -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Answer Options</label>
                        
                        <!-- Add Answer Input -->
                        <div class="flex space-x-3">
                            <div class="flex-1 relative">
                                <input type="text" wire:model="newAnswer" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition duration-200 shadow-sm"
                                    placeholder="Add new answer option">
                                @error('newAnswer')
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                @enderror
                            </div>
                            <button type="button" wire:click="addAnswer"
                            class="px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                                Add
                            </button>
                        </div>
                        @error('newAnswer') 
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p> 
                        @enderror

                        <!-- Current Answers List -->
                        <div class="mt-4 space-y-3">
                            @foreach($answers as $index => $answer)
                                <div class="flex items-center space-x-3 group">
                                    <span class="flex-1 px-4 py-2.5 bg-gray-50 rounded-lg border border-gray-200 group-hover:bg-white group-hover:border-blue-200 transition duration-200">{{ $answer }}</span>
                                    <button type="button" wire:click="removeAnswer({{ $index }})"
                                        class="p-2 text-gray-400 hover:text-red-500 rounded-full hover:bg-red-50 transition duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        @error('answers') 
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p> 
                        @enderror
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="mt-8 flex justify-end space-x-3">
                    <button type="button" wire:click="hideForms" 
                        class="px-6 py-3 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 shadow-sm">
                        Cancel
                    </button>
                    <button type="submit" 
                    class="px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                        Save Question
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>