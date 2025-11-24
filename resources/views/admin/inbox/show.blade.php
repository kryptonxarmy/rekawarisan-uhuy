@extends('admin.AdminLayout')

@section('content')
    <div class="mb-8">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.inbox.index') }}" class="text-gray-500 hover:text-gray-700">
                <x-heroicon-s-arrow-left class="h-6 w-6" />
            </a>
            <div>
                <h1 class="text-3xl font-bold text-[#0F766E]">Detail Pesan</h1>
                <p class="text-gray-600 mt-2">Lihat dan kelola pesan dari pengguna</p>
            </div>
        </div>
    </div>

    <!-- Message Detail -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-start justify-between">
                <div class="flex items-start space-x-4">
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        <img src="https://ui-avatars.com/api/?name=Ahmad+Suryadi&background=0F766E&color=fff" 
                             alt="Ahmad Suryadi" 
                             class="h-16 w-16 rounded-full">
                    </div>
                    
                    <!-- Sender Info -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Pertanyaan tentang artikel Batik Megamendung</h2>
                        <div class="flex items-center space-x-4 mt-2">
                            <div class="flex items-center text-gray-600">
                                <x-heroicon-s-user class="h-4 w-4 mr-1" />
                                <span class="font-medium">Ahmad Suryadi</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <x-heroicon-s-envelope class="h-4 w-4 mr-1" />
                                <span>ahmad@example.com</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <x-heroicon-s-clock class="h-4 w-4 mr-1" />
                                <span>15 menit yang lalu</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Badges & Actions -->
                <div class="flex items-center space-x-2">
                    <!-- Type Badge -->
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        <x-heroicon-s-question-mark-circle class="h-4 w-4 mr-1" />
                        Question
                    </span>
                    
                    <!-- Category Badge -->
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                        Artikel
                    </span>
                    
                    <!-- Important Badge -->
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                        <x-heroicon-s-star class="h-4 w-4 mr-1" />
                        Penting
                    </span>
                    
                    <!-- Status Badge -->
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                        <x-heroicon-s-envelope class="h-4 w-4 mr-1" />
                        Belum Dibaca
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Message Content -->
        <div class="p-6">
            <div class="prose max-w-none">
                <p class="text-gray-700 text-lg leading-relaxed">
                    Halo admin, saya ingin bertanya lebih detail tentang sejarah dan makna filosofis dari motif Batik Megamendung yang ada di artikel yang saya baca. Apakah ada sumber referensi lain yang bisa saya pelajari?
                </p>
                
                <p class="text-gray-700 text-lg leading-relaxed mt-4">
                    Saya sangat tertarik dengan cerita di balik motif awan yang ada pada batik tersebut, dan ingin mempelajari lebih dalam tentang bagaimana pengaruh budaya Tiongkok bisa berpadu dengan tradisi lokal Cirebon.
                </p>
                
                <p class="text-gray-700 text-lg leading-relaxed mt-4">
                    Terima kasih atas perhatiannya.
                </p>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <button onclick="markAsRead(1)" 
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center gap-2">
                        <x-heroicon-s-check class="h-4 w-4" />
                        Tandai Dibaca
                    </button>
                    
                    <button class="bg-[#0F766E] text-white px-4 py-2 rounded-lg hover:bg-[#0F766E]/90 flex items-center gap-2">
                        <x-heroicon-s-chat-bubble-left class="h-4 w-4" />
                        Balas Pesan
                    </button>
                    
                    <button class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 flex items-center gap-2">
                        <x-heroicon-s-star class="h-4 w-4" />
                        Tandai Penting
                    </button>
                </div>
                
                <div class="flex items-center space-x-2">
                    <button class="text-gray-600 hover:text-gray-800 px-3 py-2 rounded-lg border border-gray-300 hover:bg-gray-50">
                        Archive
                    </button>
                    
                    <form action="{{ route('admin.inbox.destroy', 1) }}" method="POST" class="inline"
                          onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 px-3 py-2 rounded-lg border border-red-300 hover:bg-red-50">
                            <x-heroicon-s-trash class="h-4 w-4" />
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Messages -->
    <div class="mt-8 bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Pesan Terkait dari Pengirim</h3>
        </div>
        
        <div class="p-6">
            <div class="text-center text-gray-500 py-8">
                <x-heroicon-o-inbox class="h-12 w-12 mx-auto mb-3 text-gray-400" />
                <p>Tidak ada pesan lain dari pengirim ini</p>
            </div>
        </div>
    </div>

    <script>
        function markAsRead(messageId) {
            fetch(`{{ url('admin/inbox') }}/${messageId}/mark-read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the status badge
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
