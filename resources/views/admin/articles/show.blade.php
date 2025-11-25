@extends('admin.AdminLayout')

@section('content')
    <div class="mb-8">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.articles.index') }}" class="text-gray-500 hover:text-gray-700">
                <x-heroicon-s-arrow-left class="h-6 w-6" />
            </a>
            <div>
                <h1 class="text-3xl font-bold text-[#0F766E]">Detail Artikel</h1>
                <p class="text-gray-600 mt-2">Lihat detail lengkap artikel pustaka</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-8 max-w-3xl mx-auto">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Gambar Artikel -->
            <div class="flex-shrink-0">
                <img src="{{ $article->img_url ?? 'https://via.placeholder.com/320x200?text=No+Image' }}" class="w-80 h-52 object-cover rounded-lg border" alt="Thumbnail">
            </div>
            <div class="flex-1 flex flex-col gap-2">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $article->title }}</h2>
                <div class="flex flex-wrap gap-2 mb-2">
                    @if($article->category)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            <x-heroicon-s-tag class="h-4 w-4 mr-1" />
                            {{ $article->category->name }}
                        </span>
                    @endif
                    @if($article->faktaCepat)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <x-heroicon-s-light-bulb class="h-4 w-4 mr-1" />
                            Fakta Cepat: {{ $article->faktaCepat->title }}
                        </span>
                    @endif
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        <x-heroicon-s-user class="h-4 w-4 mr-1" />
                        {{ $article->author_type }} #{{ $article->author_id }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <x-heroicon-s-eye class="h-4 w-4 mr-1" />
                        {{ $article->view_count ?? 0 }} views
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                        <x-heroicon-s-heart class="h-4 w-4 mr-1" />
                        {{ $article->like_count ?? 0 }} likes
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-{{ $article->status === 'approved' ? 'green' : ($article->status === 'pending' ? 'yellow' : 'red') }}-100 text-{{ $article->status === 'approved' ? 'green' : ($article->status === 'pending' ? 'yellow' : 'red') }}-800">
                        <x-heroicon-s-check-circle class="h-4 w-4 mr-1" />
                        {{ ucfirst($article->status) }}
                    </span>
                </div>
                <div class="text-sm text-gray-500 mb-2">
                    @if($article->province || $article->regency)
                        <x-heroicon-s-map-pin class="h-4 w-4 inline mr-1" />
                        {{ $article->province }}{{ $article->province && $article->regency ? ', ' : '' }}{{ $article->regency }}
                    @endif
                </div>
                <div class="prose max-w-none text-gray-800 mb-4">
                    {!! nl2br(e($article->content)) !!}
                </div>
                <div class="flex gap-3 mt-4">
                    <a href="{{ route('admin.articles.edit', $article->id) }}" class="bg-yellow-500 text-white px-5 py-2 rounded-lg hover:bg-yellow-600 flex items-center gap-2">
                        <x-heroicon-s-pencil class="h-4 w-4" /> Edit
                    </a>
                    <form method="POST" action="{{ route('admin.articles.destroy', $article->id) }}" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700 flex items-center gap-2">
                            <x-heroicon-s-trash class="h-4 w-4" /> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
