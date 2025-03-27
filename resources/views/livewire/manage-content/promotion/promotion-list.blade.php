<div class="flex min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Sidebar -->
    @livewire('sidebar')

    <!-- Main Content -->
    <div class="flex-1 p-6 overflow-auto">
        <div class="max-w-7xl mx-auto">
            {{-- Header Section --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Manage Promotions</h2>
                    <p class="text-gray-600 mt-1">Create and manage special offers for your customers</p>
                </div>
                <button wire:click="showAddForm"
                class="mt-4 sm:mt-0 flex items-center px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white font-medium rounded-lg shadow-md hover:from-pink-600 hover:to-purple-700 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add New Promotion
                </button>
            </div>

            {{-- Current Promotions Section --}}
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    Current Promotions
                </h3>

                {{-- Promotions Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($promotions as $promotion)
                        <div
                            class="border border-gray-200 rounded-lg shadow-sm overflow-hidden bg-white hover:shadow-md transition duration-200">
                            {{-- Promotion Image --}}
                            <div class="relative">
                                @if($promotion->image)
                                    <img src="{{ asset('storage/' . $promotion->image) }}" class="w-full h-48 object-cover"
                                        alt="{{ $promotion->title }}">
                                @else
                                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <span
                                    class="absolute top-2 right-2 px-2 py-1 text-xs font-semibold rounded-full 
                                        {{ $promotion->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($promotion->status) }}
                                </span>
                            </div>

                            {{-- Promotion Content --}}
                            <div class="p-4">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-lg font-bold text-gray-800">{{ $promotion->title }}</h3>
                                </div>
                                <p class="text-gray-600 mt-2 line-clamp-2">{{ $promotion->description }}</p>

                                <div class="mt-3 flex items-center text-sm text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ date('M d, Y', strtotime($promotion->start_date)) }} -
                                        {{ date('M d, Y', strtotime($promotion->end_date)) }}</span>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="flex justify-end mt-4 space-x-2">
                                    <button wire:click="edit({{ $promotion->id }})"
                                    class="p-2 text-pink-600 hover:text-pink-800 hover:bg-pink-50 rounded-full transition duration-200"
                                                title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </button>
                                    <button wire:click="confirmDelete({{ $promotion->id }})"
                                    class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-full transition duration-200"
                                                title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center bg-white rounded-lg shadow-sm border border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">No promotions found</h3>
                            <p class="mt-1 text-gray-500">Get started by creating a new promotion</p>
                            <button wire:click="showAddForm"
                                class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                                Add New Promotion
                            </button>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Modals --}}
        @if($isAddFormVisible)
            @include('livewire.manage-content.promotion.promotion-add')
        @endif

        @if($isEditFormVisible)
            @include('livewire.manage-content.promotion.promotion-edit')
        @endif

        @if($isDeleteFormVisible)
            @include('livewire.manage-content.promotion.promotion-delete')
        @endif
    </div>
</div>