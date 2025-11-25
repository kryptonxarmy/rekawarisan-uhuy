<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LeaderboardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'global'); // global, province, city
        $provinceName = $request->get('province_name');
        $cityName = $request->get('city_name');

        // Query users
        $query = User::query()->orderByDesc('points'); // asumsikan 'points' kolom total XP

        // Filter
        if ($filter === 'province' && $provinceName) {
            $query->where('province', $provinceName);
        } elseif ($filter === 'city' && $provinceName && $cityName) {
            $query->where('province', $provinceName)
                  ->where('regency', $cityName);
        }

        // Ambil 50 besar
        $leaderboard = $query->take(50)->get();

        // Tambahkan rank, level, avatar
        $leaderboard->transform(function($user, $index){
            $user->rank = $index + 1;
            $user->level = floor($user->points / 200); // contoh: 200 XP = 1 level
            $user->total_points = $user->points;
            $user->avatar = 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=0F766E&color=fff';
            return $user;
        });

        // Ambil semua provinsi/kota unik dari users
        $provinces = User::select('province')->distinct()->pluck('province');
        $cities = $provinceName 
            ? User::where('province', $provinceName)->select('regency')->distinct()->pluck('regency')
            : collect();

        return view('admin.leaderboard.index', compact(
            'leaderboard',
            'provinces',
            'cities',
            'filter',
            'provinceName',
            'cityName'
        ));
    }
}
