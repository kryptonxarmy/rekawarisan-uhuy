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
