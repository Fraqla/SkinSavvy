<?php

namespace App\Livewire\ManageContent;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Content\Tip;
use Illuminate\Support\Facades\Storage;

class ManageTips extends Component
{
    use WithPagination, WithFileUploads;

    public $title, $description = '', $image, $tipId, $existingImage;
    public $isAddFormVisible = false;
    public $isEditFormVisible = false;
    public $isDeleteFormVisible = false;
    public $isDetailsModalVisible = false;
    public $currentTip = null;
    public $perPage = 10;
    public $page = 1;
    protected $queryString = [
        'page' => ['except' => 1],
        'perPage' => ['except' => 10]
    ];

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    protected $listeners = ['description-updated' => 'updateDescription'];

    public function updateDescription($content)
    {
        $this->description = $content;
    }

    public function mount()
    {
        $this->resetVisibility();
    }

    private function resetVisibility()
    {
        $this->isAddFormVisible = false;
        $this->isEditFormVisible = false;
        $this->isDeleteFormVisible = false;
        $this->isDetailsModalVisible = false;
    }

    public function render()
    {
        return view('livewire.manage-content.tips.tips-list', [
            'tips' => Tip::latest()->paginate($this->perPage)
        ]);
    }

    public function showAddForm()
    {
        $this->hideAddForm();
        $this->isAddFormVisible = true;
    }

    public function showEditForm($id)
    {
        $this->hideEditForm();
        $tip = Tip::findOrFail($id);
        $this->tipId = $id;
        $this->title = $tip->title;
        $this->description = $tip->description;
        $this->existingImage = $tip->image;
        $this->isEditFormVisible = true;
    }

    public function confirmDelete($id)
    {
        $this->hideDeleteForm();
        $this->tipId = $id;
        $this->isDeleteFormVisible = true;
    }

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

    public function showDetails($id)
    {
        $this->currentTip = Tip::findOrFail($id);
        $this->isDetailsModalVisible = true;
    }

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

        session()->flash('message', $message);
        $this->dispatch('tip-saved'); // Add this line
    }

    public function delete()
    {
        $tip = Tip::find($this->tipId);

        if ($tip->image) {
            Storage::disk('public')->delete($tip->image);
        }

        $tip->delete();

        $this->hideDeleteForm();
        $this->resetPage();
        session()->flash('message', 'Tip deleted successfully.');
    }
}