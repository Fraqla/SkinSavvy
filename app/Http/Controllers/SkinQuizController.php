<?php
namespace App\Http\Controllers;

use App\Models\Content\SkinQuiz;
use App\Models\Content\UserSkinQuizAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkinQuizController extends Controller
{
    public function index()
    {
        return response()->json(SkinQuiz::all());
    }

    public function submitAnswers(Request $request)
    {
        $user = Auth::user();
        $answers = $request->input('answers');

        foreach ($answers as $answer) {
            UserSkinQuizAnswer::create([
                'user_id' => $user->id,
                'skin_quiz_id' => $answer['quiz_id'],
                'user_answer' => $answer['answer']
            ]);
        }

        // Calculate skin type based on answers
        $skinType = $this->calculateSkinType($answers);

        return response()->json([
            'success' => true,
            'skin_type' => $skinType
        ]);
    }

    private function calculateSkinType($answers)
    {
        // Implement your skin type calculation logic here
        // Example: Count occurrences of each answer type
        $answerCounts = array_count_values(array_column($answers, 'answer'));
        
        // Simple example logic - adjust based on your requirements
        if (isset($answerCounts['Oily']) && $answerCounts['Oily'] > 3) {
            return 'Oily';
        } elseif (isset($answerCounts['Dry']) && $answerCounts['Dry'] > 3) {
            return 'Dry';
        } else {
            return 'Combination';
        }
    }
}