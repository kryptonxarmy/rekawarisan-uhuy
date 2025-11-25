<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DailyMission;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage; 

class JejakMaestroController extends Controller
{
    private const LIMIT = 10;

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
        if (!Auth::check()) {
            return view('frontend.jejakmaestrobelum.index');
        }

        $user = Auth::user()->fresh();

        // PERBAIKAN SQL Error 1364: user_id ditambahkan ke array creation
        $dailyMission = DailyMission::firstOrCreate(
            ['user_id' => $user->id], 
            [
                'user_id' => $user->id, // <<< MEMPERBAIKI SQL ERROR
                'read_done' => false,
                'share_done' => false,
                'quiz_done' => false,
                'points_today' => 0
            ]
        );

        // Panggil fungsi re-evaluasi DYNAMIC (membaca Syarat Poin dari DB)
        $this->handleBadgeReEvaluation($user); 
        $user->load('badges'); 

        $dailyPoints = $dailyMission->points_today ?? 0;
        $province = $user->province;
        $regency  = $user->regency;

        return view('frontend.jejakmaestro.index', [
            'user' => $user,
            'dailyMission' => $dailyMission,
            'dailyPoints' => $dailyPoints,
            'leaderboardIndonesia' => $this->fetchLeaderboard('all'),
            'leaderboardProvinsi' => $province ? $this->fetchLeaderboard('province', $province) : collect(),
            'leaderboardKota' => $regency ? $this->fetchLeaderboard('regency', $regency) : collect(),
            'province' => $province,
            'regency' => $regency,
        ]);
    }

    public function completeRead()
    {
        $user = Auth::user();
        $mission = DailyMission::where('user_id', $user->id)->first();
        if ($mission && !$mission->read_done) {
            $mission->read_done = true;
            $mission->points_today += 10;
            $mission->save();

            $user->points += 10;
            $user->save();
            $this->handleBadgeReEvaluation($user); // Panggil DYNAMIC logic
        }
        return redirect()->back();
    }

    public function completeQuiz(Request $request)
    {
        $user = Auth::user();
        $mission = DailyMission::where('user_id', $user->id)->first();
        if ($mission && !$mission->quiz_done) {
            $mission->quiz_done = true;
            $mission->points_today += 40;
            $mission->save();

            $user->points += 40;
            $user->save();
            $this->handleBadgeReEvaluation($user); // Panggil DYNAMIC logic
        }
        return redirect()->back();
    }

    public function completeShare()
    {
        $user = Auth::user();
        $mission = DailyMission::where('user_id', $user->id)->first();
        if ($mission && !$mission->share_done) {
            $mission->share_done = true;
            $mission->points_today += 100;
            $mission->save();

            $user->points += 100;
            $user->save();
            $this->handleBadgeReEvaluation($user); // Panggil DYNAMIC logic
        }
        return redirect()->back();
    }
    
    // --- FUNGSI DYNAMIC PENGGANTI LOGIKA HARDCODE LAMA ---
    private function handleBadgeReEvaluation(User $user)
    {
        $allBadges = Badge::all();
        $awardedBadge = null;

        foreach ($allBadges as $badge) {
            if ($user->points >= $badge->points_requirement) {
                if (!$user->badges->contains($badge->id)) {
                    $user->badges()->attach($badge->id);
                    $awardedBadge = $badge;
                }
            } 
        }

        if ($awardedBadge) {
            $this->flashBadgeAwardedNotification($awardedBadge);
        }
    }

    private function flashBadgeAwardedNotification(Badge $badge)
    {
        $badgeImagePath = '';
        
        if (str_contains($badge->image, 'assets/')) {
            $badgeImagePath = asset($badge->image);
        } else {
            $badgeImagePath = Storage::url($badge->image);
        }

        session()->flash('badge_awarded', [
            'name' => $badge->name, 
            'image' => $badgeImagePath 
        ]);
    }
}