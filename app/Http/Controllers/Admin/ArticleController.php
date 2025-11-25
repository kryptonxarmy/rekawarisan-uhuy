<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles with tabs.
     */
    public function index()
    {
        // Load all articles with relationships
        $articles = Article::with(['author', 'category'])->latest()->get();

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new article
     */
    public function create()
    {
        $categories = ArticleCategory::all();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created article in storage
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'img_url' => 'nullable|url',
            'category_id' => 'nullable|exists:article_categories,id',
            'status' => 'required|in:draft,pending,published',
        ]);

        $data['author_id'] = auth()->id();
        $data['author_type'] = 'admin';

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dibuat.');
    }

    /**
     * Show the form for editing an article
     */
    public function edit(Article $article)
    {
        $categories = ArticleCategory::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    /**
     * Update an article
     */
    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'img_url' => 'nullable|url',
            'category_id' => 'nullable|exists:article_categories,id',
            'status' => 'required|in:draft,pending,published',
        ]);

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diupdate.');
    }

    /**
     * Delete an article
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }

    /**
     * Approve article (for user-submitted articles)
     */
    public function approve(Article $article)
    {
        $article->update(['status' => 'approved']);
        return redirect()->route('admin.articles.index')->with('success', 'Artikel disetujui.');
    }

    /**
     * Reject article (for user-submitted articles)
     */
    public function reject(Article $article)
    {
        $article->update(['status' => 'rejected']);
        return redirect()->route('admin.articles.index')->with('success', 'Artikel ditolak.');
    }
}
