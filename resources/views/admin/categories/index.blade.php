@extends('admin.AdminLayout')

@section('content')
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-[#0F766E]">Kategori Warisan</h1>
                <p class="text-gray-600">Kelola kategori artikel warisan budaya.</p>
            </div>
            <a href="{{ route('admin.categories.create') }}"
                class="bg-[#0F766E] text-white px-4 py-2 rounded-lg hover:bg-[#0F766E]/90 flex items-center gap-2">
                <x-heroicon-s-plus class="h-5 w-5" />
                Tambah Kategori
            </a>
        </div>
    </div>

    <!-- Tabel Kategori -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah
                            Artikel</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($categories as $category)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <x-heroicon-s-tag class="h-5 w-5 text-[#0F766E] mr-3" />
                                    <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ Str::limit($category->description, 100) }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $category->articles->count() }} artikel
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $category->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.categories.show', $category) }}"
                                        class="text-blue-600 hover:text-blue-900 text-sm" title="Lihat">
                                        <x-heroicon-s-eye class="h-4 w-4" />
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                        class="text-indigo-600 hover:text-indigo-900 text-sm" title="Edit">
                                        <x-heroicon-s-pencil class="h-4 w-4" />
                                    </a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                        class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm"
                                            title="Hapus">
                                            <x-heroicon-s-trash class="h-4 w-4" />
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                <div class="flex flex-col items-center py-8">
                                    <x-heroicon-s-tag class="h-12 w-12 text-gray-300 mb-4" />
                                    <p class="text-lg font-medium">Belum ada kategori</p>
                                    <p class="text-sm">Buat kategori pertama untuk mengelompokkan artikel.</p>
                                    <a href="{{ route('admin.categories.create') }}"
                                        class="mt-4 bg-[#0F766E] text-white px-4 py-2 rounded-lg hover:bg-[#0F766E]/90">
                                        Tambah Kategori
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="fixed bottom-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"
            role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="fixed bottom-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <script>
        // Auto-hide messages
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 5000);
            });
        });
    </script>
@endsection
