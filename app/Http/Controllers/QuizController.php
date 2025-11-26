<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
// Pastikan Import Model yang sesuai dengan Admin kamu
use App\Models\DailyMission; 
use App\Models\DailyMissionTask;
use App\Models\DailyMissionQuiz;

class QuizController extends Controller
{
    public function index()
    {
        return $this->play();
    }

    public function play()
    {
        // 1. Ambil Misi Harian untuk Hari Ini
        $today = Carbon::today();
        
        $dailyMission = DailyMission::with(['tasks' => function($query) {
            // Ambil hanya task tipe 'quiz' beserta soal dan opsinya
            $query->where('type', 'quiz')
                  ->with(['quizzes.options']);
        }])
        ->whereDate('date', $today)
        ->first();

        // Cek jika tidak ada misi hari ini
        if (!$dailyMission) {
            return redirect()->back()->with('error', 'Belum ada kuis untuk hari ini.');
        }

        // Ambil task quiz dari collection
        $quizTask = $dailyMission->tasks->first();

        // Cek jika task quiz kosong
        if (!$quizTask || $quizTask->quizzes->isEmpty()) {
            return redirect()->back()->with('error', 'Soal kuis belum diatur oleh admin.');
        }

        // 2. Format Data Database ke Format Game (JSON friendly)
        $formattedQuestions = [];
        $letters = ['A', 'B', 'C', 'D']; // Mapping index 0-3 ke A-D

        foreach ($quizTask->quizzes as $q) {
            $options = [];
            $correctKey = null;

            // Loop opsi jawaban dari database
            foreach ($q->options as $index => $opt) {
                // Pastikan index tidak lebih dari 3 (A,B,C,D)
                if ($index < 4) {
                    $key = $letters[$index];
                    $options[$key] = $opt->option_text;

                    // Cek jika ini jawaban benar
                    if ($opt->is_correct) {
                        $correctKey = $key;
                    }
                }
            }

            $formattedQuestions[] = (object)[
                'id' => $q->id,
                'question' => $q->question,
                'options' => (object)$options, // Ubah jadi object agar JS bacanya {A: "...", B: "..."}
                'correct' => $correctKey,
            ];
        }

        // Data Quiz Info
        $quizInfo = (object)[
            'title' => $dailyMission->title,
            'description' => $dailyMission->description,
        ];

        return view('quiz.index', [
            'quiz' => $quizInfo,
            'questions' => $formattedQuestions
        ]);
    }
}