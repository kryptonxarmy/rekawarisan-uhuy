<?php

namespace App\Http\Controllers;

use App\Models\DailyMission;
use Illuminate\Support\Facades\Auth;

class MissionController extends Controller
{
    // ============================
    // 1. Misi Membaca
    // ============================
    public function completeRead()
    {
        $user = Auth::user();

        $mission = DailyMission::firstOrCreate(
            ['user_id' => $user->id],
            ['read_done' => false, 'share_done' => false, 'quiz_done' => false, 'points_today' => 0]
        );

        if (!$mission->read_done) {
            $mission->read_done = true;
            $mission->points_today += 10; // poin membaca
            $mission->save();

            $user->points += 10;
            $user->save();
        }

        return back()->with('success', 'Misi membaca selesai!');
    }

    // ============================
    // 2. Misi Share
    // ============================
    public function completeShare()
    {
        $user = Auth::user();

        $mission = DailyMission::firstOrCreate(
            ['user_id' => $user->id],
            ['read_done' => false, 'share_done' => false, 'quiz_done' => false, 'points_today' => 0]
        );

        if (!$mission->share_done) {
            $mission->share_done = true;
            $mission->points_today += 15; // poin share
            $mission->save();

            $user->points += 15;
            $user->save();
        }

        return back()->with('success', 'Misi membagikan selesai!');
    }

    // ============================
    // 3. Misi Quiz
    // ============================
    public function completeQuiz()
    {
        $user = Auth::user();

        $mission = DailyMission::firstOrCreate(
            ['user_id' => $user->id],
            ['read_done' => false, 'share_done' => false, 'quiz_done' => false, 'points_today' => 0]
        );

        if (!$mission->quiz_done) {
            $mission->quiz_done = true;
            $mission->points_today += 20; // poin quiz
            $mission->save();

            $user->points += 20;
            $user->save();
        }

        return back()->with('success', 'Misi quiz selesai!');
    }
}
