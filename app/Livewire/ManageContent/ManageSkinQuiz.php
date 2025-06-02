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
    public $newAnswerScore = '';

    public $quizId;
    public $isAddFormVisible = false;
    public $isEditFormVisible = false;
    public $isDeleteFormVisible = false;
    public $isDetailsModalVisible = false;
    public $selectedQuiz;

    protected $rules = [
        'question' => 'required|string|max:255',
        'answers' => 'required|array|min:2',
        'answers.*.text' => 'required|string|max:255',
        'answers.*.score' => 'required|numeric|min:0',

    ];


    public function render()
{
    $quizzes = SkinQuiz::paginate(10);

    // Decode answers for each quiz
    $quizzes->getCollection()->transform(function ($quiz) {
        if (is_string($quiz->answers)) {
            $quiz->answers = json_decode($quiz->answers, true);
        }
        return $quiz;
    });

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
        // Decode the answers only if it's a string
        if (is_string($quiz->answers)) {
            $quiz->answers = json_decode($quiz->answers, true);
        }
        $this->isEditFormVisible = true;
        $this->answers = $quiz->answers;

    }

    public function showDeleteForm($id)
    {
        $this->quizId = $id;
        $this->isDeleteFormVisible = true;
    }

    public function showDetails($id)
    {
        $this->selectedQuiz = SkinQuiz::findOrFail($id);

        // Ensure the answers are decoded correctly if not already an array
        if (is_string($this->selectedQuiz->answers)) {
            $this->selectedQuiz->answers = json_decode($this->selectedQuiz->answers, true);
        }

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
            'newAnswer' => 'required|string|max:255',
            'newAnswerScore' => 'required|numeric|min:0',
        ]);

        $this->answers[] = [
            'text' => $this->newAnswer,
            'score' => $this->newAnswerScore,
        ];

        // Reset input fields
        $this->newAnswer = '';
        $this->newAnswerScore = '';
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

        session()->flash(
            'message',
            $this->quizId ? 'Quiz updated successfully.' : 'Quiz created successfully.'
        );

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