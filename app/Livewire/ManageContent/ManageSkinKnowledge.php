<?php

namespace App\Livewire\ManageContent;

use Livewire\Component;
use App\Models\Content\SkinKnowledge;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ManageSkinKnowledge extends Component
{
    use WithPagination, WithFileUploads;

    public $skin_type, $characteristics, $best_ingredient, $description, $image;
    public $tempImage;
    public $skinKnowledgeId;
    public $isAddFormVisible = false;
    public $isEditFormVisible = false;
    public $isDeleteFormVisible = false;
    public $isDetailsModalVisible = false;
    public $selectedSkinKnowledge;

    protected $rules = [
        'skin_type' => 'required|string|max:255',
        'characteristics' => 'required|string',
        'best_ingredient' => 'required|string',
        'description' => 'required|string',
        'image' => 'nullable|image|max:2048',
    ];

    public function render()
    {
        $skinKnowledges = SkinKnowledge::paginate(10);
        return view('livewire.manage-content.skin-knowledge.knowledge-list', compact('skinKnowledges'));
    }

    public function showAddForm()
    {
        $this->resetInputFields();
        $this->isAddFormVisible = true;
    }

    public function showEditForm($id)
    {
        $skinKnowledge = SkinKnowledge::findOrFail($id);
        $this->skinKnowledgeId = $id;
        $this->skin_type = $skinKnowledge->skin_type;
        $this->characteristics = $skinKnowledge->characteristics;
        $this->best_ingredient = $skinKnowledge->best_ingredient;
        $this->description = $skinKnowledge->description;
        $this->tempImage = $skinKnowledge->image ? asset('storage/'.$skinKnowledge->image) : null;
        $this->isEditFormVisible = true;
    }

    public function showDeleteForm($id)
    {
        $this->skinKnowledgeId = $id;
        $this->isDeleteFormVisible = true;
    }

    public function showDetails($id)
    {
        $this->selectedSkinKnowledge = SkinKnowledge::findOrFail($id);
        $this->isDetailsModalVisible = true;
    }

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
            'skin_type' => $this->skin_type,
            'characteristics' => $this->characteristics,
            'best_ingredient' => $this->best_ingredient,
            'description' => $this->description,
        ];

        if ($this->image) {
            // Delete old image if updating
            if ($this->skinKnowledgeId) {
                $oldSkinKnowledge = SkinKnowledge::find($this->skinKnowledgeId);
                if ($oldSkinKnowledge->image) {
                    Storage::disk('public')->delete($oldSkinKnowledge->image);
                }
            }
            $data['image'] = $this->image->store('skin-knowledge', 'public');
        }

        SkinKnowledge::updateOrCreate(['id' => $this->skinKnowledgeId], $data);

        session()->flash('message', 
            $this->skinKnowledgeId ? 'Skin knowledge updated successfully.' : 'Skin knowledge created successfully.');

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
        $skinKnowledge = SkinKnowledge::find($this->skinKnowledgeId);
        if ($skinKnowledge->image) {
            Storage::disk('public')->delete($skinKnowledge->image);
        }
        $skinKnowledge->delete();
        session()->flash('message', 'Skin knowledge deleted successfully.');
        $this->hideForms();
    }

    private function resetInputFields()
    {
        $this->skin_type = '';
        $this->characteristics = '';
        $this->best_ingredient = '';
        $this->description = '';
        $this->image = null;
        $this->tempImage = null;
        $this->skinKnowledgeId = null;
    }
}