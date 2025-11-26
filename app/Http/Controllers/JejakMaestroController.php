<?php

namespace App\Http\Controllers;

// --- IMPORT MODEL LENGKAP ---
use App\Models\User;
use App\Models\DailyMission;
use App\Models\Badge;
// ----------------------------

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JejakMaestroController extends Controller
{
    private const LIMIT = 10;

    /**
     * Helper untuk mengambil Misi Induk (Master) yang dibuat Admin hari ini.
     */
    private function getMasterMission()
    {
        $today = Carbon::today();
        
        return DailyMission::whereDate('created_at', $today)
            ->has('tasks') // Hanya ambil misi yang punya tugas (buatan admin)
            ->with(['tasks.article', 'tasks.quizzes.options']) 
            ->orderBy('id', 'desc')
            ->first();
    }

    /**
     * Helper untuk mengambil Leaderboard
     */
    protected function fetchLeaderboard($scope, $value = null)
    {
        $query = User::query()->orderByDesc('points');

        if ($scope === 'province' && $value) {
            $query->where('province', $value);
        }

        if ($scope === 'regency' && $value) {
            $query->where('regency', $value);
        }

        return $query
            ->select('id', 'name', 'points', 'province', 'regency')
            ->limit(self::LIMIT)
            ->get();
    }

    public function index()
    {
        // 1. Cek Login
        if (!Auth::check()) {
            return view('frontend.jejakmaestrobelum.index');
        }

        $user = Auth::user()->fresh();
        $today = Carbon::today();

        // 2. Ambil Master Misi (Data Admin)
        $masterMission = $this->getMasterMission();

        // Default value untuk target poin
        $xpRead   = $masterMission->xp_read ?? 0;
        $xpShare  = $masterMission->xp_engage ?? 0;
        $xpQuiz   = $masterMission->xp_quiz ?? 0;
        $targetTotal = $xpRead + $xpShare + $xpQuiz;

        // 3. FORMAT SOAL ($questions) UNTUK VIEW
        $questions = [];
        
        if ($masterMission) {
            $quizTask = $masterMission->tasks->where('type', 'quiz')->first();

            if ($quizTask && $quizTask->quizzes->isNotEmpty()) {
                $letters = ['A', 'B', 'C', 'D'];
                
                foreach ($quizTask->quizzes as $q) {
                    $options = [];
                    $correctKey = null;

                    foreach ($q->options as $idx => $opt) {
                        if ($idx < 4) {
                            $key = $letters[$idx];
                            $options[$key] = $opt->option_text;
                            if ($opt->is_correct) {
                                $correctKey = $key;
                            }
                        }
                    }

                    $questions[] = (object)[
                        'id' => $q->id,
                        'question' => $q->question,
                        'options' => (object)$options,
                        'correct' => $correctKey
                    ];
                }
            }
        }

        // 4. Cek/Buat Progress User (DailyMission milik User)
        // --- BAGIAN INI SUDAH DIPERBAIKI (Title & Description DIHAPUS agar tidak Error DB) ---
        $dailyMission = DailyMission::firstOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'read_done' => false,
                'share_done' => false,
                'quiz_done' => false,
                'points_today' => 0,
            ]
        );


        // Cek Badge (jika user baru buka halaman tapi poin sudah cukup)
        $this->checkAndAwardBadge($user, $dailyMission->points_today, $targetTotal);
        $user->load('badges');

        $dailyPoints = $dailyMission->points_today ?? 0;

        // 5. Fetch Leaderboard
        $leaderboardIndonesia = $this->fetchLeaderboard('all');
        $leaderboardProvinsi  = $user->province ? $this->fetchLeaderboard('province', $user->province) : collect();
        $leaderboardKota      = $user->regency  ? $this->fetchLeaderboard('regency',  $user->regency) : collect();

        // 6. Return View
        return view('frontend.jejakmaestro.index', [
            'user' => $user,
            'dailyMission' => $dailyMission,   
            'masterMission' => $masterMission, 
            'questions' => $questions,         
            'dailyPoints' => $dailyPoints,
            'targetTotal' => $targetTotal,
            'leaderboardIndonesia' => $leaderboardIndonesia,
            'leaderboardProvinsi' => $leaderboardProvinsi,
            'leaderboardKota' => $leaderboardKota,
            'province' => $user->province,
            'regency' => $user->regency,
        ]);
    }

    // -------------------  AKSI COMPLETE MISI  -------------------

    public function completeRead()
    {
        $user = Auth::user();
        $today = Carbon::today();
        
        $mission = DailyMission::where('user_id', $user->id)
                                ->whereDate('created_at', $today)
                                ->whereNull('xp_read')
                                ->first();

        $master = $this->getMasterMission();
        $poinDapat = $master ? $master->xp_read : 0; 

        // 1. Simpan Poin
        if ($mission && !$mission->read_done) {
            $mission->read_done = true;
            $mission->points_today += $poinDapat;
            $mission->save();

            $user->points += $poinDapat;
            $user->save();
            
            $this->recheckBadge($user, $mission, $master);
        }

        // 2. Redirect Kembali ke Dashboard
        return redirect('/jejak-maestro')->with('success', 'Misi membaca selesai.');
    }

    public function completeShare()
    {
        $user = Auth::user();
        $today = Carbon::today();
        
        $mission = DailyMission::where('user_id', $user->id)
                                ->whereDate('created_at', $today)
                                ->whereNull('xp_read')
                                ->first();

        $master = $this->getMasterMission();
        $poinDapat = $master ? $master->xp_engage : 0;

        if ($mission && !$mission->share_done) {
            $mission->share_done = true;
            $mission->points_today += $poinDapat;
            $mission->save();

            $user->points += $poinDapat;
            $user->save();

            $this->recheckBadge($user, $mission, $master);
        }

        return redirect('/jejak-maestro')->with('success', 'Terima kasih sudah membagikan!');
    }

    public function completeQuiz(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();
        
        // 1. Ambil Progress User
        $mission = DailyMission::where('user_id', $user->id)
                                ->whereDate('created_at', $today)
                                ->whereNull('xp_read')
                                ->first();

        // 2. Ambil Master
        $master = $this->getMasterMission();
        
        // 3. Tentukan Poin (Ambil dari input hidden form)
        if ($request->has('score')) {
            $poinDapat = intval($request->input('score'));
        } else {
            $poinDapat = 0; 
        }

        // 4. Simpan Poin
        if ($mission && !$mission->quiz_done) {
            $mission->quiz_done = true;
            $mission->points_today += $poinDapat;
            $mission->save();

            $user->points += $poinDapat;
            $user->save();

            $this->recheckBadge($user, $mission, $master);
        }

        // 5. Redirect Kembali ke Jejak Maestro
        return redirect('/jejak-maestro')->with('success', "Selamat! Kamu mendapatkan $poinDapat poin dari kuis.");
    }

    // ------------------- HELPERS BADGE -------------------

    private function recheckBadge($user, $mission, $master) {
        $totalTarget = ($master->xp_read ?? 0) + ($master->xp_engage ?? 0) + ($master->xp_quiz ?? 0);
        $this->checkAndAwardBadge($user, $mission->points_today, $totalTarget);
    }

    private function checkAndAwardBadge($user, $currentDailyPoints, $targetTotal)
    {
        if ($targetTotal <= 0) $targetTotal = 1; 

        if ($currentDailyPoints >= ($targetTotal * 0.5)) { 
            $this->giveBadgeToUser($user, 'Pejuang Literasi', 'badge1.png');
        }

        if ($currentDailyPoints >= ($targetTotal * 0.8)) { 
            $this->giveBadgeToUser($user, 'Penjaga Tradisi', 'badge2.png');
        }

        if ($currentDailyPoints >= $targetTotal) { 
            $this->giveBadgeToUser($user, 'Maestro Budaya', 'badge3.png');
        }
    }

    private function giveBadgeToUser($user, $badgeName, $badgeImage)
    {
        $badge = Badge::where('name', $badgeName)->first();

        if ($badge && !$user->badges->contains($badge->id)) {
            $user->badges()->attach($badge->id);
            
            session()->flash('badge_awarded', [
                'name' => $badge->name,
                'image' => $badgeImage
            ]);
        }
    }
}