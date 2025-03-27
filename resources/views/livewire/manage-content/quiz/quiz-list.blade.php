<div class="flex min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Sidebar -->
    @livewire('sidebar')

    <!-- Main Content -->
    <div class="flex-1 p-6 overflow-auto">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Skin Assessment Quiz</h1>
                    <p class="text-gray-500 mt-2">Manage your diagnostic questions and answers</p>
                </div>
                <button wire:click="showAddForm"
                class="mt-4 sm:mt-0 flex items-center px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white font-medium rounded-lg shadow-md hover:from-pink-600 hover:to-purple-700 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    <span>Add New Question</span>
                </button>
            </div>

            {{-- Success Message --}}
            @if(session()->has('message'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 mb-8 rounded-lg shadow-inner animate-fade-in">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-emerald-800">{{ session('message') }}</p>
                        </div>
                        <div class="ml-auto pl-3">
                            <button onclick="this.parentElement.parentElement.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Quiz Questions Table --}}
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-pink-50 to-purple-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Question
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Answer Options
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($quizzes as $quiz)
                                <tr class="hover:bg-gray-50/50 transition duration-150 ease-in-out">
                                    <td class="px-8 py-5">
                                        <div class="text-base font-medium text-gray-900">{{ $quiz->question }}</div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <ul class="space-y-2">
                                            @foreach(json_decode($quiz->answers) as $answer)
                                                <li class="flex items-start">
                                                    <span class="flex items-center justify-center h-5 w-5 bg-blue-100 text-blue-800 rounded-full mr-2 mt-0.5 flex-shrink-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                    <span class="text-sm text-gray-700">{{ $answer }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-center space-x-2">
                                            <button wire:click="showDetails({{ $quiz->id }})"
                                            class="p-2 text-purple-600 hover:text-purple-800 hover:bg-purple-50 rounded-full transition duration-200"
                                                title="View Details">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <button wire:click="showEditForm({{ $quiz->id }})"
                                            class="p-2 text-pink-600 hover:text-pink-800 hover:bg-pink-50 rounded-full transition duration-200"
                                                title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </button>
                                            <button wire:click="showDeleteForm({{ $quiz->id }})"
                                            class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-full transition duration-200"
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
                                    <td colspan="3" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center space-y-4">
                                            <div class="p-4 bg-indigo-50 rounded-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <h3 class="text-xl font-semibold text-gray-800">No quiz questions yet</h3>
                                            <p class="text-gray-500 max-w-md text-center">Create your first skin assessment question to help users understand their skin type and concerns.</p>
                                            <button wire:click="showAddForm" class="mt-2 inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transition duration-200">
                                                Add Your First Question
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
            @if($quizzes->hasPages())
                <div class="mt-8 px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 bg-white rounded-b-xl shadow-sm">
                    {{ $quizzes->links('vendor.pagination.tailwind') }}
                </div>
            @endif

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