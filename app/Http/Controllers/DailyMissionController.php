<?php

namespace App\Http\Controllers;

use App\Models\DailyMission;
use App\Models\DailyMissionUserProgress;
use App\Models\DailyMissionTask;
use App\Models\DailyMissionQuiz;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DailyMissionController extends Controller
{
    /**
     * Display today's daily mission.
     */
    public function index()
    {
        $dailyMission = DailyMission::today();
        
        if (!$dailyMission) {
            return view('daily-missions.no-mission');
        }

        $user = Auth::user();
        $userProgress = [];

        foreach ($dailyMission->tasks as $task) {
            $progress = DailyMissionUserProgress::firstOrCreate([
                'user_id' => $user->id,
                'task_id' => $task->id,
            ], [
                'status' => 'pending',
                'earned_xp' => 0,
            ]);
            
            $userProgress[$task->type] = $progress;
        }

        return view('daily-missions.index', compact('dailyMission', 'userProgress'));
    }

    /**
     * Show specific daily mission by date.
     */
    public function show($date)
    {
        $dailyMission = DailyMission::byDate($date);
        
        if (!$dailyMission) {
            abort(404, 'Daily mission not found for this date.');
        }

        $user = Auth::user();
        $userProgress = [];

        foreach ($dailyMission->tasks as $task) {
            $progress = DailyMissionUserProgress::where([
                'user_id' => $user->id,
                'task_id' => $task->id,
            ])->first();
            
            $userProgress[$task->type] = $progress;
        }

        return view('daily-missions.show', compact('dailyMission', 'userProgress'));
    }

    /**
     * Start reading task.
     */
    public function startReading(Request $request)
    {
        $taskId = $request->input('task_id');
        $task = DailyMissionTask::findOrFail($taskId);
        
        // Get the article for this task
        $article = $task->articles()->first()->article;
        
        // Record start time in session
        $request->session()->put("reading_start_$taskId", now());
        
        return redirect()->route('articles.show', $article);
    }

    /**
     * Complete reading task.
     */
    public function completeReading(Request $request)
    {
        $taskId = $request->input('task_id');
        $task = DailyMissionTask::findOrFail($taskId);
        
        $startTime = $request->session()->get("reading_start_$taskId");
        
        if (!$startTime) {
            return back()->with('error', 'Reading session not found.');
        }

        $readingTime = now()->diffInSeconds($startTime);
        $requiredTime = $task->timer_seconds;

        $progress = DailyMissionUserProgress::where([
            'user_id' => Auth::id(),
            'task_id' => $taskId,
        ])->first();

        if ($readingTime >= $requiredTime) {
            $progress->markCompleted();
            $request->session()->forget("reading_start_$taskId");
            
            return redirect()->route('daily-missions.index')
                ->with('success', "Misi baca selesai! Anda mendapat {$task->xp_reward} XP.");
        } else {
            return back()->with('error', 'Waktu baca belum mencukupi.');
        }
    }

    /**
     * Complete engage task (like & comment).
     */
    public function completeEngage(Request $request)
    {
        $taskId = $request->input('task_id');
        $task = DailyMissionTask::findOrFail($taskId);
        
        // Get the article for this task
        $article = $task->articles()->first()->article;
        
        // Check if user has liked and commented
        $hasLiked = $article->likes()->where('user_id', Auth::id())->exists();
        $hasCommented = Comment::where([
            'article_id' => $article->id,
            'user_id' => Auth::id(),
        ])->exists();

        $progress = DailyMissionUserProgress::where([
            'user_id' => Auth::id(),
            'task_id' => $taskId,
        ])->first();

        if ($hasLiked && $hasCommented) {
            $progress->markCompleted();
            
            return back()->with('success', "Misi engage selesai! Anda mendapat {$task->xp_reward} XP.");
        } else {
            return back()->with('error', 'Anda harus like dan komen artikel untuk menyelesaikan misi ini.');
        }
    }

    /**
     * Start quiz task.
     */
    public function startQuiz(Request $request)
    {
        $taskId = $request->input('task_id');
        $task = DailyMissionTask::findOrFail($taskId);
        
        return view('daily-missions.quiz', compact('task'));
    }

    /**
     * Submit quiz answers.
     */
    public function submitQuiz(Request $request)
    {
        $taskId = $request->input('task_id');
        $task = DailyMissionTask::findOrFail($taskId);
        $answers = $request->input('answers', []);

        $quizzes = $task->quizzes;
        $correctAnswers = 0;
        $totalQuestions = $quizzes->count();

        foreach ($quizzes as $quiz) {
            $userAnswer = $answers[$quiz->id] ?? null;
            $correctOption = $quiz->correctOption();
            
            if ($userAnswer && $correctOption && $userAnswer == $correctOption->id) {
                $correctAnswers++;
            }
        }

        $score = ($correctAnswers / $totalQuestions) * 100;
        $passed = $score >= 70; // 70% passing score

        $progress = DailyMissionUserProgress::where([
            'user_id' => Auth::id(),
            'task_id' => $taskId,
        ])->first();

        if ($passed) {
            $progress->markCompleted();
            $message = "Quiz selesai! Skor: {$score}%. Anda mendapat {$task->xp_reward} XP.";
        } else {
            $progress->markFailed();
            $message = "Quiz gagal. Skor: {$score}%. Anda harus mencapai skor minimal 70%.";
        }

        return redirect()->route('daily-missions.index')->with('success', $message);
    }

    /**
     * Get user's daily mission history.
     */
    public function history()
    {
        $user = Auth::user();
        
        $history = DailyMissionUserProgress::whereHas('task.dailyMission')
            ->where('user_id', $user->id)
            ->with(['task.dailyMission'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('daily-missions.history', compact('history'));
    }
}
