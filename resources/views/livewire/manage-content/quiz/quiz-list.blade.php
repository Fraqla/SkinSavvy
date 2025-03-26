<div class="flex min-h-screen bg-gray-100">
    {{-- Sidebar --}}
    @livewire('sidebar')

    <div class="p-4 w-full">
        <div class="max-w-7xl mx-auto">
            {{-- Header Section --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Skin Quiz Questions</h1>
                    <p class="text-gray-600 mt-1">Manage questions and answers for your skin assessment quiz</p>
                </div>
                <button wire:click="showAddForm"
                    class="mt-4 sm:mt-0 flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add New Question
                </button>
            </div>

            {{-- Success Message --}}
            @if(session()->has('message'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Quiz Questions Table --}}
            <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Question
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Answer Options
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($quizzes as $quiz)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $quiz->question }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach(json_decode($quiz->answers) as $answer)
                                                <li class="text-sm text-gray-600">{{ $answer }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-center space-x-3">
                                            <button wire:click="showDetails({{ $quiz->id }})"
                                                class="text-green-600 hover:text-green-900 p-1 rounded-full hover:bg-green-50 transition duration-200"
                                                title="View Details">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <button wire:click="showEditForm({{ $quiz->id }})"
                                                class="text-blue-600 hover:text-blue-900 p-1 rounded-full hover:bg-blue-50 transition duration-200"
                                                title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </button>
                                            <button wire:click="showDeleteForm({{ $quiz->id }})"
                                                class="text-red-600 hover:text-red-900 p-1 rounded-full hover:bg-red-50 transition duration-200"
                                                title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <h3 class="mt-2 text-lg font-medium text-gray-900">No quiz questions found</h3>
                                            <p class="mt-1 text-gray-500">Get started by adding your first question</p>
                                            <button wire:click="showAddForm" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                                                Add New Question
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $quizzes->links() }}
            </div>

            {{-- Modals --}}
            @if($isAddFormVisible)
                @include('livewire.manage-content.quiz.quiz-add')
            @endif

            @if($isEditFormVisible)
                @include('livewire.manage-content.quiz.quiz-edit')
            @endif

            @if($isDeleteFormVisible)
                @include('livewire.manage-content.quiz.quiz-delete')
            @endif

            @if($isDetailsModalVisible && $selectedQuiz)
                @include('livewire.manage-content.quiz.quiz-details', ['quiz' => $selectedQuiz])
            @endif
        </div>
    </div>
</div>