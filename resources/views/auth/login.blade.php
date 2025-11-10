<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Reka Warisan</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      background-color: #0d7377;
      background-image: url('{{ asset("images/bg-login.jpg") }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      background: white;
      border-radius: 30px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
      width: 500px;
      height: 780px;
      padding: 50px 55px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
    }

    .logo-container {
      width: 370px;
      height: 370px;
      margin-top: -20px; /* 🔹 Naikkan logo */
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .logo-container img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    form {
      width: 100%;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      margin-top: -30px; /* 🔹 Naikkan form sedikit */
    }

    .form-group {
      width: 100%;
      margin-bottom: 25px;
    }

    .form-input {
      width: 100%;
      padding: 18px 20px;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      font-size: 17px;
      background: #f9fafb;
      transition: all 0.3s ease;
      outline: none;
    }

    .form-input:focus {
      border-color: #0d7377;
      box-shadow: 0 0 0 4px rgba(13, 115, 119, 0.1);
      background: white;
    }

    .forgot-password-container {
      width: 100%;
      text-align: right;
      margin-top: -10px;
      margin-bottom: 30px;
    }

    .forgot-password-link {
      color: #0d7377;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
    }

    .forgot-password-link:hover {
      text-decoration: underline;
    }

    .login-button {
      width: 100%;
      padding: 18px;
      background: #0d7377;
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 18px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(13, 115, 119, 0.3);
    }

    .login-button:hover {
      background: #096b6f;
      transform: translateY(-2px);
    }

    .footer-text {
      text-align: center;
      margin-top: 20px; /* 🔹 tambahkan jarak default */
      margin-bottom: 10px;
      font-size: 15px;
      color: #6b7280;
    }

    .footer-link {
      color: #0d7377;
      font-weight: 600;
      text-decoration: none;
    }

    .footer-link:hover {
      text-decoration: underline;
    }

    /* ✅ Responsif untuk HP */
    @media (max-width: 480px) {
      .login-container {
        width: 90%;
        height: auto;
        padding: 40px 20px;
      }

      .logo-container {
        width: 260px;
        height: 260px;
        margin-top: 10px;
      }

      .form-input {
        font-size: 15px;
        padding: 15px;
      }

      .login-button {
        padding: 15px;
        font-size: 16px;
      }

      /* 🔹 Tambah jarak lebih lega di bawah tombol untuk HP */
      .footer-text {
        margin-top: 40px;
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="logo-container">
      <img src="{{ asset('images/logo.png') }}" alt="Reka Warisan Logo">
    </div>

    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="form-group">
        <input id="email" class="form-input" type="email" name="email" placeholder="Masukan Email" required autofocus>
      </div>
      <div class="form-group">
        <input id="password" class="form-input" type="password" name="password" placeholder="Masukan Password" required>
      </div>

      <div class="forgot-password-container">
        <a href="{{ route('password.request') }}" class="forgot-password-link">Lupa Password?</a>
      </div>

      <button type="submit" class="login-button">Masuk</button>
    </form>

    <div class="footer-text">
      Belum memiliki akun? <a href="{{ route('register') }}" class="footer-link">Mendaftar</a>
    </div>
  </div>
</body>
</html>
