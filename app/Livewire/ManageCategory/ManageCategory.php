<?php

namespace App\Livewire\ManageCategory;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class ManageCategory extends Component
{
    use WithPagination;

    public $name, $category_id, $search = '';
    public $showAddForm = false, $showEditForm = false;
    public $selectedCategories = [], $selectAll = false;
    public $confirmingDeletion = false;
    public $categoryToDelete = null;
    protected $paginationTheme = 'tailwind';
    public $searchBy = 'name';

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
        $this->validate(['name' => 'required|string|unique:categories']);
        Category::create(['name' => $this->name]);
        session()->flash('success', 'Category added successfully!');
        $this->resetFields();
    }

    // Show Edit Form
    public function showEditCategoryForm($id)
    {
        $category = Category::find($id);
        $this->category_id = $id;
        $this->name = $category->name;
        $this->showEditForm = true;
    }

    // Update Category
    public function update()
    {
        $this->validate(['name' => 'required|string|unique:categories,name,' . $this->category_id]);
        $category = Category::find($this->category_id);
        $category->update(['name' => $this->name]);

        session()->flash('success', 'Category updated successfully!');
        $this->resetFields();
    }

    // Delete Single Category
    public function delete($id)
    {
        Category::find($id)->delete();
        session()->flash('success', 'Category deleted successfully!');
    }

    // Bulk Delete
    public function deleteSelected()
    {
        Category::whereIn('id', $this->selectedCategories)->delete();
        $this->selectedCategories = [];
        session()->flash('success', 'Selected categories deleted successfully!');
    }
    public function confirmDeletion($id)
    {
        $this->confirmingDeletion = true;
        $this->categoryToDelete = $id;
    }
    // Delete after confirmation
public function deleteConfirmed()
{
    if ($this->categoryToDelete) {
        Category::find($this->categoryToDelete)->delete();
        session()->flash('success', 'Category deleted successfully!');
    }

    // Reset states
    $this->confirmingDeletion = false;
    $this->categoryToDelete = null;
}
public function cancel()
{
    $this->resetFields();
    $this->showEditForm = false;
    $this->showAddForm = false;
    $this->dispatch('refresh');
}

    // Reset fields and forms
    private function resetFields()
    {
        $this->name = '';
        $this->category_id = null;
        $this->showAddForm = false;
        $this->showEditForm = false;
    }

    public function performSearch()
{
    $query = Category::query();

    if ($this->search) {
        if ($this->searchBy === 'category') {
            $query->whereHas('category', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        } else {
            $query->where($this->searchBy, 'like', '%' . $this->search . '%');
        }
    }

    $this->category_id = $query->get();
}

public function resetSearch()
{
    $this->search = '';
    $this->performSearch();
}
}