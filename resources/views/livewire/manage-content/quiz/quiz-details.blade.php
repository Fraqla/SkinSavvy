<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-bold text-gray-800">{{ $quiz->question }}</h3>
                <button wire:click="$set('isDetailsModalVisible', false)" class="text-gray-500 hover:text-gray-700 text-2xl">
                    &times;
                </button>
            </div>

            <div class="space-y-4">
                <div>
                    <h4 class="text-lg font-semibold text-gray-700 mb-2">Answer Options</h4>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach(json_decode($quiz->answers) as $answer)
                            <li class="text-gray-600">{{ $answer }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-gray-200 flex justify-end">
                <button wire:click="$set('isDetailsModalVisible', false)" 
                        class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>