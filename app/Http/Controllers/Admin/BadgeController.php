<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Badge;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class BadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua badge dan menghitung jumlah user yang memilikinya
        $badges = Badge::withCount('users')->get(); 
        
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
        // 1. Validasi Input
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:badges,name',
            'description' => 'required|string',
            'points_requirement' => 'required|integer|min:0', 
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048', 
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('badges', 'public');
        }

        // 2. Simpan Badge Baru ke Database
        $badge = Badge::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'points_requirement' => $validated['points_requirement'],
            'image' => $imagePath, 
        ]);

        // 3. LOGIKA OTOMATIS: Berikan Badge ke User yang SUDAH Memenuhi Syarat (Retroaktif)
        $eligibleUsers = User::where('points', '>=', $badge->points_requirement)->get();

        $awardedCount = 0;
        if ($eligibleUsers->isNotEmpty()) {
            foreach ($eligibleUsers as $user) {
                $user->badges()->syncWithoutDetaching([$badge->id]);
                $awardedCount++;
            }
        }
        
        // 4. Redirect
        return redirect()->route('admin.badges.index')
            ->with('success', "Badge '{$badge->name}' berhasil dibuat dan diberikan kepada {$awardedCount} user yang telah memenuhi syarat.");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $badge = Badge::findOrFail($id);
        return view('admin.badges.edit', compact('badge'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $badge = Badge::findOrFail($id);

        // 1. Validasi Input
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:badges,name,' . $badge->id, 
            'description' => 'required|string', 
            'points_requirement' => 'required|integer|min:0', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048', 
        ]);

        $updateData = [
            'name' => $validated['name'],
            'description' => $validated['description'],
            'points_requirement' => $validated['points_requirement'],
        ];

        // 2. Logika Update Gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama (jika ada) dan upload gambar baru
            if ($badge->image && !str_contains($badge->image, 'assets/') && Storage::disk('public')->exists($badge->image)) {
                 Storage::disk('public')->delete($badge->image);
            }
            $updateData['image'] = $request->file('image')->store('badges', 'public');
        } 

        // 3. Update data badge (PENTING: Pastikan ini berjalan sebelum re-evaluasi)
        $badge->update($updateData);

        // 4. LOGIKA RE-EVALUASI (PEMBERIAN & PENCABUTAN)
        // Ambil ID semua user yang memenuhi syarat BARU (termasuk yang tidak memenuhi syarat lagi)
        $eligibleUserIds = User::where('points', '>=', $badge->points_requirement)->pluck('id')->toArray();

        // sync() akan mencabut dari yang tidak eligible dan memasang ke yang eligible
        $badge->users()->sync($eligibleUserIds); 

        $awardedCount = count($eligibleUserIds);

        // 5. Redirect
        return redirect()->route('admin.badges.index')
            ->with('success', "Badge '{$badge->name}' berhasil diupdate. Saat ini, {$awardedCount} user telah memenuhi syarat.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $badge = Badge::findOrFail($id);

        // Hapus gambar dari storage (hanya yang diupload, bukan yang static assets)
        if ($badge->image && !str_contains($badge->image, 'assets/') && Storage::disk('public')->exists($badge->image)) {
            Storage::disk('public')->delete($badge->image);
        }

        $badge->delete();
        
        return redirect()->route('admin.badges.index')
            ->with('success', 'Badge berhasil dihapus.');
    }
}