<?php

namespace App\Livewire\ManageContent;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Content\SkinKnowledge;

class ManageSkinKnowledge extends Component
{
    use WithFileUploads;

    public $skinKnowledges;
    public $skin_type = '', $characteristics = [], $best_ingredients = [], $image;
    public $isAddFormVisible = false;
    public $isEditFormVisible = false;
    public $editingId;
    public $skinDetails = [];
    public $showSkinDetails = false;
    public $knowledgeId = null;

    public function mount($knowledgeId = null)
    {
        $this->knowledgeId = $knowledgeId;

        if ($knowledgeId) {
            $knowledge = SkinKnowledge::find($knowledgeId);
            $this->skin_type = $knowledge->skin_type;
            $this->characteristics = json_decode($knowledge->characteristics, true) ?? [];
            $this->best_ingredients = json_decode($knowledge->best_ingredients, true) ?? [];
            $this->image = $knowledge->image;
        }
        $this->skinKnowledges = SkinKnowledge::all();
    }

    public function showAddForm()
    {
        $this->resetForm();
        $this->isAddFormVisible = true;
        $this->isEditFormVisible = false;
    }

    public function showEditForm($id)
    {
        $this->resetForm();
        $knowledge = SkinKnowledge::find($id);

        if ($knowledge) {
            $this->editingId = $id;
            $this->skin_type = $knowledge->skin_type;
            $this->characteristics = $knowledge->characteristics ?? [];

            $this->best_ingredients = json_decode($knowledge->best_ingredients, true) ?? [];
            $this->image = $knowledge->image ? asset('storage/' . $knowledge->image) : null;

            $this->isAddFormVisible = false;
            $this->isEditFormVisible = true;

            $this->dispatch('formOpened');
        }
    }

    public function save()
    {
        $this->validate([
            'skin_type' => 'required',
            'characteristics' => 'required|array|min:1',
            'best_ingredients' => 'required|array|min:1',
            'image' => $this->knowledgeId ? 'nullable|image|max:1024' : 'required|image|max:1024',
        ]);

        $imagePath = $this->image ? $this->image->store('skin_knowledge', 'public') : null;

        SkinKnowledge::create([
            'skin_type' => $this->skin_type,
            'characteristics' => json_encode($this->characteristics),
            'best_ingredient' => json_encode($this->best_ingredient), // ✅ Include this line
            'image' => $this->image->store('skin_knowledge', 'public'),
        ]);
        

        session()->flash('message', 'Skin knowledge saved successfully!');
        $this->reset(['skin_type', 'characteristics', 'best_ingredients', 'image']);
        $this->isAddFormVisible = false;
        $this->skinKnowledges = SkinKnowledge::all();
    }

    public function update()
    {
        $this->validate([
            'skin_type' => 'required',
            'characteristics' => 'required|array|min:1',
            'best_ingredients' => 'required|array|min:1',
            'image' => 'nullable|image|max:1024',
        ]);

        $knowledge = SkinKnowledge::find($this->editingId);

        if ($knowledge) {
            if ($this->image && is_object($this->image)) {
                $knowledge->image = $this->image->store('skin_knowledge', 'public');
            }

            $knowledge->update([
                'skin_type' => $this->skin_type,
                'characteristics' => json_encode($this->characteristics),
                'best_ingredients' => json_encode($this->best_ingredients),
            ]);
        }

        $this->resetForm();
        $this->skinKnowledges = SkinKnowledge::all();
        $this->isEditFormVisible = false;
    }

    public function delete($id)
    {
        SkinKnowledge::find($id)->delete();
        $this->skinKnowledges = SkinKnowledge::all();
    }

    public function viewSkinDetails($knowledgeId)
    {
        $knowledge = SkinKnowledge::find($knowledgeId);

        $this->skinDetails = [
            'skin_type' => $knowledge->skin_type,
            'characteristics' => json_decode($knowledge->characteristics, true),
            'best_ingredients' => json_decode($knowledge->best_ingredients, true),
            'image' => $knowledge->image,
        ];

        $this->showSkinDetails = true;
    }

    public function closeDetails()
    {
        $this->showSkinDetails = false;
    }

    private function resetForm()
    {
        $this->skin_type = '';
        $this->characteristics = [];
        $this->best_ingredients = [];
        $this->image = null;
        $this->editingId = null;
        $this->knowledgeId = null;
        $this->isAddFormVisible = false;
        $this->isEditFormVisible = false;
    }

    public function addIngredient()
    {
        $this->best_ingredients[] = '';
    }
    
    public function removeIngredient($index)
    {
        unset($this->best_ingredients[$index]);
        $this->best_ingredients = array_values($this->best_ingredients);
    }
    
    public function addCharacteristic()
    {
        $this->characteristics[] = '';
    }

    public function removeCharacteristic($index)
    {
        unset($this->characteristics[$index]);
        $this->characteristics = array_values($this->characteristics);
    }

    public function render()
    {
        return view('livewire.manage-content.skin-knowledge.skin-knowledge-list');
    }
}
