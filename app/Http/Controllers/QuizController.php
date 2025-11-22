<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function play()
    {
        // QUIZ DUMMY TANPA DATABASE
        $quiz = (object)[
            'id' => 1,
            'title' => 'Kuis Budaya Indonesia',
            'description' => 'Jawab pertanyaan berikut untuk menguji pengetahuanmu!',
        ];

        // SOAL DUMMY
        $questions = [
            (object)[
                'id' => 1,
                'question' => 'Siapakah pencipta lagu Indonesia Raya?',
                'option_a' => 'W.R Supratman',
                'option_b' => 'Ki Hajar Dewantara',
                'option_c' => 'Ismail Marzuki',
                'option_d' => 'H. Mutahar',
            ],
            (object)[
                'id' => 2,
                'question' => 'Tari Saman berasal dari daerah?',
                'option_a' => 'Aceh',
                'option_b' => 'Bali',
                'option_c' => 'Jawa Barat',
                'option_d' => 'Sulawesi Selatan',
            ],
        ];

        return view('quiz.play', compact('quiz', 'questions'));
    }
}
