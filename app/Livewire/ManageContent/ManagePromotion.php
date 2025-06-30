<?php

namespace App\Livewire\ManageContent;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Content\Promotion;
use Carbon\Carbon;

class ManagePromotion extends Component
{
    use WithFileUploads;

    public $promotions, $title, $description, $start_date, $end_date, $image, $promotionId;
    public $isAddFormVisible = false, $isEditFormVisible = false, $isDeleteFormVisible = false;
    protected $listeners = [
        'hide-add-promotion' => 'hideAddPromotion',
        'hide-edit-promotion' => 'hideEditPromotion',
        'hide-delete-promotion' => 'hideDeletePromotion',
    ];

    public function render()
    {
        $this->promotions = Promotion::all()->map(function ($promotion) {
            $today = Carbon::now()->toDateString();
            if ($today < $promotion->start_date) {
                $promotion->status = 'Unactive';
            } elseif ($today > $promotion->end_date) {
                $promotion->status = 'Due';
            } else {
                $promotion->status = 'Active';
            }
            return $promotion;
        });

        return view('livewire.manage-content.promotion.promotion-list');
    }

    public function showAddForm()
    {
        $this->resetInputFields();
        $this->isAddFormVisible = true;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'image' => 'nullable|image|max:1024',
        ]);

        if ($this->image) {
            $validatedData['image'] = $this->image->store('promotions', 'public');
        }

        Promotion::create($validatedData);

        session()->flash('message', 'Promotion successfully added!');
        $this->isAddFormVisible = false;
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $promotion = Promotion::findOrFail($id);
        $this->promotionId = $promotion->id;
        $this->title = $promotion->title;
        $this->description = $promotion->description;
        $this->start_date = $promotion->start_date;
        $this->end_date = $promotion->end_date;

        // Set existing image URL (not file upload)
        $this->image = $promotion->image;

        $this->isEditFormVisible = true;
    }


    public function update()
    {
        $validatedData = $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'image' => 'nullable|image|max:1024',
        ]);

        $promotion = Promotion::findOrFail($this->promotionId);

        if ($this->image) {
            $validatedData['image'] = $this->image->store('promotions', 'public');
        }

        $promotion->update($validatedData);
        session()->flash('message', 'Promotion successfully updated!');
        $this->isEditFormVisible = false;
        $this->resetInputFields();
    }

    public function confirmDelete($id)
    {
        $this->promotionId = $id;
        $this->isDeleteFormVisible = true;
    }

    public function delete()
    {
        Promotion::findOrFail($this->promotionId)->delete();
        session()->flash('message', 'Promotion successfully deleted!');
        $this->isDeleteFormVisible = false;
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->description = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->image = null;
        $this->promotionId = null;
    }

    public function hideAddPromotion()
    {
        $this->reset(['title', 'description', 'start_date', 'end_date', 'image']);
        $this->isAddFormVisible = false;
    }

    public function hideEditPromotion()
    {
        $this->reset(['title', 'description', 'start_date', 'end_date', 'image']);
        $this->isEditFormVisible = false;
    }
    public function hideDeletePromotion()
    {
        $this->isDeleteFormVisible = false;
    }

}
