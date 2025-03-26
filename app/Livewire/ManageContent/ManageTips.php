<?php

namespace App\Livewire\ManageContent;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Content\Tip;
use Illuminate\Support\Facades\Storage;

class ManageTips extends Component
{
    use WithFileUploads;

    public $tips;
    public $title, $description = '', $image, $tipId, $existingImage;
    public $isAddFormVisible = false;
    public $isEditFormVisible = false;
    public $isDeleteFormVisible = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];
    // Add this to your Livewire component
protected $listeners = ['description-updated' => 'updateDescription'];

public function updateDescription($content)
{
    $this->description = $content;
    $this->emit('description-updated', $this->description);
}

    public function mount()
{
    $this->loadTips();
    $this->resetVisibility();
}

private function resetVisibility()
{
    $this->isAddFormVisible = false;
    $this->isEditFormVisible = false;
    $this->isDeleteFormVisible = false;
}


    public function loadTips()
    {
        $this->tips = Tip::latest()->get();
    }

    public function render()
    {
        return view('livewire.manage-content.tips.tips-list');
    }

    // Show methods
    public function showAddForm()
    {
        $this->hideAddForm(); // Reset first
        $this->isAddFormVisible = true;
    }

    public function showEditForm($id)
    {
        $this->hideEditForm(); // Reset first
        $tip = Tip::findOrFail($id);
        $this->tipId = $id;
        $this->title = $tip->title;
        $this->description = $tip->description;
        $this->existingImage = $tip->image;
        $this->isEditFormVisible = true;
    }

    public function confirmDelete($id)
    {
        $this->hideDeleteForm(); // Reset first
        $this->tipId = $id;
        $this->isDeleteFormVisible = true;
    }

    // Hide methods
    public function hideAddForm()
    {
        $this->reset(['title', 'description', 'image']);
        $this->isAddFormVisible = false;
    }

    public function hideEditForm()
{
    $this->reset(['title', 'description', 'image', 'tipId', 'existingImage']);
    $this->isEditFormVisible = false;
}
    public function hideDeleteForm()
    {
        $this->reset(['tipId']);
        $this->isDeleteFormVisible = false;
    }

    // Action methods
    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
        ];

        if ($this->image) {
            if ($this->existingImage) {
                Storage::disk('public')->delete($this->existingImage);
            }
            $data['image'] = $this->image->store('tips', 'public');
        } elseif ($this->existingImage) {
            $data['image'] = $this->existingImage;
        }

        if ($this->isEditFormVisible) {
            Tip::find($this->tipId)->update($data);
            $message = 'Tip updated successfully.';
            $this->hideEditForm();
        } else {
            Tip::create($data);
            $message = 'Tip created successfully.';
            $this->hideAddForm();
        }

        $this->loadTips();
        session()->flash('message', $message);
    }

    public function delete()
    {
        $tip = Tip::find($this->tipId);
        
        if ($tip->image) {
            Storage::disk('public')->delete($tip->image);
        }
        
        $tip->delete();
        
        $this->hideDeleteForm();
        $this->loadTips();
        session()->flash('message', 'Tip deleted successfully.');
    }
}