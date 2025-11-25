@extends('admin.AdminLayout')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#0F766E]">Kelola Pustaka</h1>
            <p class="text-gray-600">Kelola artikel dari admin dan pengguna.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.articles.create') }}"
               id="btn-tambah-artikel"
               class="bg-[#0F766E] text-white px-4 py-2 rounded-lg hover:bg-[#0F766E]/90 flex items-center gap-2">
               <x-heroicon-s-plus class="h-5 w-5" /> Tambah Artikel
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
                    <x-heroicon-s-document-text class="h-4 w-4" /> Artikel
                </div>
            </button>
            <button onclick="switchTab('user')" id="tab-user"
                    class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 py-2 px-4 text-sm font-medium">
                <div class="flex items-center gap-2">
                    <x-heroicon-s-user class="h-4 w-4" /> Artikel User
                </div>
            </button>
        </nav>
    </div>
</div>

<div id="content-admin" class="tab-content">
    <div class="bg-white shadow rounded-lg p-4 overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="text-left bg-gray-100 text-gray-700">
                    <th class="px-4 py-2">Thumbnail</th>
                    <th class="px-4 py-2">Judul</th>
                    <th class="px-4 py-2">Kategori</th>
                    <th class="px-4 py-2">Provinsi</th>
                    <th class="px-4 py-2">Kabupaten</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles->where('author_type', 'admin') as $article)
                    <tr class="border-b">
                        <td class="px-4 py-2">
                            <img src="{{ asset($article->img_url) }}" class="w-12 h-12 object-cover rounded border">
                        </td>
                        <td class="px-4 py-2">{{ $article->title }}</td>
                        <td class="px-4 py-2">{{ $article->category->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $article->province ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $article->regency ?? '-' }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded text-xs bg-green-100 text-green-700">
                                Approved
                            </span>
                        </td>
                        <td class="px-4 py-2 space-x-2">

                            <a href="{{ route('admin.articles.show', $article->id) }}" class="text-green-600">Show</a>

                            <a href="{{ route('admin.articles.edit', $article->id) }}" class="text-blue-600">Edit</a>

                            <form action="{{ route('admin.articles.destroy', $article->id) }}"
                                  method="POST" class="inline-block"
                                  onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<div id="content-user" class="tab-content hidden">
    <div class="bg-white shadow rounded-lg p-4 overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="text-left bg-gray-100 text-gray-700">
                    <th class="px-4 py-2">Thumbnail</th>
                    <th class="px-4 py-2">Judul</th>
                    <th class="px-4 py-2">Kategori</th>
                    <th class="px-4 py-2">Provinsi</th>
                    <th class="px-4 py-2">Kabupaten</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles->where('author_type', 'user') as $article)
                    <tr class="border-b">
                        <td class="px-4 py-2">
                            <img src="{{ asset($article->img_url) }}" class="w-12 h-12 object-cover rounded border">
                        </td>
                        <td class="px-4 py-2">{{ $article->title }}</td>
                        <td class="px-4 py-2">{{ $article->category->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $article->province ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $article->regency ?? '-' }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded text-xs
                                @if($article->status=='approved') bg-green-100 text-green-700
                                @elseif($article->status=='rejected') bg-red-100 text-red-700
                                @else bg-yellow-100 text-yellow-700 @endif">
                                {{ ucfirst($article->status) }}
                            </span>
                        </td>

                        <td class="px-4 py-2 space-x-2">

                           <a href="{{ route('admin.articles.show', $article->id) }}" class="text-green-600">Show</a>

                            <!-- Edit -->
                            <a href="{{ route('admin.articles.edit', $article->id) }}" class="text-blue-600">Edit</a>

                            <!-- Approve -->
                            @if ($article->status == 'pending')
                                <form method="POST" action="{{ route('admin.articles.approve', $article->id) }}"
                                      class="inline-block">
                                    @csrf
                                    <button class="text-green-600">Approve</button>
                                </form>

                                <form method="POST" action="{{ route('admin.articles.reject', $article->id) }}"
                                      class="inline-block ml-2">
                                    @csrf
                                    <button class="text-red-600">Reject</button>
                                </form>
                            @endif

                            <!-- Delete -->
                            <form action="{{ route('admin.articles.destroy', $article->id) }}"
                                  method="POST" class="inline-block ml-2"
                                  onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@if (session('success'))
    <div class="fixed bottom-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
        {{ session('success') }}
    </div>
@endif

<script>
    // Tab Management
    function switchTab(tab) {
        document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
        document.querySelectorAll('.tab-button').forEach(b => {
            b.classList.remove('active', 'border-[#0F766E]', 'text-[#0F766E]');
            b.classList.add('border-transparent', 'text-gray-500');
        });

        document.getElementById('content-' + tab).classList.remove('hidden');
        const activeTab = document.getElementById('tab-' + tab);
        activeTab.classList.add('active', 'border-[#0F766E]', 'text-[#0F766E]');
        activeTab.classList.remove('border-transparent', 'text-gray-500');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.querySelector('[role="alert"]');
        if (successAlert) {
            setTimeout(() => successAlert.style.display = 'none', 5000);
        }
    });
</script>
@endsection
