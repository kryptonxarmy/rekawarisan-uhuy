<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buat Akun Baru</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

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
      letter-spacing: -0.5px;
    }

    form {
      width: 100%;
    }

    .form-group {
      margin-bottom: 22px;
    }

    label {
      display: block;
      font-weight: 600;
      color: #374151;
      margin-bottom: 10px;
      font-size: 15px;
      letter-spacing: 0.2px;
    }

    input, select {
      width: 100%;
      padding: 14px 16px;
      border: 2px solid #e5e7eb;
      border-radius: 10px;
      font-size: 15px;
      background: #f9fafb;
      outline: none;
      transition: all 0.3s ease;
      font-family: inherit;
      line-height: 1.5;
    }

    input:focus, select:focus {
      border-color: #0d7377;
      box-shadow: 0 0 0 3px rgba(13, 115, 119, 0.1);
      background: white;
    }

    select {
      cursor: pointer;
    }

    select:disabled {
      background: #f3f4f6;
      cursor: not-allowed;
      opacity: 0.6;
    }

    /* Error messages styling */
    .error-message {
      color: #dc2626;
      font-size: 13px;
      margin-top: 8px;
      display: block;
      font-weight: 500;
    }

    input.error, select.error {
      border-color: #dc2626;
    }

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
      width: 20px;
      height: 20px;
      min-width: 20px;
      margin-top: 2px;
      accent-color: #0d7377;
      cursor: pointer;
    }

    .checkbox-group label {
      font-size: 14px;
      color: #6b7280;
      line-height: 1.7;
      cursor: pointer;
      margin: 0;
      font-weight: 400;
    }

    .checkbox-group a {
      color: #0d7377;
      font-weight: 600;
      text-decoration: none;
    }

    .checkbox-group a:hover {
      text-decoration: underline;
    }

    .register-button {
      width: 100%;
      padding: 16px;
      background: #0d7377;
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 17px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 8px;
      box-shadow: 0 4px 12px rgba(13, 115, 119, 0.3);
      letter-spacing: 0.3px;
    }

    .register-button:hover:enabled {
      background: #096b6f;
      transform: translateY(-1px);
      box-shadow: 0 6px 16px rgba(13, 115, 119, 0.4);
    }

    .register-button:active:enabled {
      transform: translateY(0);
    }

    .register-button:disabled {
      background: #d1d5db;
      cursor: not-allowed;
      box-shadow: none;
      opacity: 0.7;
    }

    .footer-text {
      text-align: center;
      margin-top: 28px;
      font-size: 15px;
      color: #6b7280;
    }

    .footer-link {
      color: #0d7377;
      text-decoration: none;
      font-weight: 600;
      margin-left: 4px;
    }

    .footer-link:hover {
      text-decoration: underline;
    }

    @media (max-width: 600px) {
      .register-container {
        padding: 38px 32px;
      }

      .logo {
        width: 280px;
      }

      h2 {
        font-size: 26px;
        margin-bottom: 28px;
      }

      label {
        font-size: 14px;
      }

      input, select {
        padding: 13px 14px;
        font-size: 15px;
      }

      .form-group {
        margin-bottom: 20px;
      }

      .checkbox-group label {
        font-size: 13px;
      }

      .register-button {
        font-size: 16px;
        padding: 15px;
      }
    }
  </style>
