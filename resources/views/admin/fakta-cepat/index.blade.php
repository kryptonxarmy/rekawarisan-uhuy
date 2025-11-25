@extends('admin.AdminLayout')

@section('content')
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-[#0F766E]">Kelola Fakta Cepat</h1>
                <p class="text-gray-600">Kelola fakta cepat dari admin dan pengguna.</p>
            </div>
            <a href="{{ route('admin.fakta-cepat.create') }}"
                class="bg-[#0F766E] text-white px-4 py-2 rounded-lg hover:bg-[#0F766E]/90 flex items-center gap-2">
                <x-heroicon-s-plus class="h-5 w-5" />
                Tambah Fakta Cepat
            </a>
        </div>
    </div>

    <!-- Filter Status -->
    <div class="bg-white rounded-lg shadow mb-6 p-4">
        <div class="flex gap-4">
            <button onclick="filterStatus('all')"
                class="filter-btn active px-4 py-2 bg-[#0F766E] text-white rounded-lg">Semua</button>
            <button onclick="filterStatus('pending')"
                class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Pending</button>
            <button onclick="filterStatus('approved')"
                class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Approved</button>
            <button onclick="filterStatus('rejected')"
                class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Rejected</button>
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
                            Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($faktaCepats as $faktaCepat)
                        <tr class="fakta-cepat-row" data-status="{{ $faktaCepat->status }}">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        @if ($faktaCepat->img_url)
                                            <img class="h-12 w-12 rounded-lg object-cover"
                                                src="{{ $faktaCepat->img_url }}"
                                                alt="{{ $faktaCepat->nama }}">
                                        @else
                                            <div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                                <x-heroicon-s-light-bulb class="h-6 w-6 text-gray-400" />
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $faktaCepat->nama }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($faktaCepat->asal, 50) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="text-sm text-gray-900">
                                        {{ $faktaCepat->author ? $faktaCepat->author->name : 'Admin' }}
                                    </div>
                                    @if ($faktaCepat->author_type === 'admin')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 ml-2">
                                            Admin
                                        </span>
                                    @endif
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
                                @endswitch
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $faktaCepat->kategori }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $faktaCepat->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.fakta-cepat.show', $faktaCepat->id) }}"
                                        class="text-blue-600 hover:text-blue-900">
                                        <x-heroicon-s-eye class="h-4 w-4" />
                                    </a>
                                    <a href="{{ route('admin.fakta-cepat.edit', $faktaCepat->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900">
                                        <x-heroicon-s-pencil class="h-4 w-4" />
                                    </a>
                                    
                                    @if ($faktaCepat->status === 'pending')
                                        <form method="POST" action="{{ route('admin.fakta-cepat.approve', $faktaCepat->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Yakin ingin approve?')"
                                                class="text-green-600 hover:text-green-900">
                                                <x-heroicon-s-check class="h-4 w-4" />
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.fakta-cepat.reject', $faktaCepat->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Yakin ingin reject?')"
                                                class="text-red-600 hover:text-red-900">
                                                <x-heroicon-s-x-mark class="h-4 w-4" />
                                            </button>
                                        </form>
                                    @endif

                                    <form method="POST" action="{{ route('admin.fakta-cepat.destroy', $faktaCepat->id) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin hapus?')"
                                            class="text-red-600 hover:text-red-900">
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

    @if (session('success'))
        <div class="fixed bottom-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"
            role="alert">
            {{ session('success') }}
        </div>
    @endif

    <script>
        // Filter Status
        function filterStatus(status) {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const faktaCepatRows = document.querySelectorAll('.fakta-cepat-row');

            // Update filter button styles
            filterButtons.forEach(btn => {
                btn.classList.remove('bg-[#0F766E]', 'text-white');
                btn.classList.add('bg-gray-100', 'text-gray-700');
            });

            event.target.classList.remove('bg-gray-100', 'text-gray-700');
            event.target.classList.add('bg-[#0F766E]', 'text-white');

            // Filter fakta cepat
            faktaCepatRows.forEach(row => {
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
