<?php

namespace App\Livewire\ManageProduct;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Category;

class ManageProducts extends Component
{
    use WithFileUploads;

    public $products, $categories, $name, $category_id, $description, $image, $productId, $ingredient, $existingImage, $positive, $negative;
    public $showAddForm = false;
    public $showEditForm = false;
    public $confirmingProductDeletion = false;
    public $productIdToDelete = null;
    public $search = '';
    public $searchBy = 'name';
    public $showProductDetails = false;
    public $productDetails = [];
    public $selectedCategory = '';
    public $newPositiveAspect = '';
    public $newNegativeAspect = '';
    public $positiveAspects = [];
    public $negativeAspects = [];
    public $editedPositiveAspect = '';
    public $editedNegativeAspect = '';
    public $editingPositiveIndex = null;
    public $editingNegativeIndex = null;



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
        $this->positive = '';
        $this->negative = '';
        $this->showAddForm = false;
        $this->showEditForm = false;
        $this->editedPositiveAspect = '';
        $this->editedNegativeAspect = '';
        $this->editingPositiveIndex = null;
        $this->editingNegativeIndex = null;
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
            'positiveAspects' => 'required|array',
            'negativeAspects' => 'required|array',
        ]);
        $imagePath = $this->image ? $this->image->store('products', 'public') : null;


        Product::create([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'ingredient' => $this->ingredient,
            'image' => $imagePath,
            'positive' => json_encode($this->positiveAspects),
            'negative' => json_encode($this->negativeAspects),
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
        $this->positiveAspects = json_decode($product->positive, true);
        $this->negativeAspects = json_decode($product->negative, true);
        $this->existingImage = $product->image;
        $this->showEditForm = true;
    }
    // Update Product
    public function update()
    {
        $product = Product::find($this->productId);

        // Validate the input fields, excluding the image field
        $this->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'ingredient' => 'nullable|string',
            'positiveAspects' => 'required|array',
            'negativeAspects' => 'required|array',
            'image' => 'nullable|image|max:1024',
        ]);

        // If there's a new image, upload it
        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        } else {
            $imagePath = $this->existingImage; // Retain old image if no new one is uploaded
        }

        // Update product data
        $product->update([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'ingredient' => $this->ingredient,
            'image' => $imagePath,
            'positive' => json_encode($this->positiveAspects),
            'negative' => json_encode($this->negativeAspects),
        ]);

        session()->flash('success', 'Product updated successfully!');
        $this->resetFields();
        $this->mount();
    }

    // Edit Positive Aspect
    public function editPositiveAspect($index)
    {
        $this->editedPositiveAspect = $this->positiveAspects[$index];
        $this->editingPositiveIndex = $index;
    }

    // Save Edited Positive Aspect
    public function savePositiveAspect()
    {
        if (!empty($this->editedPositiveAspect)) {
            $this->positiveAspects[$this->editingPositiveIndex] = $this->editedPositiveAspect;
            $this->editedPositiveAspect = '';  // Reset the edited positive aspect
            $this->editingPositiveIndex = null; // Reset editing index
        } else {
            $this->addError('editedPositiveAspect', 'Please enter a valid positive aspect.');
        }
    }

    // Edit Negative Aspect
    public function editNegativeAspect($index)
    {
        $this->editedNegativeAspect = $this->negativeAspects[$index];
        $this->editingNegativeIndex = $index;
    }

    // Save Edited Negative Aspect
    public function saveNegativeAspect()
    {
        if (!empty($this->editedNegativeAspect)) {
            $this->negativeAspects[$this->editingNegativeIndex] = $this->editedNegativeAspect;
            $this->editedNegativeAspect = '';  // Reset the edited negative aspect
            $this->editingNegativeIndex = null; // Reset editing index
        } else {
            $this->addError('editedNegativeAspect', 'Please enter a valid negative aspect.');
        }
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

    public function cancel()
    {
        $this->resetFields();
        $this->showEditForm = false;
        $this->showAddForm = false;
        $this->dispatch('refresh');
    }

    public function performSearch()
    {
        $query = Product::query();

        if ($this->search) {
            if ($this->searchBy === 'category') {
                $query->whereHas('category', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            } else {
                $query->where($this->searchBy, 'like', '%' . $this->search . '%');
            }
        }

        // Add category filter
        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        $this->products = $query->get();
    }

    // Update resetSearch method
    public function resetSearch()
    {
        $this->search = '';
        $this->selectedCategory = '';
        $this->performSearch();
    }


    public function viewProductDetails($productId)
    {
        $product = Product::with('category')->find($productId);

        $positiveAspects = json_decode($product->positive, true) ?? [];
        $negativeAspects = json_decode($product->negative, true) ?? [];

        $this->productDetails = [
            'name' => $product->name,
            'category_name' => $product->category->name,
            'ingredient' => $product->ingredient,
            'description' => $product->description,
            'image' => $product->image,
            'positive' => $positiveAspects,
            'negative' => $negativeAspects,
        ];

        $this->showProductDetails = true;
    }



    // Add a new positive aspect
    public function addPositiveAspect()
    {
        if (!empty($this->newPositiveAspect)) {
            $this->positiveAspects[] = $this->newPositiveAspect;
            $this->newPositiveAspect = '';  // Reset the input field
        } else {
            $this->addError('newPositiveAspect', 'Please enter a positive aspect.');
        }
    }

    // Remove a positive aspect
    public function removePositiveAspect($index)
    {
        unset($this->positiveAspects[$index]);
        $this->positiveAspects = array_values($this->positiveAspects); // Re-index the array
    }

    // Add a new negative aspect
    public function addNegativeAspect()
    {
        if (!empty($this->newNegativeAspect)) {
            $this->negativeAspects[] = $this->newNegativeAspect;
            $this->newNegativeAspect = '';  // Reset the input field
        } else {
            $this->addError('newNegativeAspect', 'Please enter a negative aspect.');
        }
    }

    // Remove a negative aspect
    public function removeNegativeAspect($index)
    {
        unset($this->negativeAspects[$index]);
        $this->negativeAspects = array_values($this->negativeAspects); // Re-index the array
    }

    public function updatePositiveAspect()
    {
        // Example: Update the positive aspects list in the database or session
        $this->positiveAspects[] = $this->editedPositiveAspect;
        $this->editedPositiveAspect = ''; // Reset the input field
    }

    public function updateNegativeAspect()
    {
        // Example: Update the negative aspects list in the database or session
        $this->negativeAspects[] = $this->editedNegativeAspect;
        $this->editedNegativeAspect = ''; // Reset the input field
    }

    public function render()
    {
        return view('livewire.manage-product.product-list', [
            'products' => Product::all(),
        ]);
    }


}
