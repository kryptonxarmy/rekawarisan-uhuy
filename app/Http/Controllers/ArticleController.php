<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;
use App\Models\ArticleCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; // Digunakan untuk operasi seperti like/comment jika tidak menggunakan model terpisah
use Illuminate\Support\Facades\Auth; // Digunakan untuk mendapatkan user yang sedang login

class ArticleController extends Controller
{
    /**
     * Konstruktor: Menerapkan middleware autentikasi.
     */
    public function __construct()
    {
        // Semua fungsi memerlukan otentikasi kecuali 'index' dan 'show'
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Menampilkan daftar semua artikel.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Hanya tampilkan artikel yang sudah diverifikasi (status 'published' atau 'verified')
        $articles = Article::where('status', 'approved')
                           ->orderBy('created_at', 'desc')
                           ->paginate(10);

        return view('frontend.pustakawarisan.index', compact('articles'));
    }

    /**
     * Menampilkan formulir untuk membuat artikel baru.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = ArticleCategory::orderBy('name', 'asc')->get();
        return view('frontend.pustakawarisan.create', compact('categories'));
    }


    /**
     * Menyimpan artikel baru ke database.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:190',
            'content' => 'required|string|min:50', // Menggunakan 'content'
            'category_id' => 'required|integer|exists:article_categories,id',
            'province' => 'nullable|string|max:100',
            'regency' => 'nullable|string|max:100',
            'img_url' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120', // Menggunakan 'img_url'
        ]);

        // Proses penyimpanan gambar (img_url)
        $imgUrlPath = null;
        if ($request->hasFile('img_url')) {
            $file = $request->file('img_url');
            $slug = Str::slug($request->input('title')) . '-' . time();
            $filename = $slug . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('articles', $filename, 'public');
            $imgUrlPath = Storage::url($path); // Menggunakan Storage::url() untuk URL publik
        }

        $articleData = [
            'author_id' => Auth::id(),
            'author_type' => 'user', // atau Auth::user()->role
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'category_id' => $validatedData['category_id'],
            'province' => $validatedData['province'] ?? null,
            'regency' => $validatedData['regency'] ?? null,
            'img_url' => $imgUrlPath,
            'is_verified' => false,
            'like_count' => 0,
            'view_count' => 0,
            'status' => 'pending',
        ];


        $article = Article::create($articleData);

        return redirect()->route('pustakawarisan.index', $article->id)->with('success', 'Artikel berhasil dikirim (menunggu moderasi).');
    }

    /**
     * Menampilkan artikel tertentu.
     * @param int $id
     * @return \Illuminate\View\View
     */
public function show($id)
{
    $article = Article::with('category', 'comments.user')->findOrFail($id);

    // Related articles berdasarkan category, kecuali artikel saat ini
    $relatedArticles = Article::where('category_id', $article->category_id)
                              ->where('id', '!=', $article->id)
                              ->take(4)
                              ->get();

    return view('frontend.pustakawarisan.detail', compact('article', 'relatedArticles'));
}

