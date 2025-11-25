<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\MissionProgress;
use App\Models\MissionArticle;
use App\Models\MissionArticleProgress;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    // List semua misi
    public function index()
    {
        return Mission::all();
    }

    // Detail misi
    public function show($id)
    {
        return Mission::with(['creator'])->findOrFail($id);
    }

    // Buat misi baru
    public function store(Request $request)
    {
        $mission = Mission::create($request->all());
        return response()->json($mission, 201);
    }

    // Update misi
    public function update(Request $request, $id)
    {
        $mission = Mission::findOrFail($id);
        $mission->update($request->all());
        return response()->json($mission);
    }

    // Hapus misi
    public function destroy($id)
    {
        Mission::destroy($id);
        return response()->json(null, 204);
    }

    // Progress misi user
    public function userProgress($userId, $missionId)
    {
        return MissionProgress::where('user_id', $userId)
            ->where('mission_id', $missionId)
            ->first();
    }

    // List artikel dalam misi
    public function missionArticles($missionId)
    {
        return MissionArticle::where('mission_id', $missionId)->get();
    }

    // Progress baca artikel dalam misi
    public function articleProgress($missionProgressId, $missionArticleId)
    {
        return MissionArticleProgress::where('mission_progress_id', $missionProgressId)
            ->where('mission_article_id', $missionArticleId)
            ->first();
    }
}
