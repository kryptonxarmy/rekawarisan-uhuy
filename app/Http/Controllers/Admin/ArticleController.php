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
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'thumbnail'    => 'nullable|image|max:2048',
            'category_id'  => 'nullable|exists:article_categories,id',
            'province'     => 'nullable|string', // gunakan nama, bukan id
            'regency'      => 'nullable|string',
        ]);

if ($request->hasFile('thumbnail')) {
    $file = $request->file('thumbnail');
    $filename = time() . '_' . $file->getClientOriginalName();

    // Simpan langsung ke public/articles
    $file->move(public_path('articles'), $filename);

    // Simpan path untuk asset()
    $data['img_url'] = 'articles/' . $filename;
}


        // Simpan identitas author
        $data['author_id']   = auth()->id();
        $data['author_type'] = auth()->user()->role;

        // Penentuan status
        $data['status'] = auth()->user()->role === 'admin'
                        ? 'approved'
                        : 'pending';

        Article::create($data);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dibuat.');
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
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'thumbnail'   => 'nullable|image|max:2048',
            'category_id' => 'nullable|exists:article_categories,id',
            'status'      => 'required|in:pending,approved,rejected',
            'province'    => 'nullable|string',
            'regency'     => 'nullable|string',
        ]);

        // Jika update thumbnail
        if ($request->hasFile('thumbnail')) {
            $data['img_url'] = $request->file('thumbnail')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel berhasil diupdate.');
    }

    /**
     * Delete an article
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel berhasil dihapus.');
    }

    /**
     * Approve article
     */
    public function approve(Article $article)
    {
        $article->update(['status' => 'approved']);

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel disetujui.');
    }

    /**
     * Reject article
     */
    public function reject(Article $article)
    {
        $article->update(['status' => 'rejected']);

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel ditolak.');
    }
}
