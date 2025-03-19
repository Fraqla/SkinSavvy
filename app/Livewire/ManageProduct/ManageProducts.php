<?php

namespace App\Livewire\ManageProduct;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Category;

class ManageProducts extends Component
{
    use WithFileUploads;

    public $products, $categories, $name, $category_id, $description, $image, $productId, $ingredient;
    public $showAddForm = false;
    public $showEditForm = false;
    public $confirmingProductDeletion = false;
    public $productIdToDelete = null;



    public function mount()
    {
        $this->products = Product::all();
        $this->categories = Category::all();
    }

    public function resetFields()
    {
        $this->name = '';
        $this->category_id = '';
        $this->description = '';
        $this->image = '';
        $this->ingredient = '';
        $this->showAddForm = false;
        $this->showEditForm = false;
    }

    // Show Add Form
    public function showAddProductForm()
    {
        $this->resetFields();
        $this->isEditing = false;
        $this->showAddForm = true;
    }

    // Add Product
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:1024',
            'ingredient' => 'nullable|string',
        ]);

        $imagePath = $this->image ? $this->image->store('products', 'public') : null;

        Product::create([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'ingredient' => $this->ingredient,
            'image' => $imagePath,
        ]);

        session()->flash('success', 'Product added successfully!');
        $this->resetFields();
        $this->mount();
    }

    // Show Edit Form
    public function showEditProductForm($id)
    {
        $product = Product::findOrFail($id);
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->category_id = $product->category_id;
        $this->description = $product->description;
        $this->ingredient = $product->ingredient;
        $this->showEditForm = true;
    }
    // Update Product
    public function update()
    {
        $product = Product::find($this->productId);

        $product->update([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'ingredient' => $this->ingredient,
        ]);

        session()->flash('success', 'Product updated successfully!');
        $this->resetFields();
        $this->mount();
    }

    // Delete Product
    public function confirmDeletion($id)
{
    $this->productIdToDelete = $id;
    $this->confirmingProductDeletion = true;
    $this->dispatch('refresh'); // Force refresh!
}


public function deleteProduct()
{
    if ($this->productIdToDelete) {
        Product::destroy($this->productIdToDelete);

        session()->flash('success', 'Product deleted successfully!');
        $this->reset(['confirmingProductDeletion', 'productIdToDelete']);
        $this->mount();  // Refresh products
    }
}


public function render()
{
    return view('livewire.manage-product.product-list', [
        'products' => Product::all(),
    ]);
}


}
