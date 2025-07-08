<?php

namespace App\Livewire\ManageContent;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Content\ProhibitedProduct;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class ManageProhibited extends Component
{

    use WithPagination, WithFileUploads;

    public $currentImage;
    public $product_name, $detected_poison, $effect;
    public $image;
    public $tempImage;
    public $productId;
    public $isAddFormVisible = false;
    public $isEditFormVisible = false;
    public $isDeleteFormVisible = false;
    public $isDetailsModalVisible = false;
    public $selectedProduct;
    public $perPage = 10;
    public $page = 1;
    protected $queryString = [
        'page' => ['except' => 1],
        'perPage' => ['except' => 10]
    ];

    protected $rules = [
        'product_name' => 'required|string|max:255',
        'detected_poison' => 'nullable|string|max:255',
        'effect' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
    ];

    public function render()
    {
        return view('livewire.manage-content.prohibited-product.prohibited-list', [
            'products' => ProhibitedProduct::latest()->paginate($this->perPage)
        ]);
    }

    public function showAddForm()
    {
        $this->resetInputFields();
        $this->isAddFormVisible = true;
        $this->isEditFormVisible = false;
        $this->isDeleteFormVisible = false;
    }

    public function showEditForm($id)
    {
        $product = ProhibitedProduct::findOrFail($id);
        $this->productId = $id;
        $this->product_name = $product->product_name;
        $this->detected_poison = $product->detected_poison;
        $this->effect = $product->effect;
        $this->tempImage = $product->image ? asset('storage/' . $product->image) : null;
        $this->isEditFormVisible = true;
        $this->currentImage = $product->image ? asset('storage/' . $product->image) : null;
        $this->tempImage = null; 

    }

    public function showDeleteForm($id)
    {
        $this->productId = $id;
        $this->isAddFormVisible = false;
        $this->isEditFormVisible = false;
        $this->isDeleteFormVisible = true;
    }

    public function showDetails($id)
    {
        $this->selectedProduct = ProhibitedProduct::findOrFail($id);
        $this->isDetailsModalVisible = true;
    }

    // Update the hideForms method
    public function hideForms()
    {
        $this->isAddFormVisible = false;
        $this->isEditFormVisible = false;
        $this->isDeleteFormVisible = false;
        $this->isDetailsModalVisible = false;
        $this->resetInputFields();
    }

    public function store()
    {
        $this->validate();

        $data = [
            'product_name' => $this->product_name,
            'detected_poison' => $this->detected_poison,
            'effect' => $this->effect,
        ];

        // Handle image upload
        if ($this->image) {
            // Delete old image if updating
            if ($this->productId) {
                $oldProduct = ProhibitedProduct::find($this->productId);
                if ($oldProduct->image) {
                    Storage::disk('public')->delete($oldProduct->image);
                }
            }

            // Store new image
            $data['image'] = $this->image->store('prohibited-products', 'public');
        }

        // Create or update product
        ProhibitedProduct::updateOrCreate(['id' => $this->productId], $data);

        // Reset image property after save
        $this->reset('image');
        $this->tempImage = null;

        session()->flash(
            'message',
            $this->productId ? 'Product updated successfully.' : 'Product created successfully.'
        );

        $this->hideForms();
    }

    public function updatedImage()
{
    $this->validate([
        'image' => 'image|max:2048',
    ]);
    $this->tempImage = $this->image->temporaryUrl();
}


    public function delete()
    {
        $product = ProhibitedProduct::find($this->productId);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        $this->resetPage();
        session()->flash('message', 'Product deleted successfully.');
        $this->hideForms();
    }


    private function resetInputFields()
    {
        $this->product_name = '';
        $this->detected_poison = '';
        $this->effect = '';
        $this->productId = null;
    }

}