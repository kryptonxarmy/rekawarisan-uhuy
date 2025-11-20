<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DailyMission;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JejakMaestroController extends Controller
{
    /**
     * Menampilkan halaman utama Jejak Maestro
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // 1. Ambil atau buat misi harian
        // Tips: Tambahkan whereDate('created_at', today()) jika ingin reset setiap hari
        $dailyMission = DailyMission::firstOrCreate(
            ['user_id' => $user->id],
            [
                'read_done' => false,
                'share_done' => false,
                'quiz_done' => false,
                'points_today' => 0
            ]
        );

        // 2. CEK OTOMATIS SAAT HALAMAN DIBUKA (Solusi Masalah Anda)
        // Ini akan memaksa sistem mengecek poin user saat ini, dan memberi badge jika layak.
        $this->checkAndAwardBadge($user, $dailyMission->points_today);

        // 3. Refresh data user agar badge yang baru ditambahkan langsung muncul di View
        $user->load('badges');

        // Leaderboard Logic
        $leaderboardIndonesia = User::orderByDesc('points')->take(10)->get();
        $leaderboardProvinsi  = User::whereNotNull('province')->orderByDesc('points')->take(10)->get();
        $leaderboardKota      = User::whereNotNull('regency')->orderByDesc('points')->take(10)->get();

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

    /**
     * Logika Misi 1: Membaca (+10 Poin)
     */
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

    /**
     * Logika Misi 2: Kuis (+40 Poin)
     */
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

    /**
     * Logika Misi 3: Share (+100 Poin)
     */
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

    /**
     * Helper: Cek Poin & Berikan Badge
     * Logika: Menggunakan IF terpisah (Stacked) agar user bisa dapat multiple badge sekaligus
     */
    private function checkAndAwardBadge($user, $currentDailyPoints)
    {
        // Cek Badge Tier 1 (>= 100 Poin)
        if ($currentDailyPoints >= 100) {
            $this->giveBadgeToUser($user, 'Pejuang Literasi', 'badge1.png');
        }

        // Cek Badge Tier 2 (>= 150 Poin)
        if ($currentDailyPoints >= 150) {
            $this->giveBadgeToUser($user, 'Penjaga Tradisi', 'badge2.png');
        }

        // Cek Badge Tier 3 (>= 200 Poin)
        if ($currentDailyPoints >= 200) {
            $this->giveBadgeToUser($user, 'Maestro Budaya', 'badge3.png');
        }
    }

    /**
     * Helper Kecil untuk Assign Badge ke Database
     */
    private function giveBadgeToUser($user, $badgeName, $badgeImage)
    {
        // Cari badge di database
        $badge = Badge::where('name', $badgeName)->first();

        // Jika badge ditemukan DAN user belum punya
        if ($badge && !$user->badges->contains($badge->id)) {
            
            // Simpan ke database
            $user->badges()->attach($badge->id);

            // Optional: Kirim notif flash message (Popup akan muncul saat refresh page)
            session()->flash('badge_awarded', [
                'name' => $badge->name,
                'image' => $badgeImage 
            ]);
        }
    }
}