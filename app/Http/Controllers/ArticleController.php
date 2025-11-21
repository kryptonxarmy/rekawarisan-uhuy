<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:190',
            'body' => 'required|string|min:50',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $body = strip_tags($request->input('body'), '<p><a><ul><ol><li><strong><em><br><h2><h3><img>');
        $slug = Str::slug($request->input('title')).'-'.time();

        $coverPath = null;
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = $slug.'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('articles', $filename, 'public');
            $coverPath = 'storage/'.$path;
        }

        $articleData = [
            'user_id' => $request->user()->id,
            'title' => $request->input('title'),
            'slug' => $slug,
            'body' => $body,
            'cover' => $coverPath,
            'status' => 'pending',
        ];


        $article = Article::create($articleData);

        return redirect()->route('articles.show', $article->slug)->with('success', 'Artikel berhasil dikirim (menunggu moderasi).');
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $article->increment('views');
        return view('articles.show', compact('article'));
    }

    /**
     * Handle image uploads from the WYSIWYG editor (Trix).
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $file = $request->file('file');
        $filename = time().'-'.Str::random(8).'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('articles/images', $filename, 'public');

        // Return the public URL for the uploaded image
        return response()->json(['url' => Storage::url($path)]);
    }
}
