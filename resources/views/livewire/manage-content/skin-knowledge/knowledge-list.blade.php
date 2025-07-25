<div class="flex min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Sidebar -->
    @livewire('sidebar')

    <!-- Main Content -->
    <div class="flex-1 p-6 overflow-auto">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Skin Knowledge Base</h1>
                    <p class="text-gray-500 mt-2">Comprehensive guide to skin types and their characteristics</p>
                </div>
                <button wire:click="showAddForm"
                    class="mt-4 sm:mt-0 flex items-center px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white font-medium rounded-lg shadow-md hover:from-pink-600 hover:to-purple-700 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add New Entry
                </button>
            </div>

            <!-- Success Message -->
            @if(session()->has('message'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-green-500 mr-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="text-green-700">{{ session('message') }}</p>
                    </div>
                </div>
            @endif

            <!-- Skin Knowledge Table -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-pink-50 to-purple-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Preview
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Skin Type
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Key Characteristics
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($skinKnowledges as $skinKnowledge)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div
                                            class="relative h-16 w-16 rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                                            @if($skinKnowledge->image)
                                                <img src="{{ asset('storage/' . $skinKnowledge->image) }}"
                                                    class="h-full w-full object-cover">
                                                <div
                                                    class="absolute inset-0 bg-black bg-opacity-10 flex items-center justify-center opacity-0 hover:opacity-100 transition duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                    </svg>
                                                </div>
                                            @else
                                                <div class="h-full w-full bg-gray-100 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">{{ $skinKnowledge->skin_type }}
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">Last updated
                                            {{ $skinKnowledge->updated_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-600 max-w-md">
                                            @if(is_array($skinKnowledge->characteristics))
                                                <ul class="list-disc pl-5 space-y-1">
                                                    @foreach($skinKnowledge->characteristics as $item)
                                                        <li>{{ $item }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                {{ $skinKnowledge->characteristics }}
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-center space-x-2">
                                            <button wire:click="showDetails({{ $skinKnowledge->id }})"
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
                                            <button wire:click="showEditForm({{ $skinKnowledge->id }})"
                                                class="p-2 text-pink-600 hover:text-pink-800 hover:bg-pink-50 rounded-full transition duration-200"
                                                title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </button>
                                            <button wire:click="showDeleteForm({{ $skinKnowledge->id }})"
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
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                            </svg>
                                            <h3 class="text-xl font-medium text-gray-500">No skin knowledge entries</h3>
                                            <p class="mt-2 text-gray-400">Add your first skin type to get started</p>
                                            <button wire:click="showAddForm"
                                                class="mt-4 px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-lg shadow hover:from-pink-600 hover:to-purple-700 transition duration-300">
                                                Create First Entry
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($skinKnowledges->hasPages())
                <div class="mt-6">
                    {{ $skinKnowledges->links() }}
                </div>
            @endif

            <!-- Modals -->
            @if($isAddFormVisible)
                @include('livewire.manage-content.skin-knowledge.knowledge-add')
            @endif

            @if($isEditFormVisible)
                @include('livewire.manage-content.skin-knowledge.knowledge-edit')
            @endif

            @if($isDeleteFormVisible)
                @include('livewire.manage-content.skin-knowledge.knowledge-delete')
            @endif

            @if($isDetailsModalVisible && $selectedSkinKnowledge)
                @include('livewire.manage-content.skin-knowledge.knowledge-details', ['skinKnowledge' => $selectedSkinKnowledge])
            @endif
        </div>
    </div>
</div>