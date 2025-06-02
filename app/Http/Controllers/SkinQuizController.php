<?php
namespace App\Http\Controllers;
use App\Models\Content\SkinQuiz;
use App\Models\Content\UserSkinQuizAnswer;
use Illuminate\Http\Request;
use App\Models\UserSkinType;

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
    $user = $request->user();

    if (!$user) {
        return response()->json(['error' => 'Unauthenticated'], 401);
    }

    $answers = $request->input('answers');
    if (!$answers || !is_array($answers)) {
        return response()->json(['error' => 'Invalid answers format'], 400);
    }

    $totalScore = 0;

    foreach ($answers as $answer) {
        if (!isset($answer['quiz_id'], $answer['user_answer'])) {
            continue; // skip invalid
        }

        $score = $answer['score'] ?? 0;
        $totalScore += $score;

        UserSkinQuizAnswer::updateOrCreate(
            [
                'user_id' => $user->id,
                'skin_quiz_id' => $answer['quiz_id'],
            ],
            [
                'user_answer' => $answer['user_answer'],
                'score' => $score,
            ]
        );
    }

    $skinType = $this->determineSkinType($totalScore);

    // Save or update result in new table
    UserSkinType::updateOrCreate(
        ['user_id' => $user->id],
        [
            'total_score' => $totalScore,
            'skin_type' => $skinType,
        ]
    );

    \Log::info('Submit answers payload:', $answers);
    \Log::info('Authenticated user ID:', ['id' => $user->id]);

    return response()->json([
        'message' => 'Skin quiz submitted successfully!',
        'user_id' => $user->id,
        'skin_type' => $skinType,
        'total_score' => $totalScore,
    ]);
}



private function determineSkinType(int $score): string
{
    if ($score >= 5 && $score <= 7) return 'Dry Skin';
    if ($score >= 8 && $score <= 10) return 'Oily Skin';
    if ($score >= 11 && $score <= 13) return 'Normal Skin';
    if ($score >= 14 && $score <= 20) return 'Combination Skin';
    return 'Unknown Skin Type';
}


}
