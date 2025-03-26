<?php

namespace App\Livewire\ManageContent;

use Livewire\Component;
use App\Models\Content\SkinQuiz;
use Livewire\WithPagination;

class ManageSkinQuiz extends Component
{
    use WithPagination;

    public $question, $answers = [];
    public $newAnswer = '';
    public $quizId;
    public $isAddFormVisible = false;
    public $isEditFormVisible = false;
    public $isDeleteFormVisible = false;
    public $isDetailsModalVisible = false;
    public $selectedQuiz;

    protected $rules = [
        'question' => 'required|string|max:255',
        'answers' => 'required|array|min:2',
        'answers.*' => 'required|string|max:255',
    ];

    public function render()
    {
        $quizzes = SkinQuiz::paginate(10);
        return view('livewire.manage-content.quiz.quiz-list', compact('quizzes'));
    }

    public function showAddForm()
    {
        $this->resetInputFields();
        $this->isAddFormVisible = true;
    }

    public function showEditForm($id)
    {
        $quiz = SkinQuiz::findOrFail($id);
        $this->quizId = $id;
        $this->question = $quiz->question;
        $this->answers = json_decode($quiz->answers, true);
        $this->isEditFormVisible = true;
    }

    public function showDeleteForm($id)
    {
        $this->quizId = $id;
        $this->isDeleteFormVisible = true;
    }

    public function showDetails($id)
    {
        $this->selectedQuiz = SkinQuiz::findOrFail($id);
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

    public function addAnswer()
    {
        $this->validate([
            'newAnswer' => 'required|string|max:255'
        ]);
        
        $this->answers[] = $this->newAnswer;
        $this->newAnswer = '';
    }

    public function removeAnswer($index)
    {
        unset($this->answers[$index]);
        $this->answers = array_values($this->answers); // Re-index array
    }

    public function store()
    {
        $this->validate();

        SkinQuiz::updateOrCreate(['id' => $this->quizId], [
            'question' => $this->question,
            'answers' => json_encode($this->answers),
        ]);

        session()->flash('message', 
            $this->quizId ? 'Quiz updated successfully.' : 'Quiz created successfully.');

        $this->hideForms();
    }

    public function delete()
    {
        SkinQuiz::find($this->quizId)->delete();
        session()->flash('message', 'Quiz deleted successfully.');
        $this->hideForms();
    }

    private function resetInputFields()
    {
        $this->question = '';
        $this->answers = [];
        $this->newAnswer = '';
        $this->quizId = null;
    }
}