<section>
    {{-- 1. LOAD ASSETS (JQUERY & SELECT2) --}}
    {{-- Sebaiknya dipindah ke Layout utama, tapi ditaruh sini agar langsung jalan --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    {{-- Styling Custom untuk Select2 agar mirip Tailwind --}}
    <style>
        .select2-container .select2-selection--single {
            height: 42px !important;
            border: 1px solid #d1d5db !important; /* gray-300 */
            border-radius: 0.375rem !important; /* rounded-md */
            padding: 0.375rem 0.75rem !important;
            display: flex !important;
            align-items: center !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #111827 !important; /* gray-900 */
            line-height: normal !important;
        }
    </style>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Perbarui informasi profil akun dan alamat email Anda.") }}
        </p>
    </header>

    {{-- NOTIFIKASI --}}
    <div class="mt-4">
        @if (session('status') === 'profile-updated')
            <div x-data="{ show: true }"
                 x-show="show"
                 x-transition
                 x-init="setTimeout(() => show = false, 3000)"
                 class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg border border-green-200 flex items-center gap-2"
                 role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <span class="font-medium">Berhasil!</span> Profil Anda telah diperbarui.
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div x-data="{ show: true }"
                 x-show="show"
                 x-transition
                 class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg border border-red-200 flex items-start gap-2"
                 role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <span class="font-medium">Gagal!</span> Silakan periksa kembali inputan Anda di bawah.
                </div>
            </div>
        @endif
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- BARIS 1: NAMA & USERNAME --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Name --}}
            <div>
                <x-input-label for="name" :value="__('Nama Lengkap')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            {{-- Username --}}
            <div>
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('username')" />
            </div>
        </div>

        {{-- BARIS 2: EMAIL --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Alamat email Anda belum diverifikasi.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- BARIS 3: LOKASI (SELECT2 + API) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            {{-- PROVINSI --}}
            <div>
                <x-input-label for="provinsi" :value="__('Provinsi')" />
                
                {{-- Select UI untuk API --}}
                <select id="provinsi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Cari Provinsi...</option>
                    @if($user->province)
                        <option value="selected_by_user" selected>{{ $user->province }}</option>
                    @endif
                </select>

                {{-- Input Hidden untuk menyimpan NAMA ke Database --}}
                <input type="hidden" id="province_name" name="province" value="{{ old('province', $user->province) }}">
                
                <x-input-error class="mt-2" :messages="$errors->get('province')" />
            </div>

            {{-- KABUPATEN/KOTA --}}
            <div>
                <x-input-label for="kota" :value="__('Kabupaten/Kota')" />
                
                <select id="kota" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" disabled>
                    <option value="">Pilih Provinsi Dulu...</option>
                    @if($user->regency)
                        <option value="selected_by_user" selected>{{ $user->regency }}</option>
                    @endif
                </select>

                <input type="hidden" id="kota_name" name="regency" value="{{ old('regency', $user->regency) }}">
                
                <x-input-error class="mt-2" :messages="$errors->get('regency')" />
            </div>

            {{-- KECAMATAN --}}
            <div>
                <x-input-label for="kecamatan" :value="__('Kecamatan')" />
                
                <select id="kecamatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" disabled>
                    <option value="">Pilih Kota Dulu...</option>
                    @if($user->district)
                        <option value="selected_by_user" selected>{{ $user->district }}</option>
                    @endif
                </select>

                <input type="hidden" id="kecamatan_name" name="district" value="{{ old('district', $user->district) }}">
                
                <x-input-error class="mt-2" :messages="$errors->get('district')" />
            </div>
        </div>

        {{-- TOMBOL SIMPAN --}}
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
        </div>
    </form>

    {{-- SCRIPT LOGIKA API WILAYAH --}}
    <script>
        $(document).ready(function() {
            // 1. INISIALISASI SELECT2
            $('#provinsi').select2({ placeholder: "Cari Provinsi...", allowClear: true, width: '100%' });
            $('#kota').select2({ placeholder: "Cari Kota/Kab...", allowClear: true, width: '100%' });
            $('#kecamatan').select2({ placeholder: "Cari Kecamatan...", allowClear: true, width: '100%' });

            // 2. LOAD PROVINSI AWAL
            fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                .then(response => response.json())
                .then(data => {
                    let userProv = "{{ $user->province }}"; // Data lama dari DB
                    let options = '<option value="">Cari Provinsi...</option>';
                    
                    data.forEach(prov => {
                        // Jika nama provinsi sama dengan database, set selected
                        let isSelected = (prov.name === userProv) ? 'selected' : '';
                        options += `<option value="${prov.id}" ${isSelected}>${prov.name}</option>`;
                    });
                    
                    $('#provinsi').html(options);
                })
                .catch(error => console.error('Error loading provinces:', error));

            // 3. EVENT CHANGE PROVINSI
            $('#provinsi').on('change', function() {
                const provId = $(this).val();
                const provName = $("#provinsi option:selected").text();
                
                // Simpan Nama ke Hidden Input
                if(provId) {
                    $('#province_name').val(provName);
                }

                // Reset Kota & Kecamatan
                $('#kota').html('<option value="">Loading...</option>').prop('disabled', true).trigger('change');
                $('#kecamatan').html('<option value="">Pilih Kota Dulu</option>').prop('disabled', true).trigger('change');
                $('#kota_name').val('');
                $('#kecamatan_name').val('');

                if (provId && provId !== 'selected_by_user') {
                    $('#kota').prop('disabled', false);
                    
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`)
                        .then(response => response.json())
                        .then(data => {
                            let options = '<option value="">Cari Kota/Kab...</option>';
                            data.forEach(kota => {
                                options += `<option value="${kota.id}">${kota.name}</option>`;
                            });
                            $('#kota').html(options);
                        });
                }
            });

            // 4. EVENT CHANGE KOTA
            $('#kota').on('change', function() {
                const kotaId = $(this).val();
                const kotaName = $("#kota option:selected").text();
                
                // Simpan Nama ke Hidden Input
                if(kotaId) {
                    $('#kota_name').val(kotaName);
                }

                // Reset Kecamatan
                $('#kecamatan').html('<option value="">Loading...</option>').prop('disabled', true).trigger('change');
                $('#kecamatan_name').val('');

                if (kotaId && kotaId !== 'selected_by_user') {
                    $('#kecamatan').prop('disabled', false);

                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kotaId}.json`)
                        .then(response => response.json())
                        .then(data => {
                            let options = '<option value="">Cari Kecamatan...</option>';
                            data.forEach(kec => {
                                options += `<option value="${kec.id}">${kec.name}</option>`;
                            });
                            $('#kecamatan').html(options);
                        });
                }
            });

            // 5. EVENT CHANGE KECAMATAN
            $('#kecamatan').on('change', function() {
                const kecName = $("#kecamatan option:selected").text();
                if($(this).val()) {
                    $('#kecamatan_name').val(kecName);
                }
            });
        });
    </script>
</section>