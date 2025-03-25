<div class="flex h-screen bg-gray-100">
    @livewire('sidebar')

    <div class="p-6 bg-gray-100 min-h-screen w-full">
        <h1 class="text-2xl font-bold mb-4">Skin Knowledge List</h1>

        <button wire:click="showAddForm"
            class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow hover:bg-blue-600 transition duration-300 ease-in-out">
            + Add Skin Knowledge
        </button>

        <table class="table-auto w-full mt-4 border-collapse border border-gray-400">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Skin Type</th>
                    <th class="border border-gray-300 px-4 py-2">Characteristics</th>
                    <th class="border border-gray-300 px-4 py-2">Best Ingredients</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($skinKnowledges as $knowledge)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $knowledge->skin_type }}</td>

                    <td class="border border-gray-300 px-4 py-2">
                        @php
                            $characteristics = is_string($knowledge->characteristics)
                                ? json_decode($knowledge->characteristics, true)
                                : (is_array($knowledge->characteristics) ? $knowledge->characteristics : []);
                        @endphp

                        @if (!empty($characteristics))
                            <ul class="list-disc ml-4 space-y-1 text-gray-700">
                                @foreach ($characteristics as $char)
                                    <li>{{ $char }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-500 italic">No characteristics available</span>
                        @endif
                    </td>

                    <td class="border border-gray-300 px-4 py-2">{{ $knowledge->best_ingredient }}</td>

                    <td class="border border-gray-300 px-4 py-2">
                        <button wire:click="showEditForm({{ $knowledge->id }})"
                            class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition duration-200">
                            ✏️ Edit
                        </button>
                        <button wire:click="delete({{ $knowledge->id }})"
                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition duration-200">
                            🗑️ Delete
                        </button>
                        <button wire:click="viewSkinDetails({{ $knowledge->id }})"
                            class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 transition duration-200">
                            🔍 View
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No Skin Knowledge entries yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($isAddFormVisible)
            @include('livewire.manage-content.skin-knowledge.knowledge-add')
        @endif

        @if($isEditFormVisible)
            @include('livewire.manage-content.skin-knowledge.knowledge-edit')
        @endif

        @if($showSkinDetails)
            @include('livewire.manage-content.skin-knowledge.knowledge-details')
        @endif
    </div>
</div>
