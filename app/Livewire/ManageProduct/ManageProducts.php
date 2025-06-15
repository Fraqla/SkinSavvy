<?php

namespace App\Livewire\ManageProduct;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;
use App\Models\Content\SkinKnowledge;

class ManageProducts extends Component
{
    use WithFileUploads, WithPagination;

    public $categories;
    public $name;
    public $category_id;
    public $description;
    public $image;
    public $productId;
    public $ingredient;
    public $existingImage;
    public $positiveAspects = [];
    public $negativeAspects = [];
    public $brand;
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
    public $editedPositiveAspect = '';
    public $editedNegativeAspect = '';
    public $editingPositiveIndex = null;
    public $editingNegativeIndex = null;
    public $skinKnowledges = [];
    public $selectedSkinType = null;
    public $perPage = 10;
    public $enableAutoSearch = false;
    public $page = 1; 
    protected $queryString = [
        'search' => ['except' => ''],
        'searchBy' => ['except' => 'name'],
        'selectedCategory' => ['except' => ''],
        'perPage' => ['except' => 10],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        $this->categories = Category::all();
        $this->skinKnowledges = SkinKnowledge::pluck('skin_type');
    }

    public function loadProducts()
    {
        return Product::with('category')
            ->when($this->search, function ($query) {
                if ($this->searchBy === 'category') {
                    $query->whereHas('category', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
                } elseif ($this->searchBy === 'suitability') {
                    $query->where('suitability', 'like', '%' . $this->search . '%');
                } else {
                    $query->where($this->searchBy, 'like', '%' . $this->search . '%');
                }
            })
            ->when($this->selectedCategory, function ($query) {
                $query->where('category_id', $this->selectedCategory);
            })
            ->paginate($this->perPage);
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }



    public function resetFields()
    {
        $this->reset([
            'name',
            'category_id',
            'description',
            'image',
            'ingredient',
            'positiveAspects',
            'negativeAspects',
            'showAddForm',
            'showEditForm',
            'editedPositiveAspect',
            'editedNegativeAspect',
            'editingPositiveIndex',
            'editingNegativeIndex',
            'brand',
            'selectedSkinType',
            'existingImage'
        ]);
    }

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
            'brand' => 'nullable|string',
            'selectedSkinType' => 'required|string|in:' . implode(',', $this->skinKnowledges->toArray()),
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
            'brand' => $this->brand,
            'suitability' => $this->selectedSkinType,
        ]);

        session()->flash('success', 'Product added successfully!');
        $this->resetFields();
    }

    public function showEditProductForm($id)
    {
        $product = Product::findOrFail($id);
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->category_id = $product->category_id;
        $this->description = $product->description;
        $this->ingredient = $product->ingredient;
        $this->positiveAspects = json_decode($product->positive, true) ?? [];
        $this->negativeAspects = json_decode($product->negative, true) ?? [];
        $this->existingImage = $product->image;
        $this->showEditForm = true;
        $this->brand = $product->brand;
        $this->selectedSkinType = $product->suitability;
    }

    public function update()
    {
        $product = Product::findOrFail($this->productId);

        $this->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'ingredient' => 'nullable|string',
            'positiveAspects' => 'required|array',
            'negativeAspects' => 'required|array',
            'image' => 'nullable|image|max:1024',
            'brand' => 'nullable|string',
            'selectedSkinType' => 'required|string|in:' . implode(',', $this->skinKnowledges->toArray()),
        ]);

        $imagePath = $this->image ? $this->image->store('products', 'public') : $this->existingImage;

        $product->update([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'ingredient' => $this->ingredient,
            'image' => $imagePath,
            'positive' => json_encode($this->positiveAspects),
            'negative' => json_encode($this->negativeAspects),
            'brand' => $this->brand,
            'suitability' => $this->selectedSkinType,
        ]);

        session()->flash('success', 'Product updated successfully!');
        $this->resetFields();
    }

    public function editPositiveAspect($index)
    {
        $this->editedPositiveAspect = $this->positiveAspects[$index];
        $this->editingPositiveIndex = $index;
    }

    public function savePositiveAspect()
    {
        if (!empty($this->editedPositiveAspect)) {
            $this->positiveAspects[$this->editingPositiveIndex] = $this->editedPositiveAspect;
            $this->editedPositiveAspect = '';
            $this->editingPositiveIndex = null;
        } else {
            $this->addError('editedPositiveAspect', 'Please enter a valid positive aspect.');
        }
    }

    public function editNegativeAspect($index)
    {
        $this->editedNegativeAspect = $this->negativeAspects[$index];
        $this->editingNegativeIndex = $index;
    }

    public function saveNegativeAspect()
    {
        if (!empty($this->editedNegativeAspect)) {
            $this->negativeAspects[$this->editingNegativeIndex] = $this->editedNegativeAspect;
            $this->editedNegativeAspect = '';
            $this->editingNegativeIndex = null;
        } else {
            $this->addError('editedNegativeAspect', 'Please enter a valid negative aspect.');
        }
    }

    public function confirmDeletion($id)
    {
        $this->productIdToDelete = $id;
        $this->confirmingProductDeletion = true;
    }

    public function deleteProduct()
    {
        if ($this->productIdToDelete) {
            Product::destroy($this->productIdToDelete);
            session()->flash('success', 'Product deleted successfully!');
            $this->reset(['confirmingProductDeletion', 'productIdToDelete']);
        }
    }

    public function cancel()
    {
        $this->resetFields();
    }

    public function performSearch()
    {
        $this->resetPage();
    }

    public function resetSearch()
    {
        $this->reset([
            'search',
            'selectedCategory',
            'searchBy',
        ]);
        $this->resetPage();
    }

    public function viewProductDetails($productId)
    {
        $product = Product::with('category')->find($productId);

        $this->productDetails = [
            'name' => $product->name,
            'category_name' => $product->category->name,
            'ingredient' => $product->ingredient,
            'description' => $product->description,
            'image' => $product->image,
            'positive' => json_decode($product->positive, true) ?? [],
            'negative' => json_decode($product->negative, true) ?? [],
            'brand' => $product->brand,
            'suitability' => $product->suitability,
        ];

        $this->showProductDetails = true;
    }

    public function addPositiveAspect()
    {
        if (!empty($this->newPositiveAspect)) {
            $this->positiveAspects[] = $this->newPositiveAspect;
            $this->newPositiveAspect = '';
        } else {
            $this->addError('newPositiveAspect', 'Please enter a positive aspect.');
        }
    }

    public function removePositiveAspect($index)
    {
        unset($this->positiveAspects[$index]);
        $this->positiveAspects = array_values($this->positiveAspects);
    }

    public function addNegativeAspect()
    {
        if (!empty($this->newNegativeAspect)) {
            $this->negativeAspects[] = $this->newNegativeAspect;
            $this->newNegativeAspect = '';
        } else {
            $this->addError('newNegativeAspect', 'Please enter a negative aspect.');
        }
    }

    public function removeNegativeAspect($index)
    {
        unset($this->negativeAspects[$index]);
        $this->negativeAspects = array_values($this->negativeAspects);
    }

    public function showAddProductForm()
    {
        $this->resetFields();
        $this->showAddForm = true;
    }

    public function render()
    {
        return view('livewire.manage-product.product-list', [
            'products' => $this->loadProducts(),
            'skinKnowledges' => $this->skinKnowledges,
        ]);
    }
}