<x-app-layout>
    <div class="w-full py-10 px-4 bg-gradient-to-b from-teal-50 to-white">
        
        {{-- Judul Halaman --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-1">Profil Pengguna</h1>
            <p class="text-gray-500">Kelola informasi pribadi Anda</p>
        </div>

        {{-- Container --}}
        <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-2xl overflow-hidden">

            {{-- Header Profil --}}
            <div class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-6 py-10 relative">

                {{-- Tombol Kembali --}}
                <a href="{{ url()->previous() }}"
                    class="absolute top-6 left-6 bg-white/20 hover:bg-white/30 text-white px-4 py-2 text-sm rounded-lg backdrop-blur-md flex items-center gap-2 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>

                {{-- Tombol Edit (Scroll ke form) --}}
                <button onclick="document.getElementById('profile-section').scrollIntoView({behavior: 'smooth'})"
                    class="absolute top-6 right-6 bg-white text-teal-600 px-4 py-2 text-sm rounded-lg hover:bg-gray-100 transition flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536M9 11l6.232-6.232a2 2 0 112.828 2.828L11.828 13.83a2 2 0 01-.707.464L7 15l1.707-4.121A2 2 0 019 11z" />
                    </svg>
                    Edit Profil
                </button>

                {{-- Foto Profil --}}
                <div class="flex flex-col items-center mt-6">
                    <div class="bg-white rounded-full w-28 h-28 flex items-center justify-center shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-teal-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-4.41 0-8 2.69-8 6v2h16v-2c0-3.31-3.59-6-8-6z" />
                        </svg>
                    </div>

                    <h2 class="text-2xl font-semibold mt-4">{{ Auth::user()->name }}</h2>
                    <p class="text-teal-100">{{ Auth::user()->email }}</p>
                    <p class="text-teal-100 text-sm mt-1">{{ Auth::user()->username ?? '-' }}</p>
                </div>
            </div>

            {{-- Bagian Form --}}
            <div class="px-8 py-10 space-y-10">

                {{-- INFORMASI PRIBADI --}}
                <div>
                    <h3 class="text-lg font-semibold text-teal-700 flex items-center gap-2 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-4.41 0-8 2.69-8 6v2h16v-2c0-3.31-3.59-6-8-6z">
                            </path>
                        </svg>
                        Informasi Pribadi
                    </h3>

                    {{-- Tampilkan Data Profil (Read Only) --}}
                    <div class="bg-teal-50 p-6 rounded-lg shadow-sm mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-medium text-gray-700 mb-2">Nama Lengkap</h4>
                                <p class="text-gray-900">{{ Auth::user()->name }}</p>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-700 mb-2">Email</h4>
                                <p class="text-gray-900">{{ Auth::user()->email }}</p>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-700 mb-2">Username</h4>
                                <p class="text-gray-900">{{ Auth::user()->username ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- INFORMASI LOKASI --}}
                <div>
                    <h3 class="text-lg font-semibold text-teal-700 flex items-center gap-2 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Informasi Lokasi
                    </h3>

                    {{-- Tampilkan Data Lokasi (Read Only) --}}
                    <div class="bg-teal-50 p-6 rounded-lg shadow-sm">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <h4 class="font-medium text-gray-700 mb-2">Provinsi</h4>
                                <p class="text-gray-900">{{ Auth::user()->province ?? '-' }}</p>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-700 mb-2">Kabupaten/Kota</h4>
                                <p class="text-gray-900">{{ Auth::user()->regency ?? '-' }}</p>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-700 mb-2">Kecamatan</h4>
                                <p class="text-gray-900">{{ Auth::user()->district ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Form Update Profil --}}
                <div id="profile-section" class="bg-white p-6 rounded-lg shadow-sm border border-teal-100">
                    @include('profile.partials.update-profile-information-form')
                </div>

                {{-- GANTI PASSWORD --}}
                <div>
                    <h3 class="text-lg font-semibold text-teal-700 flex items-center gap-2 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 11c1.657 0 3-1.343 3-3V6a3 3 0 00-6 0v2c0 1.657 1.343 3 3 3zm0 0v3m-6 4h12a2 2 0 002-2v-3a2 2 0 00-2-2H6a2 2 0 00-2 2v3a2 2 0 002 2z" />
                        </svg>
                        Ganti Password
                    </h3>

                    <div class="bg-teal-50 p-6 rounded-lg shadow-sm">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                {{-- HAPUS AKUN --}}
                <div>
                    <h3 class="text-lg font-semibold text-red-600 flex items-center gap-2 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a2 2 0 00-2-2H9a2 2 0 00-2 2v3m12 0H5">
                            </path>
                        </svg>
                        Hapus Akun
                    </h3>

                    <div class="bg-red-50 p-6 rounded-lg shadow-sm">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>