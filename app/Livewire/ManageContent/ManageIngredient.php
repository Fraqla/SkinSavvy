<?php

namespace App\Livewire\ManageContent;

use Livewire\Component;
use App\Models\Content\Ingredient;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ManageIngredient extends Component
{
    use WithPagination, WithFileUploads;

    public $ingredient_name, $function, $facts = [], $benefits = [], $image;
    public $tempImage;
    public $ingredientId;
    public $isAddFormVisible = false;
    public $isEditFormVisible = false;
    public $isDeleteFormVisible = false;
    public $isDetailsModalVisible = false;
    public $selectedIngredient;
    public $newFact = '';
    public $newBenefit = '';
    public $perPage = 10;
    public $page = 1;
    protected $queryString = [
        'perPage' => ['except' => 10],
        'page' => ['except' => 1]
    ];
    protected $rules = [
        'ingredient_name' => 'required|string|max:255',
        'function' => 'required|string',
        'facts' => 'nullable|array',
        'facts.*' => 'required|string|max:255',
        'benefits' => 'nullable|array',
        'benefits.*' => 'required|string|max:255',
        'image' => 'nullable|image|max:2048',

    ];
    protected $listeners = ['closeModal' => 'closeDetailsModal'];

    public function render()
    {
        $ingredients = Ingredient::paginate($this->perPage);
        return view('livewire.manage-content.ingredients.ingredient-list', compact('ingredients'));
    }
    public function showAddForm()
    {
        $this->resetInputFields();
        $this->isAddFormVisible = true;
    }

    public function showEditForm($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $this->ingredientId = $id;
        $this->ingredient_name = $ingredient->ingredient_name;
        $this->function = $ingredient->function;
        $this->facts = $ingredient->facts;
        $this->benefits = $ingredient->benefits;
        $this->tempImage = $ingredient->image ? asset('storage/' . $ingredient->image) : null;
        $this->isEditFormVisible = true;
    }

    public function showDeleteForm($id)
    {
        $this->ingredientId = $id;
        $this->isDeleteFormVisible = true;
    }

    public function hideForms()
    {
        $this->isAddFormVisible = false;
        $this->isEditFormVisible = false;
        $this->isDeleteFormVisible = false;
        $this->resetInputFields();
    }

    public function store()
    {
        $this->validate();

        $data = [
            'ingredient_name' => $this->ingredient_name,
            'function' => $this->function,
            'facts' => $this->facts,
            'benefits' => $this->benefits,
        ];

        if ($this->image) {
            // Delete old image if updating
            if ($this->ingredientId) {
                $oldIngredient = Ingredient::find($this->ingredientId);
                if ($oldIngredient->image) {
                    Storage::disk('public')->delete($oldIngredient->image);
                }
            }
            $data['image'] = $this->image->store('ingredients', 'public');
        }

        Ingredient::updateOrCreate(['id' => $this->ingredientId], $data);

        session()->flash(
            'message',
            $this->ingredientId ? 'Ingredient updated successfully.' : 'Ingredient created successfully.'
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
        $ingredient = Ingredient::find($this->ingredientId);
        if ($ingredient->image) {
            Storage::disk('public')->delete($ingredient->image);
        }
        $ingredient->delete();
        session()->flash('message', 'Ingredient deleted successfully.');
        $this->hideForms();
    }

    public function showDetails($id)
    {
        $this->selectedIngredient = Ingredient::findOrFail($id);
        $this->isDetailsModalVisible = true;
    }

    public function closeDetailsModal()
    {
        $this->isDetailsModalVisible = false;
        $this->selectedIngredient = null;
    }

    public function addFact()
    {
        $this->validate([
            'newFact' => 'required|string|max:255'
        ]);

        $this->facts[] = $this->newFact;
        $this->newFact = '';
    }

    public function removeFact($index)
    {
        unset($this->facts[$index]);
        $this->facts = array_values($this->facts);
    }

    public function addBenefit()
    {
        $this->validate([
            'newBenefit' => 'required|string|max:255'
        ]);

        $this->benefits[] = $this->newBenefit;
        $this->newBenefit = '';
    }

    public function removeBenefit($index)
    {
        unset($this->benefits[$index]);
        $this->benefits = array_values($this->benefits);
    }
    private function resetInputFields()
    {
        $this->ingredient_name = '';
        $this->function = '';
        $this->facts = [];
        $this->benefits = [];
        $this->image = null;
        $this->tempImage = null;
        $this->ingredientId = null;
    }
}