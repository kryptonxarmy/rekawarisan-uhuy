<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\FaktaCepat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles and fakta cepat with tabs
     */
    public function index()
    {
        // Load all articles with relationships
        $articles = Article::with(['author', 'category'])->latest()->get();
        
        // Load all fakta cepat with relationships
        $faktaCepats = FaktaCepat::with('author')->latest()->get();
        
        return view('admin.articles.index', compact('articles', 'faktaCepats'));
    }

    /**
     * Show the form for creating a new article
     */
    public function create()
    {
        $categories = ArticleCategory::all();
        // Load approved fakta cepat for dropdown
        $faktaCepats = FaktaCepat::approved()->get();
        
        return view('admin.articles.create', compact('categories', 'faktaCepats'));
    }

    /**
     * Store a newly created article
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:article_categories,id',
            'province' => 'nullable|string|max:255',
            'regency' => 'nullable|string|max:255',
            'fakta_cepat_id' => 'nullable|exists:fakta_cepats,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'img_url' => 'nullable|url'
        ]);

        $data = $validated;

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('articles', 'public');
            $data['img_url'] = Storage::url($path);
        }

        // Set author info
        $data['author_id'] = auth()->id();
        $data['author_type'] = 'admin';
        $data['is_verified'] = true;
        // Admin articles are auto-approved
        $data['status'] = 'approved';

        Article::create($data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil ditambahkan');
    }

    /**
     * Display the specified article
     */
    public function show(Article $article)
    {
        $article->load(['author', 'category', 'faktaCepat']);
        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified article
     */
    public function edit(Article $article)
    {
        $categories = ArticleCategory::all();
        $faktaCepats = FaktaCepat::approved()->get();
        
        return view('admin.articles.edit', compact('article', 'categories', 'faktaCepats'));
    }

    /**
     * Update the specified article
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:article_categories,id',
            'province' => 'nullable|string|max:255',
            'regency' => 'nullable|string|max:255',
            'fakta_cepat_id' => 'nullable|exists:fakta_cepats,id',
            'status' => 'required|in:pending,approved,rejected',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'img_url' => 'nullable|url'
        ]);

        $data = $validated;

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old image if exists and img_url contains local storage path
            if ($article->img_url && str_contains($article->img_url, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $article->img_url);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('thumbnail')->store('articles', 'public');
            $data['img_url'] = Storage::url($path);
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui');
    }

    /**
     * Remove the specified article
     */
    public function destroy(Article $article)
    {
        // Delete image if exists and img_url contains local storage path
        if ($article->img_url && str_contains($article->img_url, '/storage/')) {
            $oldPath = str_replace('/storage/', '', $article->img_url);
            Storage::disk('public')->delete($oldPath);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus');
    }

    /**
     * Approve an article (for user submissions)
     */
    public function approve(Article $article)
    {
        $article->update([
            'status' => 'approved',
            'is_verified' => true
        ]);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil disetujui');
    }

    /**
     * Reject an article (for user submissions)
     */
    public function reject(Article $article)
    {
        $article->update([
            'status' => 'rejected',
            'is_verified' => false
        ]);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel ditolak');
    }
}
