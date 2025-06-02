<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Content\SkinQuiz;

class SkinQuizSeeder extends Seeder
{
    public function run(): void
    {
        SkinQuiz::create([
            'question' => 'How does your skin usually feel at the end of the day?',
            'answers' => [
                [
                    'text' => 'A) Oily — Shiny and greasy, especially on the T-zone.',
                    'type' => 'Oily',
                    'weight' => 1
                ],
                [
                    'text' => 'B) Dry — Tight, rough, or flaky.',
                    'type' => 'Dry',
                    'weight' => 1
                ],
                [
                    'text' => 'C) Combination — Oily on the T-zone, but dry on cheeks.',
                    'type' => 'Combination',
                    'weight' => 1
                ],
                [
                    'text' => 'D) Normal — Comfortable and smooth.',
                    'type' => 'Normal',
                    'weight' => 1
                ],
                [
                    'text' => 'E) Sensitive — Red or irritated easily.',
                    'type' => 'Sensitive',
                    'weight' => 1
                ],
            ],
        ]);
    }
}