    /**
     * Menampilkan formulir untuk mengedit artikel.
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        if (Auth::id() !== $article->author_id) {
            abort(403, 'Unauthorized action.');
        }

        $categories = ArticleCategory::orderBy('name', 'asc')->get();

        return view('frontend.pustakawarisan.edit', compact('article', 'categories'));
    }


    /**
     * Memperbarui artikel di database.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        // Otorisasi
        if (Auth::id() !== $article->author_id) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:190',
            'content' => 'required|string|min:50',
            'category_id' => 'required|integer|exists:article_categories,id',
            'province' => 'nullable|string|max:100',
            'regency' => 'nullable|string|max:100',
            'img_url' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $imgUrlPath = $article->img_url;

        // Proses update gambar jika ada
        if ($request->hasFile('img_url')) {
            // Hapus gambar lama jika ada
            if ($article->img_url) {
                // Hapus dari storage (hati-hati dengan path)
                $pathToDelete = str_replace(Storage::url(''), '', $article->img_url);
                Storage::disk('public')->delete($pathToDelete);
            }

            $file = $request->file('img_url');
            $slug = Str::slug($request->input('title')) . '-' . time();
            $filename = $slug . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('articles', $filename, 'public');
            $imgUrlPath = Storage::url($path);
        }

        $article->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'category_id' => $validatedData['category_id'],
            'province' => $validatedData['province'] ?? null,
            'regency' => $validatedData['regency'] ?? null,
            'img_url' => $imgUrlPath,
            'status' => 'pending', // Ubah status menjadi pending setelah diedit
        ]);

        return redirect()->route('pustakawarisan.show', $article->id)->with('success', 'Artikel berhasil diperbarui (menunggu moderasi).');
    }

    /**
     * Menghapus artikel dari database.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Otorisasi
        if (Auth::id() !== $article->author_id) {
            abort(403, 'Unauthorized action.');
        }

        // Hapus gambar dari storage
        if ($article->img_url) {
            $pathToDelete = str_replace(Storage::url(''), '', $article->img_url);
            Storage::disk('public')->delete($pathToDelete);
        }

        $article->delete();

        return redirect()->route('frontend.pustakawarisan.index')->with('success', 'Artikel berhasil dihapus.');
    }

    // =========================================================================
    // FUNGSI INTERAKSI: LIKE DAN KOMENTAR
    // =========================================================================

    /**
     * Menangani fungsi like/unlike.
     * Catatan: Untuk implementasi yang lebih baik, gunakan tabel pivot 'likes'.
     * Di sini, kita hanya menaikkan 'like_count' sebagai contoh sederhana.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function like($id)
    {
        $article = Article::findOrFail($id);
        $user = Auth::user();

        // 1. Cek apakah user sudah pernah like (ini memerlukan tabel pivot: article_likes)
        // Jika Anda tidak memiliki tabel pivot, gunakan cara yang lebih sederhana:
        
        // Alternatif Sederhana (Hanya menaikkan count):
        // $article->increment('like_count');
        // return back()->with('success', 'Artikel disukai!');
        
        // Alternatif yang lebih baik (mengasumsikan tabel 'likes' atau sejenisnya)
        // Di sini saya akan mengasumsikan Anda memiliki model Like dan relasi many-to-many.
        // Jika Anda ingin implementasi lengkap, Anda harus membuat model Like dan migrasi.
        
        // Karena saya tidak bisa membuat migrasi/model baru,
        // saya akan memberikan placeholder yang Anda perlukan:
        
        /*
        if (!$article->likes()->where('user_id', $user->id)->exists()) {
            $article->likes()->create(['user_id' => $user->id]);
            $article->increment('like_count');
            return back()->with('success', 'Artikel disukai!');
        } else {
            $article->likes()->where('user_id', $user->id)->delete();
            $article->decrement('like_count');
            return back()->with('info', 'Like dibatalkan.');
        }
        */

        // Menggunakan logika sederhana untuk demonstrasi:
        $article->increment('like_count');
        return back()->with('success', 'Artikel disukai! (Implementasi lengkap memerlukan tabel likes)');
    }

    /**
     * Menyimpan komentar untuk artikel.
     * Catatan: Memerlukan model Comment dan relasi One-to-Many.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment_content' => 'required|string|max:1000',
        ]);

        $article = Article::findOrFail($id);

        $article->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->comment_content,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil dikirim!');
    }

    /**
     * Handle image uploads from the WYSIWYG editor (Jika diperlukan).
     * Saya pertahankan fungsi ini, tapi menggunakan path yang berbeda agar tidak
     * bentrok dengan 'img_url' artikel.
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $file = $request->file('file');
        $filename = time().'-'.Str::random(8).'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('articles', $filename, 'public');
        $imgUrlPath = Storage::url($path);


        // Return the public URL for the uploaded image
        return response()->json(['url' => Storage::url($path)]);
    }
    
    
}