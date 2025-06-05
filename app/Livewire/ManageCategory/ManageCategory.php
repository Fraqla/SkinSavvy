<?php

namespace App\Livewire\ManageCategory;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use Livewire\WithFileUploads;

class ManageCategory extends Component
{
    use WithPagination, WithFileUploads;

    public $name, $category_id, $search = '';
    public $image;
    public $showAddForm = false, $showEditForm = false;
    public $selectedCategories = [], $selectAll = false;
    public $confirmingDeletion = false;
    public $categoryToDelete = null;
    protected $paginationTheme = 'tailwind';
    public $searchBy = 'name';
    public $existingImage; // New property to store the existing image URL

    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('livewire.manage-category.category-list', compact('categories'));
    }

    // Show Add Form
    public function showAddCategoryForm()
    {
        $this->resetFields();
        $this->showAddForm = true;
    }

    // Save New Category
    public function store()
    {
        $this->validate([
            'name' => 'required|string|unique:categories',
            'image' => 'nullable|image|max:2048', // optional validation for image
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('category-images', 'public');
        }

        Category::create([
            'name' => $this->name,
            'image' => $imagePath,
        ]);

        session()->flash('success', 'Category added successfully!');
        $this->resetFields();
    }

    // Show Edit Form
    public function showEditCategoryForm($id)
    {
        $category = Category::find($id);
        $this->category_id = $id;
        $this->name = $category->name;
        $this->existingImage = $category->image; // Assign the existing image to the property
        $this->image = null; // Reset the image field for upload
        $this->showEditForm = true;
    }

    // Update Category
    public function update()
    {
        $this->validate([
            'name' => 'required|string|unique:categories,name,' . $this->category_id,
            'image' => 'nullable|image|max:2048',
        ]);

        $category = Category::find($this->category_id);

        $imagePath = $category->image; // Keep the existing image if not updating
        if ($this->image) {
            $imagePath = $this->image->store('category-images', 'public');
        }

        $category->update([
            'name' => $this->name,
            'image' => $imagePath,
        ]);

        session()->flash('success', 'Category updated successfully!');
        $this->resetFields();
    }

    // Confirm deletion
    public function confirmDeletion($id)
    {
        $this->categoryToDelete = $id;
        $this->confirmingDeletion = true;
    }

    // Execute deletion
    public function delete()
    {
        if ($this->categoryToDelete) {
            Category::find($this->categoryToDelete)->delete();
            session()->flash('success', 'Category deleted successfully!');
            $this->confirmingDeletion = false;
            $this->categoryToDelete = null;
        }
    }

    // Cancel deletion
    public function cancelDeletion()
    {
        $this->confirmingDeletion = false;
        $this->categoryToDelete = null;
    }

    private function resetFields()
    {
        $this->name = '';
        $this->image = null;
        $this->category_id = null;
        $this->existingImage = null; // Reset the existing image when fields are reset
        $this->showAddForm = false;
        $this->showEditForm = false;
    }

    public function cancel()
    {
        $this->resetFields();
        $this->showEditForm = false;
        $this->showAddForm = false;
        $this->dispatch('refresh');
    }

}
