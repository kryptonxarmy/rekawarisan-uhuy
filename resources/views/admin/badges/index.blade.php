@extends('admin.AdminLayout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Kelola Badge</h1>
        {{-- Pastikan route ini ada dan benar --}}
        <a href="{{ route('admin.badges.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Buat Badge Baru
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Syarat Poin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($badges as $badge)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $badge->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $badge->name }}</td>
                        
                        {{-- KOLOM GAMBAR BADGE (LOGIKA PERBAIKAN SINTAKS) --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($badge->image)
                                @php
                                    $imageSource = '';
                                    
                                    // Pengecekan path lama vs path storage (dinamis)
                                    if (str_contains($badge->image, 'assets/')) {
                                        // Path Lama (Statis)
                                        $imageSource = asset($badge->image);
                                    } else {
                                        // Path Baru (Storage) - Menggunakan namespace penuh untuk menghindari error
                                        $imageSource = \Illuminate\Support\Facades\Storage::url($badge->image); 
                                    }
                                @endphp
                                
                                <img src="{{ $imageSource }}" 
                                     alt="{{ $badge->name }}" 
                                     class="h-10 w-10 object-cover rounded"
                                     title="{{ $badge->image }}"> 
                                
                            @else
                                <span class="text-gray-400">N/A</span>
                            @endif
                        </td>
                        {{-- AKHIR KOLOM GAMBAR BADGE --}}
                        
                        <td class="px-6 py-4 max-w-xs overflow-hidden truncate" title="{{ $badge->description }}">
                            {{ $badge->description }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $badge->points_requirement }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $badge->users_count }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.badges.edit', $badge->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                            <form action="{{ route('admin.badges.destroy', $badge->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus badge ini? Tindakan ini tidak dapat dibatalkan.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection