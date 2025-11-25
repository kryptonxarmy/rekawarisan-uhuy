<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'global'); // global, province, city
        $provinceId = $request->get('province_id');
        $cityId = $request->get('city_id');

        // Dummy provinces data
        $provinces = collect([
            (object) ['id' => 1, 'name' => 'DKI Jakarta'],
            (object) ['id' => 2, 'name' => 'Jawa Barat'],
            (object) ['id' => 3, 'name' => 'Jawa Tengah'],
            (object) ['id' => 4, 'name' => 'Jawa Timur'],
            (object) ['id' => 5, 'name' => 'Bali'],
            (object) ['id' => 6, 'name' => 'Yogyakarta'],
        ]);

        // Dummy cities data
        $cities = collect([
            (object) ['id' => 1, 'name' => 'Jakarta Pusat', 'province_id' => 1],
            (object) ['id' => 2, 'name' => 'Jakarta Selatan', 'province_id' => 1],
            (object) ['id' => 3, 'name' => 'Jakarta Timur', 'province_id' => 1],
            (object) ['id' => 4, 'name' => 'Bandung', 'province_id' => 2],
            (object) ['id' => 5, 'name' => 'Bekasi', 'province_id' => 2],
            (object) ['id' => 6, 'name' => 'Bogor', 'province_id' => 2],
            (object) ['id' => 7, 'name' => 'Semarang', 'province_id' => 3],
            (object) ['id' => 8, 'name' => 'Solo', 'province_id' => 3],
            (object) ['id' => 9, 'name' => 'Surabaya', 'province_id' => 4],
            (object) ['id' => 10, 'name' => 'Malang', 'province_id' => 4],
            (object) ['id' => 11, 'name' => 'Denpasar', 'province_id' => 5],
            (object) ['id' => 12, 'name' => 'Yogyakarta', 'province_id' => 6],
        ]);

        // Filter cities based on selected province
        if ($provinceId) {
            $cities = $cities->where('province_id', $provinceId);
        }

        // Global Leaderboard Data
        $globalLeaderboard = collect([
            (object) [
                'id' => 1,
                'name' => 'Ahmad Suryadi',
                'email' => 'ahmad@example.com',
                'avatar' => 'https://ui-avatars.com/api/?name=Ahmad+Suryadi&background=0F766E&color=fff',
                'province' => 'DKI Jakarta',
                'city' => 'Jakarta Pusat',
                'total_xp' => 2850,
                'level' => 15,
                'badges_count' => 12,
                'missions_completed' => 45,
                'rank' => 1,
                'streak_days' => 28
            ],
            (object) [
                'id' => 2,
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@example.com',
                'avatar' => 'https://ui-avatars.com/api/?name=Siti+Nurhaliza&background=059669&color=fff',
                'province' => 'Jawa Barat',
                'city' => 'Bandung',
                'total_xp' => 2640,
                'level' => 14,
                'badges_count' => 10,
                'missions_completed' => 42,
                'rank' => 2,
                'streak_days' => 25
            ],
            (object) [
                'id' => 3,
                'name' => 'Bambang Wijaya',
                'email' => 'bambang@example.com',
                'avatar' => 'https://ui-avatars.com/api/?name=Bambang+Wijaya&background=DC2626&color=fff',
                'province' => 'Jawa Tengah',
                'city' => 'Semarang',
                'total_xp' => 2380,
                'level' => 13,
                'badges_count' => 9,
                'missions_completed' => 38,
                'rank' => 3,
                'streak_days' => 22
            ],
            (object) [
                'id' => 4,
                'name' => 'Dewi Sartika',
                'email' => 'dewi@example.com',
                'avatar' => 'https://ui-avatars.com/api/?name=Dewi+Sartika&background=7C3AED&color=fff',
                'province' => 'Bali',
                'city' => 'Denpasar',
                'total_xp' => 2150,
                'level' => 12,
                'badges_count' => 8,
                'missions_completed' => 35,
                'rank' => 4,
                'streak_days' => 18
            ],
            (object) [
                'id' => 5,
                'name' => 'Andi Pratama',
                'email' => 'andi@example.com',
                'avatar' => 'https://ui-avatars.com/api/?name=Andi+Pratama&background=F59E0B&color=fff',
                'province' => 'Yogyakarta',
                'city' => 'Yogyakarta',
                'total_xp' => 1980,
                'level' => 11,
                'badges_count' => 7,
                'missions_completed' => 32,
                'rank' => 5,
                'streak_days' => 15
            ],
        ]);

        // Filter leaderboard based on selection
        $leaderboard = $globalLeaderboard;
        $selectedProvince = null;
        $selectedCity = null;

        if ($filter === 'province' && $provinceId) {
            $selectedProvince = $provinces->where('id', $provinceId)->first();
            $leaderboard = $globalLeaderboard->where('province', $selectedProvince->name);
        } elseif ($filter === 'city' && $cityId) {
            $selectedCity = $cities->where('id', $cityId)->first();
            if ($selectedCity) {
                $selectedProvince = $provinces->where('id', $selectedCity->province_id)->first();
                $leaderboard = $globalLeaderboard->where('city', $selectedCity->name);
            }
        }

        // Re-rank after filtering
        $leaderboard = $leaderboard->values()->map(function ($user, $index) {
            $user->rank = $index + 1;
            return $user;
        });

        return view('admin.leaderboard.index', compact(
            'leaderboard', 
            'provinces', 
            'cities', 
            'filter', 
            'provinceId', 
            'cityId',
            'selectedProvince',
            'selectedCity'
        ));
    }
}
