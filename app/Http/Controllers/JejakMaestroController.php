<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DailyMission;
use Illuminate\Support\Facades\Auth;

class JejakMaestroController extends Controller
{
    public function index()
    {
        // Pastikan user login
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Ambil atau buat misi harian
        $dailyMission = DailyMission::firstOrCreate(
            ['user_id' => $user->id],
            [
                'read_done' => false,
                'share_done' => false,
                'quiz_done' => false,
                'points_today' => 0,
            ]
        );

        // Leaderboard Nasional
        $leaderboardIndonesia = User::orderBy('points', 'desc')
            ->take(10)
            ->get();

        // Leaderboard Provinsi
        $leaderboardProvinsi = User::whereNotNull('province')
            ->orderBy('points', 'desc')
            ->take(10)
            ->get();

        // Leaderboard Kota
        $leaderboardKota = User::whereNotNull('regency')
            ->orderBy('points', 'desc')
            ->take(10)
            ->get();

        // Daily points
        $dailyPoints = $dailyMission->points_today ?? 0;

        return view('frontend.jejakmaestro.index', [
            'user' => $user,
            'dailyMission' => $dailyMission,
            'dailyPoints' => $dailyPoints,
            'leaderboardIndonesia' => $leaderboardIndonesia,
            'leaderboardProvinsi' => $leaderboardProvinsi,
            'leaderboardKota' => $leaderboardKota,
        ]);
    }
}
