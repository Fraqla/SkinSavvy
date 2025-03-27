<div class="flex min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Sidebar -->
    @livewire('sidebar')

    <!-- Main Content -->
    <div class="flex-1 p-6 overflow-auto">
        <div class="max-w-7xl mx-auto">
            {{-- Header Section --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div class="space-y-2">
                    <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Skincare Tips</h1>
                    <p class="text-lg text-gray-600 font-medium">Create and organize beauty tips for your community</p>
                </div>
                <button wire:click="showAddForm"
                class="mt-4 sm:mt-0 flex items-center px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white font-medium rounded-lg shadow-md hover:from-pink-600 hover:to-purple-700 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    <span>Add New Tip</span>
                </button>
            </div>

            {{-- Success Message --}}
            @if (session()->has('message'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 mb-8 rounded-lg shadow-inner animate-fade-in">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-emerald-800">{{ session('message') }}</p>
                        </div>
                        <div class="ml-auto pl-3">
                            <button onclick="this.parentElement.parentElement.parentElement.remove()"
                                class="text-emerald-500 hover:text-emerald-700">
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Tips List --}}
            <div class="space-y-6">
                @forelse ($tips as $tip)
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-200/60 hover:shadow-md transition duration-300 overflow-hidden">
                        <div class="flex flex-col md:flex-row h-full">
                            {{-- Tip Image --}}
                            <div class="w-full md:w-64 h-64 flex-shrink-0 relative group">
                                @if($tip->image)
                                    <img src="{{ asset('storage/' . $tip->image) }}" alt="{{ $tip->title }}"
                                        class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center text-gray-400">
                                        <div class="text-center p-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="mt-2 text-sm">No image</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Tip Content --}}
                            <div class="flex-1 p-6 flex flex-col">
                                <div class="flex-1">
                                    <h2 class="text-xl font-bold text-gray-800 mb-3">{{ $tip->title }}</h2>
                                    <div class="prose prose-indigo max-w-none text-gray-600">
                                        {!! $tip->description !!}
                                    </div>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="flex justify-end space-x-3 mt-6">
                                    <button wire:click="showDetails({{ $tip->id }})"
                                        class="p-2 text-purple-600 hover:text-purple-800 hover:bg-purple-50 rounded-full transition duration-200"
                                        title="View Details">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <button wire:click="showEditForm({{ $tip->id }})"
                                        class="p-2 text-pink-600 hover:text-pink-800 hover:bg-pink-50 rounded-full transition duration-200"
                                        title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $tip->id }})"
                                        class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-full transition duration-200"
                                        title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center bg-white rounded-xl shadow-sm border border-gray-200/60 py-16 px-6">
                        <div class="p-4 bg-blue-50 rounded-full inline-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-800">No tips yet</h3>
                        <p class="mt-2 text-gray-500 max-w-md mx-auto">Create your first skincare tip to help users improve
                            their routine</p>
                        <button wire:click="showAddForm"
                            class="mt-6 inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transition duration-200">
                            Create First Tip
                        </button>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($tips->hasPages())
                <div class="mt-6">
                    {{ $tips->links() }}
                </div>
            @endif
        </div>

        {{-- Modals --}}
        @if($isAddFormVisible)
            @include('livewire.manage-content.tips.tips-add')
        @endif
        @if($isEditFormVisible)
            @include('livewire.manage-content.tips.tips-edit')
        @endif
        @if($isDeleteFormVisible)
            @include('livewire.manage-content.tips.tips-delete')
        @endif
        @if($isDetailsModalVisible)
            @include('livewire.manage-content.tips.tips-details')
        @endif
    </div>
</div>