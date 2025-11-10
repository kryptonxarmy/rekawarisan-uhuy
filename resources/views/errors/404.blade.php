<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 | Page Not Found</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-12px); }
    }
    .animate-float { animation: float 3s ease-in-out infinite; }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }
    .animate-fadeIn { animation: fadeIn 1s ease-out forwards; }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">

  <div class="text-center animate-fadeIn px-6">
    <!-- Icon -->
    <div class="flex justify-center mb-8 animate-float">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="w-32 h-32 text-gray-800 md:w-40 md:h-40">
        <path fill="currentColor" d="M32 2C15.43 2 2 15.43 2 32s13.43 30 30 30 30-13.43 30-30S48.57 2 32 2zm0 56C17.67 58 6 46.33 6 32S17.67 6 32 6s26 11.67 26 26-11.67 26-26 26z"/>
        <circle cx="23" cy="28" r="3" fill="currentColor"/>
        <circle cx="41" cy="28" r="3" fill="currentColor"/>
        <path fill="currentColor" d="M20 42c0 0 4 4 12 4s12-4 12-4l-2-2s-3 3-10 3-10-3-10-3l-2 2z"/>
      </svg>
    </div>

    <!-- Error Code -->
    <h1 class="text-9xl md:text-[160px] font-extrabold text-gray-900 tracking-wider leading-none">404</h1>

    <!-- Message -->
    <p class="text-2xl md:text-3xl font-semibold text-gray-700 mt-4">Oops! Page not found</p>
    <p class="text-gray-500 mt-2 text-lg md:text-xl">The page you’re looking for doesn’t exist or has been moved.</p>

    <!-- Button -->
    <a href="{{ url('/') }}"
       class="inline-block mt-10 px-10 py-4 bg-black text-white text-lg md:text-xl font-medium rounded-md shadow-lg hover:bg-gray-800 transition duration-300">
      Go Home
    </a>
  </div>

</body>
</html>
