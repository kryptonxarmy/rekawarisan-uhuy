<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lupa Password</title>
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

    .forgot-container {
      background: #fff;
      border-radius: 28px;
      box-shadow: 0 25px 70px rgba(0, 0, 0, 0.25);
      width: 100%;
      max-width: 540px;
      padding: 60px 65px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h2 {
      text-align: center;
      color: #0d7377;
      margin-bottom: 25px;
      font-size: 32px;
      font-weight: 700;
    }

    .description {
      text-align: center;
      color: #6b7280;
      font-size: 16px;
      line-height: 1.8;
      margin-bottom: 40px;
    }

    .status-message {
      background: #d1fae5;
      border: 1px solid #6ee7b7;
      color: #065f46;
      padding: 14px 18px;
      border-radius: 10px;
      margin-bottom: 25px;
      font-size: 14px;
      width: 100%;
      text-align: center;
      font-weight: 500;
    }

    form {
      width: 100%;
    }

    .form-group {
      margin-bottom: 25px;
    }

    label {
      display: block;
      font-weight: 600;
      color: #374151;
      margin-bottom: 10px;
      font-size: 15px;
    }

    input {
      width: 100%;
      padding: 15px 18px;
      border: 2px solid #e5e7eb;
      border-radius: 10px;
      font-size: 16px;
      background: #f9fafb;
      outline: none;
      transition: all 0.3s ease;
    }

    input:focus {
      border-color: #0d7377;
      box-shadow: 0 0 0 3px rgba(13, 115, 119, 0.1);
      background: white;
    }

    /* Tombol sekarang lebih kecil dan di tengah */
    .button-container {
      display: flex;
      justify-content: center; /* 🔹 tombol di tengah */
      margin-top: 20px;
    }

    .submit-button {
      padding: 12px 28px; /* 🔹 kecil dan proporsional */
      background: #0d7377;
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(13, 115, 119, 0.3);
    }

    .submit-button:hover {
      background: #096b6f;
      transform: translateY(-2px);
    }

    .footer-text {
      text-align: center;
      margin-top: 32px;
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
      .forgot-container {
        max-width: 90%;
        padding: 45px 30px;
      }

      h2 {
        font-size: 26px;
      }

      .description {
        font-size: 14px;
        margin-bottom: 28px;
      }

      .submit-button {
        width: 100%;
        text-align: center;
      }
    }
  </style>
</head>
<body>
  <div class="forgot-container">
    <h2>Lupa Password?</h2>

    <p class="description">
      Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimkan tautan reset password yang memungkinkan Anda memilih yang baru.
    </p>

    @if (session('status'))
      <div class="status-message">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
      @csrf

      <div class="form-group">
        <label for="email">Alamat Email</label>
        <input 
          id="email" 
          type="email" 
          name="email" 
          value="{{ old('email') }}"
          placeholder="contoh@email.com" 
          required 
          autofocus
          class="@error('email') error @enderror"
        >
        @error('email')
          <span class="error-message">{{ $message }}</span>
        @enderror
      </div>

      <div class="button-container">
        <button type="submit" class="submit-button">
        Reset Password
        </button>
      </div>
    </form>

    <div class="footer-text">
      Ingat password Anda?
      <a href="{{ route('login') }}" class="footer-link">Kembali ke Login</a>
    </div>
  </div>
</body>
</html>
