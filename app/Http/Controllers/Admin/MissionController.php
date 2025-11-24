<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Models\Article;
use App\Models\MissionArticle;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function index()
    {
        $missions = Mission::with('creator')
                          ->orderBy('created_at', 'desc')
                          ->get();
        return view('admin.missions.index', compact('missions'));
    }

    public function create()
    {
        $articles = Article::where('status', 'approved')
                          ->where('is_verified', true)
                          ->orderBy('title')
                          ->get();
        return view('admin.missions.create', compact('articles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:read,quiz',
            'xp_reward' => 'required|integer|min:0',
            'status' => 'required|in:draft,active,inactive,expired',
            'articles' => 'nullable|array',
            'articles.*.id' => 'required|exists:articles,id',
            'articles.*.min_read_time' => 'required|integer|min:1',
            'articles.*.order_index' => 'required|integer|min:1'
        ]);

        $data['created_by'] = auth()->id();

        $mission = Mission::create($data);

        // Add articles to mission if provided
        if (isset($data['articles'])) {
            foreach ($data['articles'] as $articleData) {
                MissionArticle::create([
                    'mission_id' => $mission->id,
                    'article_id' => $articleData['id'],
                    'min_read_time' => $articleData['min_read_time'],
                    'order_index' => $articleData['order_index']
                ]);
            }
        }

        return redirect()->route('admin.missions.index')
                        ->with('success', 'Misi berhasil dibuat');
    }

    public function show(Mission $mission)
    {
        $mission->load('creator');
        $missionArticles = MissionArticle::where('mission_id', $mission->id)
                                       ->with('article')
                                       ->orderBy('order_index')
                                       ->get();
        return view('admin.missions.show', compact('mission', 'missionArticles'));
    }

    public function edit(Mission $mission)
    {
        $articles = Article::where('status', 'approved')
                          ->where('is_verified', true)
                          ->orderBy('title')
                          ->get();

        $missionArticles = MissionArticle::where('mission_id', $mission->id)
                                       ->with('article')
                                       ->orderBy('order_index')
                                       ->get();

        return view('admin.missions.edit', compact('mission', 'articles', 'missionArticles'));
    }

    public function update(Request $request, Mission $mission)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:read,quiz',
            'xp_reward' => 'required|integer|min:0',
            'status' => 'required|in:draft,active,inactive,expired',
            'articles' => 'nullable|array',
            'articles.*.id' => 'required|exists:articles,id',
            'articles.*.min_read_time' => 'required|integer|min:1',
            'articles.*.order_index' => 'required|integer|min:1'
        ]);

        $mission->update($data);

        // Remove existing mission articles
        MissionArticle::where('mission_id', $mission->id)->delete();

        // Add new articles to mission if provided
        if (isset($data['articles'])) {
            foreach ($data['articles'] as $articleData) {
                MissionArticle::create([
                    'mission_id' => $mission->id,
                    'article_id' => $articleData['id'],
                    'min_read_time' => $articleData['min_read_time'],
                    'order_index' => $articleData['order_index']
                ]);
            }
        }

        return redirect()->route('admin.missions.index')
                        ->with('success', 'Misi berhasil diupdate');
    }

    public function destroy(Mission $mission)
    {
        // Delete related mission articles first
        MissionArticle::where('mission_id', $mission->id)->delete();

        $mission->delete();
        return redirect()->route('admin.missions.index')
                        ->with('success', 'Misi berhasil dihapus');
    }
}
