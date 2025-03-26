<div class="flex min-h-screen bg-gray-100">
    {{-- Sidebar --}}
    @livewire('sidebar')

    <div class="p-4 w-full">
        <div class="max-w-6xl mx-auto">
            {{-- Header Section --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Tips Management</h1>
                    <p class="text-gray-600 mt-1">Create and organize skincare tips for your users</p>
                </div>
                <button wire:click="showAddForm"
                    class="mt-4 sm:mt-0 flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add New Tip
                </button>
            </div>

            {{-- Success Message --}}
            @if (session()->has('message'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg shadow-sm">
                    <div class="flex items-center">
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

            {{-- Tips List --}}
            <div class="space-y-4">
                @forelse ($tips as $tip)
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200 hover:shadow-md transition duration-200">
                        <div class="flex flex-col md:flex-row">
                            {{-- Tip Image --}}
                            <div class="w-full md:w-48 h-48 flex-shrink-0 relative">
                                @if($tip->image)
                                    <img src="{{ asset('storage/' . $tip->image) }}" alt="{{ $tip->title }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Tip Content --}}
                            <div class="flex-1 p-4 flex flex-col">
                                <div class="flex-1">
                                    <h2 class="text-xl font-semibold text-gray-800">{{ $tip->title }}</h2>
                                    <div class="prose max-w-none text-gray-600 mt-2">
                                        {!! $tip->description !!}
                                    </div>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="flex justify-end space-x-2 mt-4">
                                    <button wire:click="showEditForm({{ $tip->id }})"
                                        class="flex items-center text-blue-600 hover:text-blue-800 p-2 rounded-full hover:bg-blue-50 transition duration-200"
                                        title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $tip->id }})"
                                        class="flex items-center text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-red-50 transition duration-200"
                                        title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center bg-white rounded-lg shadow-sm border border-gray-200 py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">No tips found</h3>
                        <p class="mt-1 text-gray-500">Get started by creating your first tip</p>
                        <button wire:click="showAddForm" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                            Add New Tip
                        </button>
                    </div>
                @endforelse
            </div>
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
    </div>
</div>