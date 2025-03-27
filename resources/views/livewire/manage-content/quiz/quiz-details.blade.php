<div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50 transition-opacity duration-300">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto transform transition-all duration-300">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-gradient-to-r from-pink-50 to-purple-50 px-6 py-4 border-b border-gray-200 z-10">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl font-bold text-gray-800">{{ $quiz->question }}</h3>
                
            <button wire:click="$set('isDetailsModalVisible', false)" class="text-gray-400 hover:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="p-6">
                <div>
                    <h4 class="text-lg font-semibold text-gray-700 mb-2">Answer Options</h4>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach(json_decode($quiz->answers) as $answer)
                            <li class="text-gray-600">{{ $answer }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="sticky bottom-0 bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex justify-end">
                <button wire:click="$set('isDetailsModalVisible', false)" 
                class="px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                    Close
                </button>
            </div>
            </div>
        </div>
    </div>
</div>