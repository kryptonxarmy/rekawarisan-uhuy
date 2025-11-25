@extends('admin.AdminLayout')

@section('content')
<div class="mb-10">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.articles.index') }}" class="text-gray-500 hover:text-gray-700">
            <x-heroicon-s-arrow-left class="h-7 w-7" />
        </a>
        <div>
            <h1 class="text-3xl font-extrabold text-[#0F766E] tracking-wide">Detail Artikel</h1>
            <p class="text-gray-600 mt-1">Informasi lengkap mengenai artikel pustaka</p>
        </div>
    </div>
</div>

<div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 max-w-4xl mx-auto transition hover:shadow-2xl duration-300">
        <!-- Detail -->
        <div class="flex-1">

            <div class="rounded-xl overflow-hidden shadow-lg border border-gray-200">
                <img src="{{ asset($article->img_url) }}" class="w-full object-cover" alt="Thumbnail">
            </div>
            <h2 class="text-3xl font-bold text-gray-900 leading-tight mb-3">
                {{ $article->title }}
            </h2>

            <!-- Badges -->
            <div class="flex flex-wrap gap-2 mb-4">

                @if($article->category)
                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-[13px] rounded-full font-medium flex items-center">
                    <x-heroicon-s-tag class="h-4 w-4 mr-1" />
                    {{ $article->category->name }}
                </span>
                @endif

                @if($article->faktaCepat)
                <span class="px-3 py-1 bg-green-100 text-green-800 text-[13px] rounded-full font-medium flex items-center">
                    <x-heroicon-s-light-bulb class="h-4 w-4 mr-1" />
                    Fakta Cepat: {{ $article->faktaCepat->title }}
                </span>
                @endif

                <span class="px-3 py-1 bg-gray-200 text-gray-800 text-[13px] rounded-full font-medium flex items-center">
                    <x-heroicon-s-user class="h-4 w-4 mr-1" />
                    {{ $article->author_type }} #{{ $article->author_id }}
                </span>

                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-[13px] rounded-full font-medium flex items-center">
                    <x-heroicon-s-eye class="h-4 w-4 mr-1" />
                    {{ $article->view_count ?? 0 }} views
                </span>

                <span class="px-3 py-1 bg-pink-100 text-pink-800 text-[13px] rounded-full font-medium flex items-center">
                    <x-heroicon-s-heart class="h-4 w-4 mr-1" />
                    {{ $article->like_count ?? 0 }} likes
                </span>

                <span class="px-3 py-1 rounded-full text-[13px] font-medium flex items-center
                    @if($article->status==='approved')
                        bg-green-100 text-green-800
                    @elseif($article->status==='pending')
                        bg-yellow-100 text-yellow-800
                    @else
                        bg-red-100 text-red-800
                    @endif
                ">
                    <x-heroicon-s-check-circle class="h-4 w-4 mr-1" />
                    {{ ucfirst($article->status) }}
                </span>
            </div>

            <!-- Lokasi -->
            @if($article->province || $article->regency)
            <div class="flex items-center text-gray-600 text-sm mb-6">
                <x-heroicon-s-map-pin class="h-4 w-4 mr-1" />
                {{ $article->province }}{{ $article->province && $article->regency ? ', ' : '' }}{{ $article->regency }}
            </div>
            @endif

            <!-- Content -->
            <div class="prose prose-gray max-w-none mb-6 leading-relaxed text-gray-800">
                {!! nl2br(e($article->content)) !!}
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4">
                <a href="{{ route('admin.articles.edit', $article->id) }}"
                   class="px-6 py-2.5 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 shadow-md flex items-center gap-2">
                    <x-heroicon-s-pencil class="h-5 w-5" /> Edit
                </a>

                <form method="POST" action="{{ route('admin.articles.destroy', $article->id) }}"
                    onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                    @csrf @method('DELETE')

                    <button type="submit"
                        class="px-6 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 shadow-md flex items-center gap-2">
                        <x-heroicon-s-trash class="h-5 w-5" /> Hapus
                    </button>
                </form>
            </div>

        </div>
</div>
@endsection
