<div class="flex min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Sidebar -->
    @livewire('sidebar')

    <!-- Main Content -->
    <div class="flex-1 p-6 overflow-auto">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manage Categories</h1>
                <p class="text-gray-500 text-sm mt-1">Organize your product categories</p>
            </div>
            <button wire:click="showAddCategoryForm"
                class="px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-500 text-white font-semibold rounded-lg shadow-lg hover:from-pink-600 hover:to-purple-600 transition duration-300 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                Add Category
            </button>
        </div>

        <!-- Search and Bulk Actions -->
        <div class="bg-white p-6 rounded-xl shadow-sm mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex flex-col sm:flex-row gap-3 w-full">
                    <select wire:model="searchBy" 
                            class="p-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 text-gray-700">
                        <option value="name">Name</option>
                    </select>
                    
                    <div class="relative flex-grow">
                        <input type="text" wire:model.defer="search" placeholder="Search categories..."
                            class="w-full p-2.5 pl-10 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-400 placeholder-gray-400">
                        <svg class="absolute left-3 top-3 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    
                    <div class="flex gap-2">
                        <button wire:click="performSearch" 
                                class="px-4 py-2.5 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition flex items-center gap-1">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Search
                        </button>
                        <button wire:click="resetSearch" 
                                class="px-4 py-2.5 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
                            Reset
                        </button>
                    </div>
                </div>
            </div>

            <!-- Bulk Delete Button -->
            @if(count($selectedCategories))
                <div class="mt-4">
                    <button wire:click="deleteSelected"
                        class="px-4 py-2.5 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-lg shadow hover:from-red-600 hover:to-pink-600 transition flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        Delete Selected ({{ count($selectedCategories) }})
                    </button>
                </div>
            @endif
        </div>

        <!-- Category Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-pink-50 to-purple-50 text-gray-700 uppercase text-xs font-semibold">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left">Category Name</th>
                        <th scope="col" class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-pink-100 to-purple-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex justify-end space-x-2">
                                    <button wire:click="showEditCategoryForm({{ $category->id }})"
                                    class="p-2 text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                    </svg>
                                </button>
                                    <button wire:click="confirmDeletion({{ $category->id }})"
                                    class="p-2 text-red-600 hover:text-red-900 hover:bg-red-50 rounded-lg transition" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-lg font-medium text-gray-500">No categories found</p>
                                    <p class="text-sm mt-1">Add your first category to get started</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $categories->links() }}
        </div>

        <!-- Success Notification -->
        @if (session()->has('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                class="fixed bottom-4 right-4 p-4 bg-green-500 text-white rounded-lg shadow-lg flex items-center space-x-2 animate-fade-in-up">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Include Modals -->
        @if($showAddForm)
            @include('livewire.manage-category.category-add')
        @endif

        @if($showEditForm)
            @include('livewire.manage-category.category-edit')
        @endif

        @if($confirmingDeletion)
            @include('livewire.manage-category.category-delete')
        @endif
    </div>
</div>