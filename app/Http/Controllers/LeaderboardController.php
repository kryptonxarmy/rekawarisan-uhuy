<?php

namespace App\Http\Controllers;

use App\Models\Leaderboard;

class LeaderboardController extends Controller
{
    public function national()
    {
        return Leaderboard::with('user')
            ->orderByDesc('points')
            ->limit(10)
            ->get();
    }

    public function province($province)
    {
        return Leaderboard::with('user')
            ->where('province', $province)
            ->orderByDesc('points')
            ->limit(10)
            ->get();
    }

    public function city($city)
    {
        return Leaderboard::with('user')
            ->where('city', $city)
            ->orderByDesc('points')
            ->limit(10)
            ->get();
    }
}
