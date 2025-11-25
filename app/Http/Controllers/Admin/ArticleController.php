<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Konstruktor: Semua route hanya untuk admin.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan daftar semua artikel dengan relasi author & category
     */
    public function index()
    {
        $articles = Article::with(['author', 'category'])->latest()->get();
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Form untuk membuat artikel baru
     */
    public function create()
    {
        $categories = ArticleCategory::orderBy('name', 'asc')->get();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Menyimpan artikel baru
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => 'required|string|max:190',
            'content'     => 'required|string|min:50',
            'category_id' => 'required|integer|exists:article_categories,id',
            'province'    => 'nullable|string|max:100',
            'regency'     => 'nullable|string|max:100',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $imgUrlPath = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $slug = Str::slug($request->input('title')) . '-' . time();
            $filename = $slug . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('articles', $filename, 'public');
            $imgUrlPath = Storage::url($path);
        }

        $article = Article::create([
            'author_id'   => Auth::id(),
            'author_type' => Auth::user()->role,
            'title'       => $validatedData['title'],
            'content'     => $validatedData['content'],
            'category_id' => $validatedData['category_id'],
            'province'    => $validatedData['province'] ?? null,
            'regency'     => $validatedData['regency'] ?? null,
            'img_url'     => $imgUrlPath,
            'status'      => 'approved', // Admin langsung approve
            'is_verified' => true,
            'like_count'  => 0,
            'view_count'  => 0,
        ]);

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel berhasil dibuat dan disetujui.');
    }

    /**
     * Form untuk edit artikel
     */
    public function edit(Article $article)
    {
        $categories = ArticleCategory::orderBy('name', 'asc')->get();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    /**
     * Update artikel
     */
    public function update(Request $request, Article $article)
    {
        $validatedData = $request->validate([
            'title'       => 'required|string|max:190',
            'content'     => 'required|string|min:50',
            'category_id' => 'required|integer|exists:article_categories,id',
            'province'    => 'nullable|string|max:100',
            'regency'     => 'nullable|string|max:100',
            'status'      => 'required|in:pending,approved,rejected',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $imgUrlPath = $article->img_url;
        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama
            if ($article->img_url) {
                $pathToDelete = str_replace(Storage::url(''), '', $article->img_url);
                Storage::disk('public')->delete($pathToDelete);
            }

            $file = $request->file('thumbnail');
            $slug = Str::slug($request->input('title')) . '-' . time();
            $filename = $slug . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('articles', $filename, 'public');
            $imgUrlPath = Storage::url($path);
        }

        $article->update([
            'title'       => $validatedData['title'],
            'content'     => $validatedData['content'],
            'category_id' => $validatedData['category_id'],
            'province'    => $validatedData['province'] ?? null,
            'regency'     => $validatedData['regency'] ?? null,
            'status'      => $validatedData['status'],
            'img_url'     => $imgUrlPath,
        ]);

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Hapus artikel
     */
    public function destroy(Article $article)
    {
        if ($article->img_url) {
            $pathToDelete = str_replace(Storage::url(''), '', $article->img_url);
            Storage::disk('public')->delete($pathToDelete);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel berhasil dihapus.');
    }

    /**
     * Approve artikel
     */
    public function approve(Article $article)
    {
        $article->update(['status' => 'approved']);
        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel disetujui.');
    }


    public function show(Article $article)
{
    $article->load('category', 'comments.user');

    $relatedArticles = Article::where('category_id', $article->category_id)
                              ->where('id', '!=', $article->id)
                              ->take(4)
                              ->get();

    return view('admin.articles.show', compact('article', 'relatedArticles'));
}

    /**
     * Reject artikel
     */
    public function reject(Article $article)
    {
        $article->update(['status' => 'rejected']);
        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel ditolak.');
    }
}
