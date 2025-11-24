@extends('admin.AdminLayout')

@section('content')
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-[#0F766E]">Kelola Pustaka</h1>
                <p class="text-gray-600">Kelola artikel dari admin dan pengguna.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.articles.create') }}" id="btn-tambah-artikel"
                    class="bg-[#0F766E] text-white px-4 py-2 rounded-lg hover:bg-[#0F766E]/90 flex items-center gap-2">
                    <x-heroicon-s-plus class="h-5 w-5" />
                    Tambah Artikel
                </a>
                <a href="{{ route('admin.fakta-cepat.create') }}" id="btn-tambah-fakta-cepat"
                    class="bg-[#059669] text-white px-4 py-2 rounded-lg hover:bg-[#059669]/90 hidden items-center gap-2">
                    <x-heroicon-s-plus class="h-5 w-5" />
                    Tambah Fakta Cepat
                </a>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                <button onclick="switchTab('admin')" id="tab-admin"
                    class="tab-button active border-b-2 border-[#0F766E] text-[#0F766E] py-2 px-4 text-sm font-medium">
                    <div class="flex items-center gap-2">
                        <x-heroicon-s-document-text class="h-4 w-4" />
                        Artikel
                    </div>
                </button>
                <button onclick="switchTab('user')" id="tab-user"
                    class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 py-2 px-4 text-sm font-medium">
                    <div class="flex items-center gap-2">
                        <x-heroicon-s-user class="h-4 w-4" />
                        Artikel User
                    </div>
                </button>
                <button onclick="switchTab('fakta-cepat')" id="tab-fakta-cepat"
                    class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 py-2 px-4 text-sm font-medium">
                    <div class="flex items-center gap-2">
                        <x-heroicon-s-light-bulb class="h-4 w-4" />
                        Fakta Cepat
                    </div>
                </button>
            </nav>
        </div>
    </div>

    <!-- Content Tabs -->
    <div id="content-admin" class="tab-content">
        <!-- Filter Status Admin -->
        <div class="bg-white rounded-lg shadow mb-6 p-4">
            <div class="flex gap-4">
                <button onclick="filterStatus('admin', 'all')"
                    class="filter-btn filter-admin active px-4 py-2 bg-[#0F766E] text-white rounded-lg">Semua</button>
                <button onclick="filterStatus('admin', 'pending')"
                    class="filter-btn filter-admin px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Pending</button>
                <button onclick="filterStatus('admin', 'approved')"
                    class="filter-btn filter-admin px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Approved</button>
                <button onclick="filterStatus('admin', 'rejected')"
                    class="filter-btn filter-admin px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Rejected</button>
            </div>
        </div>

        <!-- Tabel Artikel Admin -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Artikel</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stats
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($articles->where('author_type', 'admin') as $article)
                            <tr class="article-row admin-article" data-status="{{ $article->status }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <img class="h-12 w-12 rounded-lg object-cover mr-4"
                                            src="{{ $article->img_url ?? 'https://via.placeholder.com/48x48' }}"
                                            alt="Thumbnail">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $article->title }}</div>
                                            <div class="text-sm text-gray-500">{{ Str::limit($article->content, 50) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <x-heroicon-s-shield-check class="h-3 w-3 mr-1" />
                                            Admin
                                        </span>
                                        <div class="ml-2">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $article->author->name ?? 'Unknown' }}</div>
                                            <div class="text-sm text-gray-500">{{ $article->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @switch($article->status)
                                        @case('published')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <x-heroicon-s-check-circle class="h-3 w-3 mr-1" />
                                                Published
                                            </span>
                                        @break

                                        @case('pending')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <x-heroicon-s-clock class="h-3 w-3 mr-1" />
                                                Pending
                                            </span>
                                        @break

                                        @case('draft')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <x-heroicon-s-document class="h-3 w-3 mr-1" />
                                                Draft
                                            </span>
                                        @break

                                        @case('rejected')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <x-heroicon-s-x-circle class="h-3 w-3 mr-1" />
                                                Rejected
                                            </span>
                                        @break

                                        @case('approved')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <x-heroicon-s-check-circle class="h-3 w-3 mr-1" />
                                                Approved
                                            </span>
                                        @break

                                        @default
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Unknown
                                            </span>
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center">
                                            <x-heroicon-s-heart class="h-4 w-4 text-red-500 mr-1" />
                                            {{ $article->like_count ?? 0 }}
                                        </div>
                                        <div class="flex items-center">
                                            <x-heroicon-s-eye class="h-4 w-4 text-blue-500 mr-1" />
                                            {{ $article->view_count ?? 0 }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.articles.show', $article->id) }}"
                                            class="text-blue-600 hover:text-blue-900 text-sm">
                                            <x-heroicon-s-eye class="h-4 w-4" />
                                        </a>
                                        <a href="{{ route('admin.articles.edit', $article->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 text-sm">
                                            <x-heroicon-s-pencil class="h-4 w-4" />
                                        </a>
                                        <form method="POST" action="{{ route('admin.articles.destroy', $article->id) }}"
                                            class="inline" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm">
                                                <x-heroicon-s-trash class="h-4 w-4" />
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="content-user" class="tab-content hidden">
        <!-- Filter Status User -->
        <div class="bg-white rounded-lg shadow mb-6 p-4">
            <div class="flex gap-4">
                <button onclick="filterStatus('user', 'all')"
                    class="filter-btn filter-user active px-4 py-2 bg-[#0F766E] text-white rounded-lg">Semua</button>
                <button onclick="filterStatus('user', 'pending')"
                    class="filter-btn filter-user px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Pending</button>
                <button onclick="filterStatus('user', 'approved')"
                    class="filter-btn filter-user px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Approved</button>
                <button onclick="filterStatus('user', 'rejected')"
                    class="filter-btn filter-user px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Rejected</button>
            </div>
        </div>

        <!-- Tabel Artikel User -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Artikel</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stats</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($articles->where('author_type', '!=', 'admin') as $article)
                            <tr class="article-row user-article" data-status="{{ $article->status }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <img class="h-12 w-12 rounded-lg object-cover mr-4"
                                            src="{{ $article->img_url ?? 'https://via.placeholder.com/48x48' }}"
                                            alt="Thumbnail">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $article->title }}</div>
                                            <div class="text-sm text-gray-500">{{ Str::limit($article->content, 50) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <x-heroicon-s-user class="h-3 w-3 mr-1" />
                                            User
                                        </span>
                                        <div class="ml-2">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $article->author->name ?? 'Unknown' }}</div>
                                            <div class="text-sm text-gray-500">{{ $article->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @switch($article->status)
                                        @case('published')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <x-heroicon-s-check-circle class="h-3 w-3 mr-1" />
                                                Published
                                            </span>
                                        @break

                                        @case('pending')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <x-heroicon-s-clock class="h-3 w-3 mr-1" />
                                                Pending
                                            </span>
                                        @break

                                        @case('draft')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <x-heroicon-s-document class="h-3 w-3 mr-1" />
                                                Draft
                                            </span>
                                        @break

                                        @case('rejected')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <x-heroicon-s-x-circle class="h-3 w-3 mr-1" />
                                                Rejected
                                            </span>
                                        @break

                                        @default
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Unknown
                                            </span>
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center">
                                            <x-heroicon-s-heart class="h-4 w-4 text-red-500 mr-1" />
                                            {{ $article->like_count ?? 0 }}
                                        </div>
                                        <div class="flex items-center">
                                            <x-heroicon-s-eye class="h-4 w-4 text-blue-500 mr-1" />
                                            {{ $article->view_count ?? 0 }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <!-- Quick Status Change untuk artikel user -->
                                        @if ($article->status === 'pending')
                                            <form method="POST"
                                                action="{{ route('admin.articles.approve', $article->id) }}"
                                                class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-900 text-sm"
                                                    title="Approve">
                                                    <x-heroicon-s-check class="h-4 w-4" />
                                                </button>
                                            </form>
                                            <form method="POST"
                                                action="{{ route('admin.articles.reject', $article->id) }}"
                                                class="inline">
                                                @csrf
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm"
                                                    title="Reject">
                                                    <x-heroicon-s-x-mark class="h-4 w-4" />
                                                </button>
                                            </form>
                                        @endif

                                        <a href="{{ route('admin.articles.show', $article->id) }}"
                                            class="text-blue-600 hover:text-blue-900 text-sm" title="View">
                                            <x-heroicon-s-eye class="h-4 w-4" />
                                        </a>
                                        <a href="{{ route('admin.articles.edit', $article->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 text-sm" title="Edit">
                                            <x-heroicon-s-pencil class="h-4 w-4" />
                                        </a>
                                        <form method="POST" action="{{ route('admin.articles.destroy', $article->id) }}"
                                            class="inline"
                                            onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm"
                                                title="Delete">
                                                <x-heroicon-s-trash class="h-4 w-4" />
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tab Fakta Cepat -->
    <div id="content-fakta-cepat" class="tab-content hidden">
        <!-- Filter Status Fakta Cepat -->
        <div class="bg-white rounded-lg shadow mb-6 p-4">
            <div class="flex justify-between items-center">
                <div class="flex gap-4">
                    <button onclick="filterStatus('fakta-cepat', 'all')"
                        class="filter-btn filter-fakta-cepat active px-4 py-2 bg-[#0F766E] text-white rounded-lg">Semua</button>
                    <button onclick="filterStatus('fakta-cepat', 'pending')"
                        class="filter-btn filter-fakta-cepat px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Pending</button>
                    <button onclick="filterStatus('fakta-cepat', 'approved')"
                        class="filter-btn filter-fakta-cepat px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Approved</button>
                    <button onclick="filterStatus('fakta-cepat', 'rejected')"
                        class="filter-btn filter-fakta-cepat px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Rejected</button>
                </div>
                <a href="{{ route('admin.fakta-cepat.create') }}"
                    class="bg-[#0F766E] text-white px-4 py-2 rounded-lg hover:bg-[#0F766E]/90 flex items-center gap-2">
                    <x-heroicon-s-plus class="h-5 w-5" />
                    Tambah Fakta Cepat
                </a>
            </div>
        </div>

        <!-- Tabel Fakta Cepat -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fakta Cepat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stats</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($faktaCepats->where('author_type', 'admin') as $faktaCepat)
                            <tr class="article-row fakta-cepat-article" data-status="{{ $faktaCepat->status }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-12 w-12 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-lg flex items-center justify-center mr-4">
                                            <x-heroicon-s-light-bulb class="h-6 w-6 text-yellow-600" />
                                        </div>
                                        <div class="flex-1">
                                            <div class="text-sm font-medium text-gray-900">{{ $faktaCepat->nama }}</div>
                                            <div class="text-sm text-gray-500">{{ Str::limit($faktaCepat->penampilan, 60) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <x-heroicon-s-shield-check class="h-3 w-3 mr-1" />
                                            Admin
                                        </span>
                                        <div class="ml-2">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $faktaCepat->author->name ?? 'Unknown' }}</div>
                                            <div class="text-sm text-gray-500">{{ $faktaCepat->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @switch($faktaCepat->status)
                                        @case('approved')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <x-heroicon-s-check-circle class="h-3 w-3 mr-1" />
                                                Approved
                                            </span>
                                        @break

                                        @case('pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <x-heroicon-s-clock class="h-3 w-3 mr-1" />
                                                Pending
                                            </span>
                                        @break

                                        @case('rejected')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <x-heroicon-s-x-circle class="h-3 w-3 mr-1" />
                                                Rejected
                                            </span>
                                        @break

                                        @default
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Unknown
                                            </span>
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center">
                                            <x-heroicon-s-heart class="h-4 w-4 text-red-500 mr-1" />
                                            0
                                        </div>
                                        <div class="flex items-center">
                                            <x-heroicon-s-eye class="h-4 w-4 text-blue-500 mr-1" />
                                            0
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.fakta-cepat.show', $faktaCepat->id) }}"
                                            class="text-blue-600 hover:text-blue-900 text-sm" title="View">
                                            <x-heroicon-s-eye class="h-4 w-4" />
                                        </a>
                                        <a href="{{ route('admin.fakta-cepat.edit', $faktaCepat->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 text-sm" title="Edit">
                                            <x-heroicon-s-pencil class="h-4 w-4" />
                                        </a>
                                        <form method="POST" action="{{ route('admin.fakta-cepat.destroy', $faktaCepat->id) }}"
                                            class="inline" onsubmit="return confirm('Yakin ingin menghapus fakta cepat ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm" title="Delete">
                                                <x-heroicon-s-trash class="h-4 w-4" />
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @foreach ($faktaCepats->where('author_type', '!=', 'admin') as $faktaCepat)
                            <tr class="article-row fakta-cepat-article" data-status="{{ $faktaCepat->status }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-12 w-12 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-lg flex items-center justify-center mr-4">
                                            <x-heroicon-s-light-bulb class="h-6 w-6 text-yellow-600" />
                                        </div>
                                        <div class="flex-1">
                                            <div class="text-sm font-medium text-gray-900">{{ $faktaCepat->nama }}</div>
                                            <div class="text-sm text-gray-500">{{ Str::limit($faktaCepat->penampilan, 60) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <x-heroicon-s-user class="h-3 w-3 mr-1" />
                                            User
                                        </span>
                                        <div class="ml-2">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $faktaCepat->author->name ?? 'Unknown' }}</div>
                                            <div class="text-sm text-gray-500">{{ $faktaCepat->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @switch($faktaCepat->status)
                                        @case('approved')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <x-heroicon-s-check-circle class="h-3 w-3 mr-1" />
                                                Approved
                                            </span>
                                        @break

                                        @case('pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <x-heroicon-s-clock class="h-3 w-3 mr-1" />
                                                Pending
                                            </span>
                                        @break

                                        @case('rejected')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <x-heroicon-s-x-circle class="h-3 w-3 mr-1" />
                                                Rejected
                                            </span>
                                        @break

                                        @default
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Unknown
                                            </span>
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center">
                                            <x-heroicon-s-heart class="h-4 w-4 text-red-500 mr-1" />
                                            0
                                        </div>
                                        <div class="flex items-center">
                                            <x-heroicon-s-eye class="h-4 w-4 text-blue-500 mr-1" />
                                            0
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <!-- Quick Status Change untuk fakta cepat user -->
                                        @if ($faktaCepat->status === 'pending')
                                            <form method="POST" action="{{ route('admin.fakta-cepat.approve', $faktaCepat->id) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-900 text-sm" title="Approve">
                                                    <x-heroicon-s-check class="h-4 w-4" />
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.fakta-cepat.reject', $faktaCepat->id) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm" title="Reject">
                                                    <x-heroicon-s-x-mark class="h-4 w-4" />
                                                </button>
                                            </form>
                                        @endif

                                        <a href="{{ route('admin.fakta-cepat.show', $faktaCepat->id) }}"
                                            class="text-blue-600 hover:text-blue-900 text-sm" title="View">
                                            <x-heroicon-s-eye class="h-4 w-4" />
                                        </a>
                                        <a href="{{ route('admin.fakta-cepat.edit', $faktaCepat->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 text-sm" title="Edit">
                                            <x-heroicon-s-pencil class="h-4 w-4" />
                                        </a>
                                        <form method="POST" action="{{ route('admin.fakta-cepat.destroy', $faktaCepat->id) }}"
                                            class="inline" onsubmit="return confirm('Yakin ingin menghapus fakta cepat ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm" title="Delete">
                                                <x-heroicon-s-trash class="h-4 w-4" />
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($faktaCepats->isEmpty())
                <div class="text-center py-12">
                    <x-heroicon-s-light-bulb class="mx-auto h-12 w-12 text-gray-400" />
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada fakta cepat</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan fakta cepat pertama.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.fakta-cepat.create') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#0F766E] hover:bg-[#0F766E]/90">
                            <x-heroicon-s-plus class="-ml-1 mr-2 h-5 w-5" />
                            Tambah Fakta Cepat
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if (session('success'))
        <div class="fixed bottom-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"
            role="alert">
            {{ session('success') }}
        </div>
    @endif

    <script>
        // Tab Management
        function switchTab(tab) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Remove active class from all tabs
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active', 'border-[#0F766E]', 'text-[#0F766E]');
                button.classList.add('border-transparent', 'text-gray-500');
            });

            // Show selected tab content
            document.getElementById('content-' + tab).classList.remove('hidden');

            // Add active class to selected tab
            const activeTab = document.getElementById('tab-' + tab);
            activeTab.classList.add('active', 'border-[#0F766E]', 'text-[#0F766E]');
            activeTab.classList.remove('border-transparent', 'text-gray-500');
            
            // Update add buttons visibility
            updateAddButtons(tab);
        }

        // Update add buttons based on active tab
        function updateAddButtons(tab) {
            const btnArtikel = document.getElementById('btn-tambah-artikel');
            const btnFaktaCepat = document.getElementById('btn-tambah-fakta-cepat');
            
            if (tab === 'fakta-cepat') {
                btnArtikel.classList.add('hidden');
                btnFaktaCepat.classList.remove('hidden');
                btnFaktaCepat.classList.add('flex');
            } else {
                btnArtikel.classList.remove('hidden');
                btnFaktaCepat.classList.add('hidden');
                btnFaktaCepat.classList.remove('flex');
            }
        }

        // Filter Status
        function filterStatus(tabType, status) {
            const filterButtons = document.querySelectorAll('.filter-' + tabType);
            let articleRows;
            
            // Handle different tab types
            if (tabType === 'fakta-cepat') {
                articleRows = document.querySelectorAll('.fakta-cepat-article');
            } else {
                articleRows = document.querySelectorAll('.' + tabType + '-article');
            }

            // Update filter button styles
            filterButtons.forEach(btn => {
                btn.classList.remove('bg-[#0F766E]', 'text-white');
                btn.classList.add('bg-gray-100', 'text-gray-700');
            });

            event.target.classList.remove('bg-gray-100', 'text-gray-700');
            event.target.classList.add('bg-[#0F766E]', 'text-white');

            // Filter articles
            articleRows.forEach(row => {
                if (status === 'all' || row.dataset.status === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Auto-hide success message
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.querySelector('[role="alert"]');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 5000);
            }
        });
    </script>
@endsection
