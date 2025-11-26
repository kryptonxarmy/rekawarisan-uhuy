<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DailyMission;
use App\Models\DailyMissionTask;
use App\Models\DailyMissionQuiz;
use App\Models\DailyMissionQuizOption;
use App\Models\DailyMissionTaskArticle;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyMissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dailyMissions = DailyMission::with('tasks')
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('admin.daily-missions.index', compact('dailyMissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $articles = Article::where('status', 'approved')->get();
        return view('admin.daily-missions.create', compact('articles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|unique:daily_missions,date',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            
            // Read Task
            'read_article_id' => 'required|exists:articles,id',
            'read_xp_reward' => 'required|integer|min:1',
            'read_timer_seconds' => 'required|integer|min:30',
            
            // Engage Task
            'engage_xp_reward' => 'required|integer|min:1',
            'engage_required_count' => 'required|integer|min:1',
            
            // Quiz Task
            'quiz_xp_reward' => 'required|integer|min:1',
            'quiz_questions' => 'required|array|min:1',
            'quiz_questions.*.question' => 'required|string',
            'quiz_questions.*.explanation' => 'nullable|string',
            'quiz_questions.*.options' => 'required|array|min:2|max:4',
            'quiz_questions.*.options.*.text' => 'required|string',
            'quiz_questions.*.options.*.is_correct' => 'required|boolean',
        ]);

        DB::transaction(function () use ($request) {
            // 1. Create Daily Mission (Master Data)
            // DISINI PERUBAHAN UTAMANYA: Kita simpan XP ke tabel induk juga
            $dailyMission = DailyMission::create([
                'date'        => $request->date,
                'title'       => $request->title,
                'description' => $request->description,
                'user_id'     => auth()->id(),
                'xp_read'     => $request->read_xp_reward,   // Simpan XP Baca ke Master
                'xp_engage'   => $request->engage_xp_reward, // Simpan XP Share ke Master
                'xp_quiz'     => $request->quiz_xp_reward,   // Simpan XP Kuis ke Master
            ]);

            // 2. Create Read Task (Detail Task)
            $readTask = DailyMissionTask::create([
                'daily_mission_id' => $dailyMission->id,
                'type' => 'read',
                'xp_reward' => $request->read_xp_reward,
                'required_count' => 1,
                'timer_seconds' => $request->read_timer_seconds,
            ]);

            // Link article to read task
            DailyMissionTaskArticle::create([
                'task_id' => $readTask->id,
                'article_id' => $request->read_article_id,
            ]);

            // 3. Create Engage Task (Detail Task)
            $engageTask = DailyMissionTask::create([
                'daily_mission_id' => $dailyMission->id,
                'type' => 'engage',
                'xp_reward' => $request->engage_xp_reward,
                'required_count' => $request->engage_required_count,
            ]);

            DailyMissionTaskArticle::create([
                'task_id' => $engageTask->id,
                'article_id' => $request->read_article_id,
            ]);

            // 4. Create Quiz Task (Detail Task)
            $quizTask = DailyMissionTask::create([
                'daily_mission_id' => $dailyMission->id,
                'type' => 'quiz',
                'xp_reward' => $request->quiz_xp_reward,
                'required_count' => count($request->quiz_questions),
            ]);

            // Create Quiz Questions & Options
            foreach ($request->quiz_questions as $questionData) {
                $quiz = DailyMissionQuiz::create([
                    'task_id' => $quizTask->id,
                    'question' => $questionData['question'],
                    'explanation' => $questionData['explanation'] ?? null,
                ]);

                foreach ($questionData['options'] as $optionData) {
                    DailyMissionQuizOption::create([
                        'quiz_id' => $quiz->id,
                        'option_text' => $optionData['text'],
                        'is_correct' => $optionData['is_correct'],
                    ]);
                }
            }
        });

        return redirect()->route('admin.daily-missions.index')
            ->with('success', 'Daily mission berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DailyMission $dailyMission)
    {
        $dailyMission->load([
            'tasks.articles.article',
            'tasks.quizzes.options',
            'tasks.userProgress.user'
        ]);

        return view('admin.daily-missions.show', compact('dailyMission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DailyMission $dailyMission)
    {
        $dailyMission->load([
            'tasks.articles.article',
            'tasks.quizzes.options'
        ]);

        $articles = Article::where('status', 'approved')->get();

        return view('admin.daily-missions.edit', compact('dailyMission', 'articles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DailyMission $dailyMission)
    {
        $request->validate([
            'date' => 'required|date|unique:daily_missions,date,' . $dailyMission->id,
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            
            // Read Task
            'read_article_id' => 'required|exists:articles,id',
            'read_xp_reward' => 'required|integer|min:1',
            'read_timer_seconds' => 'required|integer|min:30',
            
            // Engage Task
            'engage_xp_reward' => 'required|integer|min:1',
            'engage_required_count' => 'required|integer|min:1',
            
            // Quiz Task
            'quiz_xp_reward' => 'required|integer|min:1',
            'quiz_questions' => 'required|array|min:1',
            'quiz_questions.*.question' => 'required|string',
            'quiz_questions.*.explanation' => 'nullable|string',
            'quiz_questions.*.options' => 'required|array|min:2|max:4',
            'quiz_questions.*.options.*.text' => 'required|string',
            'quiz_questions.*.options.*.is_correct' => 'required|boolean',
        ]);

        DB::transaction(function () use ($request, $dailyMission) {
            // 1. Update Daily Mission
            // DISINI JUGA KITA UPDATE NILAI XP DI TABEL UTAMA
            $dailyMission->update([
                'date'        => $request->date,
                'title'       => $request->title,
                'description' => $request->description,
                'user_id'     => auth()->id(),
                'xp_read'     => $request->read_xp_reward,   // Update XP Baca
                'xp_engage'   => $request->engage_xp_reward, // Update XP Share
                'xp_quiz'     => $request->quiz_xp_reward,   // Update XP Kuis
            ]);

            // 2. Delete existing tasks and recreate (Strategi Reset)
            // Hapus detail task lama
            $dailyMission->tasks()->delete();

            // Recreate Read Task
            $readTask = DailyMissionTask::create([
                'daily_mission_id' => $dailyMission->id,
                'type' => 'read',
                'xp_reward' => $request->read_xp_reward,
                'required_count' => 1,
                'timer_seconds' => $request->read_timer_seconds,
            ]);

            DailyMissionTaskArticle::create([
                'task_id' => $readTask->id,
                'article_id' => $request->read_article_id,
            ]);

            // Recreate Engage Task
            $engageTask = DailyMissionTask::create([
                'daily_mission_id' => $dailyMission->id,
                'type' => 'engage',
                'xp_reward' => $request->engage_xp_reward,
                'required_count' => $request->engage_required_count,
            ]);

            DailyMissionTaskArticle::create([
                'task_id' => $engageTask->id,
                'article_id' => $request->read_article_id,
            ]);

            // Recreate Quiz Task
            $quizTask = DailyMissionTask::create([
                'daily_mission_id' => $dailyMission->id,
                'type' => 'quiz',
                'xp_reward' => $request->quiz_xp_reward,
                'required_count' => count($request->quiz_questions),
            ]);

            foreach ($request->quiz_questions as $questionData) {
                $quiz = DailyMissionQuiz::create([
                    'task_id' => $quizTask->id,
                    'question' => $questionData['question'],
                    'explanation' => $questionData['explanation'] ?? null,
                ]);

                foreach ($questionData['options'] as $optionData) {
                    DailyMissionQuizOption::create([
                        'quiz_id' => $quiz->id,
                        'option_text' => $optionData['text'],
                        'is_correct' => $optionData['is_correct'],
                    ]);
                }
            }
        });

        return redirect()->route('admin.daily-missions.index')
            ->with('success', 'Daily mission berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DailyMission $dailyMission)
    {
        $dailyMission->delete();
        return redirect()->route('admin.daily-missions.index')
            ->with('success', 'Daily mission berhasil dihapus.');
    }
}