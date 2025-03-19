<div class="flex h-screen bg-gray-100">
    @livewire('sidebar')

    <div class="p-6 bg-gray-100 min-h-screen w-full">
        <h1 class="text-2xl font-bold mb-6">Manage Products</h1>

        <!-- Top Controls: Add Product Button -->
        <div class="flex justify-between items-center mb-4">
            <button wire:click="showAddProductForm"
                class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow hover:bg-blue-600 transition duration-300 ease-in-out">
                + Add Product
            </button>
        </div>

        <!-- Product List Table -->
        <div class="overflow-hidden rounded-lg shadow bg-white">
            <table class="table-auto w-full text-left border-collapse">
                <thead class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                    <tr>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @forelse($products as $product)
                        <tr class="border-t hover:bg-gray-100 transition">
                            <td class="px-4 py-2">{{ $product->name }}</td>
                            <td class="px-4 py-2">{{ $product->category->name }}</td>
                            <td class="px-4 py-2 text-center flex justify-center gap-2">
                                <button wire:click="showEditProductForm({{ $product->id }})"
                                    class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition duration-200">
                                    ✏️ Edit
                                </button>
                                <button wire:click="confirmDeletion({{ $product->id }})"
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition duration-200">
                                    🗑️ Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center text-gray-500">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Success Message -->
        @if (session()->has('success'))
            <div class="mt-4 p-2 bg-green-500 text-white rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        <!-- Include Add & Edit Product Forms -->
        @if($showAddForm)
            @include('livewire.manage-product.product-add')
        @endif

        @if($showEditForm)
            @include('livewire.manage-product.product-edit')
        @endif

        @if($confirmingProductDeletion)
            @include('livewire.manage-product.product-delete')
        @endif
    </div>
</div>