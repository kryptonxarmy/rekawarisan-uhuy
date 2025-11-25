<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ArticleCategory::orderBy('created_at', 'desc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:article_categories,name',
            'description' => 'required|string'
        ]);

        // Add created_at manually since timestamps are disabled
        $data['created_at'] = now();

        ArticleCategory::create($data);
        return redirect()->route('admin.categories.index')
                        ->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticleCategory $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArticleCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArticleCategory $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:article_categories,name,' . $category->id,
            'description' => 'required|string'
        ]);

        $category->update($data);
        return redirect()->route('admin.categories.index')
                        ->with('success', 'Kategori berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticleCategory $category)
    {
        // Check if category is being used by articles
        if ($category->articles()->exists()) {
            return redirect()->route('admin.categories.index')
                           ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh artikel');
        }

        $category->delete();
        return redirect()->route('admin.categories.index')
                        ->with('success', 'Kategori berhasil dihapus');
    }
}