</head>
<body>
  <div class="register-container">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">

    <h2>Buat Akun Baru</h2>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Nama Lengkap -->
      <div class="form-group">
        <label for="name">Nama Lengkap</label>
        <input 
          id="name" 
          type="text" 
          name="name" 
          value="{{ old('name') }}"
          placeholder="Masukkan nama lengkap" 
          required 
          autofocus
          class="@error('name') error @enderror"
        >
        @error('name')
          <span class="error-message">{{ $message }}</span>
        @enderror
      </div>

      <!-- Provinsi -->
      <div class="form-group">
        <label for="provinsi">Provinsi</label>
        <select 
          id="provinsi" 
          name="provinsi" 
          required
          class="@error('provinsi') error @enderror"
        >
          <option value="">Pilih Provinsi</option>
        </select>
        @error('provinsi')
          <span class="error-message">{{ $message }}</span>
        @enderror
      </div>

      <!-- Kota / Kabupaten -->
      <div class="form-group">
        <label for="kota">Kota / Kabupaten</label>
        <select 
          id="kota" 
          name="kota" 
          required 
          disabled
          class="@error('kota') error @enderror"
        >
          <option value="">Pilih Kota / Kabupaten</option>
        </select>
        @error('kota')
          <span class="error-message">{{ $message }}</span>
        @enderror
      </div>

      <!-- Kecamatan -->
      <div class="form-group">
        <label for="kecamatan">Kecamatan</label>
        <select 
          id="kecamatan" 
          name="kecamatan" 
          required 
          disabled
          class="@error('kecamatan') error @enderror"
        >
          <option value="">Pilih Kecamatan</option>
        </select>
        @error('kecamatan')
          <span class="error-message">{{ $message }}</span>
        @enderror
      </div>

      <!-- Username -->
      <div class="form-group">
        <label for="username">Username</label>
        <input 
          id="username" 
          type="text" 
          name="username" 
          value="{{ old('username') }}"
          placeholder="Masukkan username" 
          required
          class="@error('username') error @enderror"
        >
        @error('username')
          <span class="error-message">{{ $message }}</span>
        @enderror
      </div>

      <!-- Email -->
      <div class="form-group">
        <label for="email">Email</label>
        <input 
          id="email" 
          type="email" 
          name="email" 
          value="{{ old('email') }}"
          placeholder="contoh@email.com" 
          required
          autocomplete="username"
          class="@error('email') error @enderror"
        >
        @error('email')
          <span class="error-message">{{ $message }}</span>
        @enderror
      </div>

      <!-- Password -->
      <div class="form-group">
        <label for="password">Password</label>
        <input 
          id="password" 
          type="password" 
          name="password" 
          placeholder="Minimal 8 karakter" 
          required
          autocomplete="new-password"
          class="@error('password') error @enderror"
        >
        @error('password')
          <span class="error-message">{{ $message }}</span>
        @enderror
      </div>

      <!-- Konfirmasi Password -->
      <div class="form-group">
        <label for="password_confirmation">Konfirmasi Password</label>
        <input 
          id="password_confirmation" 
          type="password" 
          name="password_confirmation" 
          placeholder="Ulangi password" 
          required
          autocomplete="new-password"
          class="@error('password_confirmation') error @enderror"
        >
        @error('password_confirmation')
          <span class="error-message">{{ $message }}</span>
        @enderror
      </div>

      <!-- Checkbox Persetujuan -->
      <div class="checkbox-group">
        <input type="checkbox" id="agree" name="agree" required>
        <label for="agree">
          Dengan menekan <b>Daftar</b>, Anda menyetujui <a href="#">Syarat</a> dan <a href="#">Kebijakan Privasi</a> kami.
        </label>
      </div>
      @error('agree')
        <span class="error-message">{{ $message }}</span>
      @enderror

      <button type="submit" id="registerButton" class="register-button" disabled>
        Daftar
      </button>

      <div class="footer-text">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="footer-link">Masuk</a>
      </div>
    </form>
  </div>

  <script>
    const provinsiSelect = document.getElementById('provinsi');
    const kotaSelect = document.getElementById('kota');
    const kecamatanSelect = document.getElementById('kecamatan');
    const agreeCheckbox = document.getElementById('agree');
    const registerButton = document.getElementById('registerButton');

    // Enable tombol hanya jika checkbox disetujui
    agreeCheckbox.addEventListener('change', () => {
      registerButton.disabled = !agreeCheckbox.checked;
    });

    // API Wilayah Indonesia
    fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
      .then(res => res.json())
      .then(data => {
        data.forEach(prov => {
          const option = document.createElement('option');
          option.value = prov.id;
          option.textContent = prov.name;
          provinsiSelect.appendChild(option);
        });
      })
      .catch(err => console.error('Error loading provinces:', err));

    provinsiSelect.addEventListener('change', () => {
      kotaSelect.innerHTML = '<option value="">Pilih Kota / Kabupaten</option>';
      kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
      kotaSelect.disabled = true;
      kecamatanSelect.disabled = true;

      if (provinsiSelect.value) {
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinsiSelect.value}.json`)
          .then(res => res.json())
          .then(data => {
            data.forEach(kota => {
              const option = document.createElement('option');
              option.value = kota.id;
              option.textContent = kota.name;
              kotaSelect.appendChild(option);
            });
            kotaSelect.disabled = false;
          })
          .catch(err => console.error('Error loading regencies:', err));
      }
    });

    kotaSelect.addEventListener('change', () => {
      kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
      kecamatanSelect.disabled = true;

      if (kotaSelect.value) {
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kotaSelect.value}.json`)
          .then(res => res.json())
          .then(data => {
            data.forEach(kec => {
              const option = document.createElement('option');
              option.value = kec.id;
              option.textContent = kec.name;
              kecamatanSelect.appendChild(option);
            });
            kecamatanSelect.disabled = false;
          })
          .catch(err => console.error('Error loading districts:', err));
      }
    });
  </script>
</body>
</html>