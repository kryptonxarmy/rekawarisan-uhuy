@extends('admin.AdminLayout')

@section('content')
    {{-- WARNING: OLD MISSION SYSTEM - DEPRECATED --}}
    {{-- 
        This is the OLD mission system that is being phased out.
        New missions should use the Daily Mission system instead.
        This page is kept for backward compatibility only.
    --}}
    
    <!-- Deprecated Notice -->
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
        <div class="flex items-center">
            <x-heroicon-s-exclamation-triangle class="h-6 w-6 text-red-600 mr-3" />
            <div>
                <h3 class="text-red-800 font-semibold">Sistem Misi Lama (Deprecated)</h3>
                <p class="text-red-700 text-sm">Halaman ini menggunakan sistem misi lama. Gunakan halaman "Misi Harian" untuk misi baru.</p>
            </div>
        </div>
    </div>

    <div class="mb-6">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.missions.index') }}" class="text-gray-500 hover:text-gray-700">
                <x-heroicon-s-arrow-left class="h-6 w-6" />
            </a>
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-[#0F766E] opacity-60">Detail Misi (Old System)</h1>
                <p class="text-gray-600">{{ $mission->title }} (Sistem Lama - Deprecated)</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.missions.edit', $mission) }}"
                    class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition-colors">
                    <x-heroicon-s-pencil class="h-4 w-4 inline mr-1" />
                    Edit
                </a>
                <form action="{{ route('admin.missions.destroy', $mission) }}" method="POST" class="inline"
                    onsubmit="return confirm('Yakin ingin menghapus misi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors">
                        <x-heroicon-s-trash class="h-4 w-4 inline mr-1" />
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Mission Details -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Misi</h2>

                <div class="space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Judul</dt>
                        <dd class="text-sm text-gray-900">{{ $mission->title }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                        <dd class="text-sm text-gray-900">{{ $mission->description }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tipe</dt>
                        <dd>
                            <span
                                class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                {{ $mission->type === 'read'
                                    ? 'bg-blue-100 text-blue-800'
                                    : 'bg-purple-100 text-purple-800' }}">
                                {{ ucfirst($mission->type) }}
                            </span>
                        </dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">XP Reward</dt>
                        <dd class="text-sm text-gray-900">{{ number_format($mission->xp_reward) }} XP</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd>
                            <span
                                class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                {{ $mission->status === 'active'
                                    ? 'bg-green-100 text-green-800'
                                    : ($mission->status === 'inactive'
                                        ? 'bg-red-100 text-red-800'
                                        : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($mission->status) }}
                            </span>
                        </dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Dibuat Oleh</dt>
                        <dd class="text-sm text-gray-900">{{ $mission->creator->name }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tanggal Dibuat</dt>
                        <dd class="text-sm text-gray-900">{{ $mission->created_at->format('d M Y, H:i') }}</dd>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mission Articles -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    Artikel dalam Misi ({{ $missionArticles->count() }})
                </h2>

                @if ($missionArticles->count() > 0)
                    <div class="space-y-4">
                        @foreach ($missionArticles as $missionArticle)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-2 mb-2">
                                            <span class="bg-[#0F766E] text-white text-xs px-2 py-1 rounded">
                                                #{{ $missionArticle->order_index }}
                                            </span>
                                            <h3 class="font-medium text-gray-900">
                                                {{ $missionArticle->article->title }}
                                            </h3>
                                        </div>

                                        <p class="text-sm text-gray-600 mb-3">
                                            {{ Str::limit($missionArticle->article->content, 150) }}
                                        </p>

                                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                                            <div class="flex items-center">
                                                <x-heroicon-s-clock class="h-4 w-4 mr-1" />
                                                Min. {{ $missionArticle->min_read_time }} menit
                                            </div>
                                            @if ($missionArticle->article->category)
                                                <div class="flex items-center">
                                                    <x-heroicon-s-tag class="h-4 w-4 mr-1" />
                                                    {{ $missionArticle->article->category->name }}
                                                </div>
                                            @endif
                                            <div class="flex items-center">
                                                <x-heroicon-s-user class="h-4 w-4 mr-1" />
                                                {{ $missionArticle->article->author->name }}
                                            </div>
                                        </div>
                                    </div>

                                    @if ($missionArticle->article->img_url)
                                        <div class="ml-4 flex-shrink-0">
                                            <img src="{{ $missionArticle->article->img_url }}"
                                                alt="{{ $missionArticle->article->title }}"
                                                class="w-20 h-20 object-cover rounded-lg">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <x-heroicon-o-document-text class="mx-auto h-12 w-12 text-gray-400" />
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada artikel</h3>
                        <p class="mt-1 text-sm text-gray-500">Belum ada artikel yang ditambahkan ke misi ini.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.missions.edit', $mission) }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#0F766E] hover:bg-[#0d6f64]">
                                <x-heroicon-s-plus class="-ml-1 mr-2 h-5 w-5" />
                                Tambah Artikel
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
