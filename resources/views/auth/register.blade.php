<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buat Akun Baru</title>
  
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  
  <style>
    /* --- RESET & BASIC STYLE --- */
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Segoe UI', Roboto, Arial, sans-serif;
      background-color: #0d7377;
      background-image: url('{{ asset("images/bg-login.jpg") }}'); 
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    
    .register-container {
      background: #fff;
      border-radius: 24px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 580px;
      padding: 45px 50px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .logo {
      width: 350px;
      max-width: 90%;
      height: auto;
      margin-bottom: 35px;
      display: block;
    }

    h2 {
      text-align: center;
      color: #0d7377;
      margin-bottom: 35px;
      font-size: 30px;
      font-weight: 700;
    }

    form { width: 100%; }
    .form-group { margin-bottom: 22px; }

    label {
      display: block;
      font-weight: 600;
      color: #374151;
      margin-bottom: 10px;
      font-size: 15px;
    }

    /* --- STYLE INPUT BIASA --- */
    input {
      width: 100%;
      padding: 14px 16px;
      border: 2px solid #e5e7eb;
      border-radius: 10px;
      font-size: 15px;
      background: #f9fafb;
      outline: none;
      transition: all 0.3s ease;
    }
    input:focus {
      border-color: #0d7377;
      box-shadow: 0 0 0 3px rgba(13, 115, 119, 0.1);
      background: white;
    }

    /* --- CUSTOM STYLE UNTUK SELECT2 --- */
    .select2-container .select2-selection--single {
      height: 52px !important;
      border: 2px solid #e5e7eb !important;
      border-radius: 10px !important;
      background-color: #f9fafb !important;
      display: flex !important;
      align-items: center !important;
      transition: all 0.3s ease !important;
      position: relative !important;
    }

    /* Teks di dalam dropdown */
    .select2-container--default .select2-selection--single .select2-selection__rendered {
      padding-left: 16px !important;
      color: #333 !important;
      font-size: 15px !important;
      line-height: normal !important;
      width: calc(100% - 60px) !important; /* Beri ruang untuk clear button */
      padding-right: 50px !important;
    }

    /* --- STYLE CUSTOM UNTUK CLEAR BUTTON (SILANG) DI DALAM KOTAK --- */
    .select2-container--default .select2-selection--single .select2-selection__clear {
      color: transparent !important;
      position: absolute !important;
      right: 35px !important; /* Posisi di dalam, sebelah kiri panah dropdown */
      top: 50% !important;
      transform: translateY(-50%) !important;
      width: 20px !important;
      height: 20px !important;
      border-radius: 4px !important;
      transition: all 0.3s ease !important;
      background: #ef4444 !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      z-index: 10 !important;
      margin-right: 0 !important;
    }

    /* Buat X custom dengan pseudo-element */
    .select2-container--default .select2-selection--single .select2-selection__clear::before,
    .select2-container--default .select2-selection--single .select2-selection__clear::after {
      content: '' !important;
      position: absolute !important;
      top: 50% !important;
      left: 50% !important;
      width: 12px !important;
      height: 2px !important;
      background: white !important;
      border-radius: 1px !important;
      transition: all 0.2s ease !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__clear::before {
      transform: translate(-50%, -50%) rotate(45deg) !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__clear::after {
      transform: translate(-50%, -50%) rotate(-45deg) !important;
    }

    /* Hover effect */
    .select2-container--default .select2-selection--single .select2-selection__clear:hover {
      background: #dc2626 !important;
      transform: translateY(-50%) scale(1.1) !important;
    }

    /* Atur posisi panah dropdown agar tidak bertabrakan */
    .select2-container--default .select2-selection--single .select2-selection__arrow {
      right: 8px !important;
      height: 50px !important;
    }

    /* Saat Dropdown Diklik/Aktif */
    .select2-container--open .select2-selection--single {
      border-color: #0d7377 !important;
      box-shadow: 0 0 0 3px rgba(13, 115, 119, 0.1) !important;
      background-color: #fff !important;
    }

    /* Kotak List Pilihan yang Muncul */
    .select2-dropdown {
      border: 2px solid #0d7377 !important;
      border-radius: 10px !important;
      overflow: hidden !important;
      margin-top: 5px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    /* Input pencarian di dropdown */
    .select2-container--default .select2-search--dropdown .select2-search__field {
      border: 2px solid #e5e7eb !important;
      border-radius: 8px !important;
      padding: 10px 12px !important;
      font-size: 14px !important;
      margin-bottom: 10px;
      outline: none;
      transition: all 0.3s ease !important;
    }
    
    .select2-container--default .select2-search--dropdown .select2-search__field:focus {
      border-color: #0d7377 !important;
      box-shadow: 0 0 0 2px rgba(13, 115, 119, 0.1) !important;
    }
    
    /* Item dalam dropdown */
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
      background-color: #0d7377 !important;
      color: white !important;
    }

    /* Loading state */
    .select2-container--default .select2-results__option[aria-disabled=true] {
      color: #6b7280 !important;
      font-style: italic;
    }
    
    /* ---------------------------------------------------------- */

    .error-message {
      color: #dc2626;
      font-size: 13px;
      margin-top: 8px;
      display: block;
      font-weight: 500;
    }
    input.error { border-color: #dc2626; }

    .checkbox-group {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      margin: 24px 0;
      padding: 18px;
      background: #f9fafb;
      border-radius: 10px;
    }
    .checkbox-group input {
      width: 20px; height: 20px; margin-top: 2px; accent-color: #0d7377;
    }
    .checkbox-group label {
      font-size: 14px; color: #6b7280; line-height: 1.7;
    }
    .checkbox-group a { color: #0d7377; font-weight: 600; text-decoration: none; }

    .register-button {
      width: 100%; padding: 16px; background: #0d7377; color: white;
      border: none; border-radius: 10px; font-size: 17px; font-weight: 600;
      cursor: pointer; transition: all 0.3s ease; margin-top: 8px;
      box-shadow: 0 4px 12px rgba(13, 115, 119, 0.3);
    }
    .register-button:hover:enabled { 
      background: #096b6f; 
      transform: translateY(-1px); 
      box-shadow: 0 6px 16px rgba(13, 115, 119, 0.4);
    }
    .register-button:disabled { 
      background: #d1d5db; 
      cursor: not-allowed; 
      opacity: 0.7; 
      box-shadow: none;
      transform: none;
    }

    .footer-text {
      text-align: center; margin-top: 28px; font-size: 15px; color: #6b7280;
    }
    .footer-link { 
      color: #0d7377; 
      text-decoration: none; 
      font-weight: 600; 
      margin-left: 4px;
      transition: color 0.2s ease;
    }
    .footer-link:hover {
      color: #065a5e;
      text-decoration: underline;
    }

    /* Animasi loading */
    @keyframes pulse {
      0% { opacity: 1; }
      50% { opacity: 0.5; }
      100% { opacity: 1; }
    }
    
    .loading {
      animation: pulse 1.5s ease-in-out infinite;
    }

    @media (max-width: 600px) {
      .register-container { padding: 38px 32px; }
      .logo { width: 280px; }
      h2 { font-size: 26px; }
    }
  </style>
</head>
<body>
  <div class="register-container">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">

    <h2>Buat Akun Baru</h2>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="form-group">
        <label for="name">Nama Lengkap</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required autofocus>
        @error('name') <span class="error-message">{{ $message }}</span> @enderror
      </div>

      <div class="form-group">
        <label>Provinsi</label>
        <select id="provinsi" name="provinsi_id" style="width: 100%" required>
          <option value="">Cari Provinsi...</option>
        </select>
        <input type="hidden" name="provinsi" id="provinsi_nama">
        
        @error('provinsi') <span class="error-message">{{ $message }}</span> @enderror
      </div>

      <div class="form-group">
        <label>Kota / Kabupaten</label>
        <select id="kota" name="kota_id" style="width: 100%" required disabled>
          <option value="">Pilih Provinsi Dulu</option>
        </select>
        <input type="hidden" name="kota" id="kota_nama">

        @error('kota') <span class="error-message">{{ $message }}</span> @enderror
      </div>

      <div class="form-group">
        <label>Kecamatan</label>
        <select id="kecamatan" name="kecamatan_id" style="width: 100%" required disabled>
          <option value="">Pilih Kota Dulu</option>
        </select>
        <input type="hidden" name="kecamatan" id="kecamatan_nama">

        @error('kecamatan') <span class="error-message">{{ $message }}</span> @enderror
      </div>
      
      <div class="form-group">
        <label for="username">Username</label>
        <input id="username" type="text" name="username" value="{{ old('username') }}" placeholder="Masukkan username" required>
        @error('username') <span class="error-message">{{ $message }}</span> @enderror
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com" required>
        @error('email') <span class="error-message">{{ $message }}</span> @enderror
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" placeholder="Minimal 8 karakter" required>
        @error('password') <span class="error-message">{{ $message }}</span> @enderror
      </div>

      <div class="form-group">
        <label for="password_confirmation">Konfirmasi Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi password" required>
      </div>

      <div class="checkbox-group">
        <input type="checkbox" id="agree" name="agree" required>
        <label for="agree">
          Dengan menekan <b>Daftar</b>, Anda menyetujui <a href="{{ route('kebijakan-privasi') }}">Syarat</a> dan <a href="{{ route('kebijakan-privasi') }}">Kebijakan Privasi</a> kami.
        </label>
      </div>

      <button type="submit" id="registerButton  class="register-button" disabled>
        Daftar
      </button>

      <div class="footer-text">
        Sudah punya akun? <a href="{{ route('login') }}" class="footer-link">Masuk</a>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    $(document).ready(function() {
        // ---------------------------------------------------------
        // 1. INISIALISASI SELECT2
        // ---------------------------------------------------------
        $('#provinsi').select2({ 
          placeholder: "Cari Provinsi...", 
          allowClear: true,
          language: {
            searching: function() {
              return "Mencari...";
            },
            noResults: function() {
              return "Provinsi tidak ditemukan";
            }
          }
        });
        
        $('#kota').select2({ 
          placeholder: "Cari Kota/Kab...", 
          allowClear: true,
          language: {
            searching: function() {
              return "Mencari...";
            },
            noResults: function() {
              return "Kota/Kabupaten tidak ditemukan";
            }
          }
        });
        
        $('#kecamatan').select2({ 
          placeholder: "Cari Kecamatan...", 
          allowClear: true,
          language: {
            searching: function() {
              return "Mencari...";
            },
            noResults: function() {
              return "Kecamatan tidak ditemukan";
            }
          }
        });

        // ---------------------------------------------------------
        // 2. LOGIKA API & DATABASE
        // ---------------------------------------------------------
        
        // A. Load Data Provinsi saat halaman dibuka
        $('#provinsi').next('.select2-container').find('.select2-selection').addClass('loading');
        
        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
            .then(response => response.json())
            .then(data => {
                let options = '<option value="">Cari Provinsi...</option>';
                data.forEach(prov => {
                    options += `<option value="${prov.id}">${prov.name}</option>`;
                });
                $('#provinsi').html(options);
                $('#provinsi').next('.select2-container').find('.select2-selection').removeClass('loading');
            })
            .catch(error => {
                console.error('Error loading provinces:', error);
                $('#provinsi').html('<option value="">Gagal memuat data provinsi</option>');
                $('#provinsi').next('.select2-container').find('.select2-selection').removeClass('loading');
            });

        // B. Event Saat Provinsi Dipilih
        $('#provinsi').on('change', function() {
            const provId = $(this).val();
            const provName = $("#provinsi option:selected").text();
            
            $('#provinsi_nama').val(provName);

            // Reset Kota & Kecamatan
            $('#kota').html('<option value="">Loading...</option>').prop('disabled', true).trigger('change');
            $('#kecamatan').html('<option value="">Pilih Kota Dulu</option>').prop('disabled', true).trigger('change');
            $('#kota_nama').val('');
            $('#kecamatan_nama').val('');

            if (provId) {
                $('#kota').next('.select2-container').find('.select2-selection').addClass('loading');
                
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`)
                .then(response => response.json())
                .then(data => {
                    let options = '<option value="">Cari Kota/Kab...</option>';
                    data.forEach(kota => {
                        options += `<option value="${kota.id}">${kota.name}</option>`;
                    });
                    $('#kota').html(options).prop('disabled', false);
                    $('#kota').next('.select2-container').find('.select2-selection').removeClass('loading');
                })
                .catch(error => {
                    console.error('Error loading cities:', error);
                    $('#kota').html('<option value="">Gagal memuat data kota</option>');
                    $('#kota').next('.select2-container').find('.select2-selection').removeClass('loading');
                });
            }
        });

        // C. Event Saat Kota Dipilih
        $('#kota').on('change', function() {
            const kotaId = $(this).val();
            const kotaName = $("#kota option:selected").text();
            
            $('#kota_nama').val(kotaName);

            // Reset Kecamatan
            $('#kecamatan').html('<option value="">Loading...</option>').prop('disabled', true).trigger('change');
            $('#kecamatan_nama').val('');

            if (kotaId) {
                $('#kecamatan').next('.select2-container').find('.select2-selection').addClass('loading');
                
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kotaId}.json`)
                .then(response => response.json())
                .then(data => {
                    let options = '<option value="">Cari Kecamatan...</option>';
                    data.forEach(kec => {
                        options += `<option value="${kec.id}">${kec.name}</option>`;
                    });
                    $('#kecamatan').html(options).prop('disabled', false);
                    $('#kecamatan').next('.select2-container').find('.select2-selection').removeClass('loading');
                })
                .catch(error => {
                    console.error('Error loading districts:', error);
                    $('#kecamatan').html('<option value="">Gagal memuat data kecamatan</option>');
                    $('#kecamatan').next('.select2-container').find('.select2-selection').removeClass('loading');
                });
            }
        });

        // D. Event Saat Kecamatan Dipilih
        $('#kecamatan').on('change', function() {
            const kecName = $("#kecamatan option:selected").text();
            $('#kecamatan_nama').val(kecName);
        });

        // ---------------------------------------------------------
        // 3. LOGIKA TOMBOL DAFTAR
        // ---------------------------------------------------------
        $('#agree').on('change', function() {
            $('#registerButton').prop('disabled', !this.checked);
        });
    });
  </script>
</body>
</html>