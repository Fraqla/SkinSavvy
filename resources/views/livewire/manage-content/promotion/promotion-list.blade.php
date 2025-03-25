<div class="flex h-screen bg-gray-100">
    {{-- Sidebar --}}
    @livewire('sidebar')

    <div class="p-4 w-full">
        <h2 class="text-2xl font-bold mb-6">Manage Promotions</h2>

        <button wire:click="showAddForm" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 mb-6">+ Add New Promotion</button>

        <h3 class="text-lg font-semibold mb-2">Current Promotions</h3>

        <!-- Grid layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($promotions as $promotion)
                <div class="border rounded-lg shadow-md overflow-hidden bg-white">
                    
                    <!-- Promotion Image -->
                    @if($promotion->image)
                        <img src="{{ asset('storage/' . $promotion->image) }}" 
                             class="w-full h-48 object-cover" 
                             alt="Promotion Image">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">No Image Available</div>
                    @endif

                    <!-- Promotion Content -->
                    <div class="p-4">
                        <strong class="text-lg font-bold">{{ $promotion->title }}</strong>
                        <span class="ml-2 text-sm text-gray-600">({{ $promotion->status }})</span>
                        <p class="text-gray-700 mt-2">{{ $promotion->description }}</p>
                        <small class="block mt-2 text-gray-500">Start: {{ $promotion->start_date }} | End: {{ $promotion->end_date }}</small>

                        <!-- Action Buttons -->
                        <div class="flex justify-end mt-4 space-x-2">
                            <button wire:click="edit({{ $promotion->id }})" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</button>
                            <button wire:click="confirmDelete({{ $promotion->id }})" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Add Promotion Form -->
        @if($isAddFormVisible)
            @include('livewire.manage-content.promotion.promotion-add')
        @endif

        <!-- Edit Promotion Form -->
        @if($isEditFormVisible)
            @include('livewire.manage-content.promotion.promotion-edit')
        @endif

        <!-- Delete Confirmation -->
        @if($isDeleteFormVisible)
            @include('livewire.manage-content.promotion.promotion-delete')
        @endif
    </div>
</div>
