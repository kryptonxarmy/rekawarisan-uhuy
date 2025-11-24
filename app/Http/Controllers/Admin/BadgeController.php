<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // For now, returning dummy data for UI development
        $badges = collect([
            (object) [
                'id' => 1,
                'name' => 'Pemula Budaya',
                'description' => 'Badge untuk pengguna yang telah menyelesaikan misi pertama',
                'icon' => 'star',
                'color' => '#10B981',
                'requirements' => 'Selesaikan 1 misi harian',
                'xp_reward' => 50,
                'users_count' => 245,
                'created_at' => now()->subDays(30),
            ],
            (object) [
                'id' => 2,
                'name' => 'Pelestari Warisan',
                'description' => 'Badge untuk pengguna yang aktif membaca artikel warisan',
                'icon' => 'book-open',
                'color' => '#3B82F6',
                'requirements' => 'Baca 10 artikel warisan budaya',
                'xp_reward' => 100,
                'users_count' => 156,
                'created_at' => now()->subDays(25),
            ],
            (object) [
                'id' => 3,
                'name' => 'Maestro Jejak',
                'description' => 'Badge untuk pengguna yang menyelesaikan semua misi dalam sebulan',
                'icon' => 'trophy',
                'color' => '#F59E0B',
                'requirements' => 'Selesaikan 30 misi harian berturut-turut',
                'xp_reward' => 500,
                'users_count' => 23,
                'created_at' => now()->subDays(15),
            ],
        ]);

        return view('admin.badges.index', compact('badges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.badges.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO: Implement badge creation logic
        
        return redirect()->route('admin.badges.index')
            ->with('success', 'Badge berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // TODO: Show specific badge
        return view('admin.badges.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // TODO: Show edit form
        return view('admin.badges.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // TODO: Update badge logic
        
        return redirect()->route('admin.badges.index')
            ->with('success', 'Badge berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // TODO: Delete badge logic
        
        return redirect()->route('admin.badges.index')
            ->with('success', 'Badge berhasil dihapus');
    }
}
