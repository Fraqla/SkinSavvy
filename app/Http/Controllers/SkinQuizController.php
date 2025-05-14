<?php
namespace App\Http\Controllers;
use App\Models\Content\SkinQuiz;
use App\Models\Content\UserSkinQuizAnswer;
use Illuminate\Http\Request;

class SkinQuizController extends Controller
{
    public function index()
    {
        $quizzes = SkinQuiz::all()->map(function ($quiz) {
            return [
                'id' => $quiz->id,
                'question' => $quiz->question,
                'answers' => json_decode($quiz->answers),
            ];
        });

        return response()->json($quizzes);
    }

    public function submit(Request $request)
    {
        $answers = $request->input('answers');

        // Store user answers (you can get user ID from auth if needed)
        foreach ($answers as $answer) {
            UserSkinQuizAnswer::create([
                'user_id' => auth()->id() ?? 1, // Use actual auth or test user
                'skin_quiz_id' => $answer['quiz_id'],
                'user_answer' => $answer['answer'],
            ]);
        }

        // Simple logic for skin type result (replace with your own logic)
        $types = array_column($answers, 'answer');
        $typeCount = array_count_values($types);
        arsort($typeCount);
        $mostCommon = array_key_first($typeCount);

        return response()->json(['skin_type' => strtolower($mostCommon)]);
    }
}
