<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DailyMission;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        $dailyMission = DailyMission::firstOrCreate(
            ['user_id' => $user->id],
            [
                'read_done' => false,
                'share_done' => false,
                'quiz_done' => false,
                'points_today' => 0
            ]
        );

        $this->checkAndAwardBadge($user, $dailyMission->points_today);
        $user->load('badges');

        $dailyPoints = $dailyMission->points_today ?? 0;

        $province = $user->province;
        $regency  = $user->regency;

        $leaderboardIndonesia = $this->fetchLeaderboard('all');
        $leaderboardProvinsi  = $province ? $this->fetchLeaderboard('province', $province) : collect();
        $leaderboardKota      = $regency  ? $this->fetchLeaderboard('regency',  $regency) : collect();

        return view('frontend.jejakmaestro.index', [
            'user' => $user,
            'dailyMission' => $dailyMission,
            'dailyPoints' => $dailyPoints,
            'leaderboardIndonesia' => $leaderboardIndonesia,
            'leaderboardProvinsi' => $leaderboardProvinsi,
            'leaderboardKota' => $leaderboardKota,
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

            $this->checkAndAwardBadge($user, $mission->points_today);
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

            $this->checkAndAwardBadge($user, $mission->points_today);
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

            $this->checkAndAwardBadge($user, $mission->points_today);
        }

        return redirect()->back();
    }

    private function checkAndAwardBadge($user, $currentDailyPoints)
    {
        if ($currentDailyPoints >= 100) {
            $this->giveBadgeToUser($user, 'Pejuang Literasi', 'badge1.png');
        }

        if ($currentDailyPoints >= 150) {
            $this->giveBadgeToUser($user, 'Penjaga Tradisi', 'badge2.png');
        }

        if ($currentDailyPoints >= 200) {
            $this->giveBadgeToUser($user, 'Maestro Budaya', 'badge3.png');
        }
    }

    private function giveBadgeToUser($user, $badgeName, $badgeImage)
    {
        $badge = Badge::where('name', $badgeName)->first();

        if ($badge && !$user->badges->contains($badge->id)) {
            $user->badges()->attach($badge->id);

            // ✔ Perbaikan dari controller kedua (HANYA INI DITAMBAHKAN)
            session()->flash('badge_awarded', [
                'name' => $badge->name, // diperbaiki
                'image' => $badgeImage
            ]);
        }
    }
}
