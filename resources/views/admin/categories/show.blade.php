@extends('admin.AdminLayout')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.categories.index') }}" class="text-[#0F766E] hover:text-[#0F766E]/80">
                <x-heroicon-s-arrow-left class="h-5 w-5" />
            </a>
            <div>
                <h1 class="text-2xl font-bold text-[#0F766E]">Detail Kategori</h1>
                <p class="text-gray-600">Informasi kategori: {{ $category->name }}</p>
            </div>
        </div>
    </div>

    <!-- Info Kategori -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Informasi Kategori</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nama Kategori</dt>
                        <dd class="text-sm text-gray-900 flex items-center">
                            <x-heroicon-s-tag class="h-4 w-4 text-[#0F766E] mr-2" />
                            {{ $category->name }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                        <dd class="text-sm text-gray-900">{{ $category->description }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Dibuat Tanggal</dt>
                        <dd class="text-sm text-gray-900">{{ $category->created_at->format('d F Y, H:i') }}</dd>
                    </div>
                </dl>
            </div>
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Statistik</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-[#0F766E]">{{ $category->articles->count() }}</div>
                        <div class="text-sm text-gray-500">Total Artikel</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4 mt-6 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.categories.edit', $category) }}"
                class="bg-[#0F766E] text-white px-4 py-2 rounded-lg hover:bg-[#0F766E]/90 flex items-center gap-2">
                <x-heroicon-s-pencil class="h-4 w-4" />
                Edit Kategori
            </a>
            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline"
                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                @csrf @method('DELETE')
                <button type="submit"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 flex items-center gap-2"
                    {{ $category->articles->count() > 0 ? 'disabled title="Tidak dapat dihapus karena masih ada artikel"' : '' }}>
                    <x-heroicon-s-trash class="h-4 w-4" />
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <!-- Daftar Artikel dalam Kategori -->
    @if ($category->articles->count() > 0)
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Artikel dalam Kategori Ini</h3>
            <div class="space-y-3">
                @foreach ($category->articles as $article)
                    <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                        <div class="flex items-center">
                            <img class="h-10 w-10 rounded object-cover mr-3"
                                src="{{ $article->img_url ?? 'https://via.placeholder.com/40x40' }}" alt="Thumbnail">
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $article->title }}</div>
                                <div class="text-xs text-gray-500">
                                    Oleh {{ $article->author->name ?? 'Unknown' }} •
                                    {{ $article->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <!-- Status Badge -->
                            @switch($article->status)
                                @case('published')
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Published
                                    </span>
                                @break

                                @case('pending')
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                @break

                                @case('draft')
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Draft
                                    </span>
                                @break

                                @default
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        {{ ucfirst($article->status) }}
                                    </span>
                            @endswitch

                            <a href="{{ route('admin.articles.show', $article) }}"
                                class="text-blue-600 hover:text-blue-800" title="Lihat Artikel">
                                <x-heroicon-s-eye class="h-4 w-4" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <x-heroicon-s-document class="mx-auto h-12 w-12 text-gray-300 mb-4" />
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Artikel</h3>
            <p class="text-gray-500">Kategori ini belum memiliki artikel.</p>
        </div>
    @endif
@endsection
