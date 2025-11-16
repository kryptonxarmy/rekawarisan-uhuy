<nav class="bg-white fixed w-full z-20 top-0 start-0 shadow-md">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    
    <!-- logo -->
    <a href="{{ route('beranda') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="{{ asset('assets/logo-rekawarisan.png') }}" class="h-12" alt="RekaWarisan Logo">
      <span class="self-center text-2xl font-semibold whitespace-nowrap text-gray-900">Reka Warisan</span>
    </a>

    <div class="flex items-center justify-end md:order-2">

      <!-- <a href="#" type="button" class="me-3 text-teal-600 bg-white border border-teal-600 hover:bg-teal-50 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-4 py-2 text-center">
        Masuk
      </a>
      <a href="#" type="button" class="text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-4 py-2 text-center">
        Daftar
      </a> -->
      <span class="text-gray-300 mx-1">|</span> <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="user photo">
      </button>
      
      <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-lg border-1 border-gray-200" id="user-dropdown">
        <div class="px-4 py-3">
          <span class="block text-sm text-gray-900">Bonnie Green</span>
          <span class="block text-sm text-gray-500 truncate">name@flowbite.com</span>
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
          <li>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard ( Admin )</a>
          </li>
          <li>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
          </li>
          <li>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
          </li>
          <li>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
              Keluar
            </a>
          </li>
        </ul>
      </div>
      <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-sticky" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
        </svg>
      </button>
    </div>

    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
      <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
        
        <li>
          <a href="{{ route('beranda') }}" class="block py-2 px-3 md:p-0 md:border-b-2 transition-colors duration-200 
            {{ request()->routeIs('beranda') 
                ? 'bg-teal-600 text-white rounded md:bg-transparent md:text-teal-600 md:border-teal-600 md:font-semibold md:rounded-none' 
                : 'text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-transparent md:hover:text-teal-600 md:hover:border-teal-600 md:rounded-none' 
            }}" 
            aria-current="{{ request()->routeIs('beranda') ? 'page' : 'false' }}">Beranda</a>
        </li>
        
        <li>
          <a href="#" class="block py-2 px-3 md:p-0 transition-colors duration-200"> 
            Pustaka Warisan
          </a>
        </li>
        
        <li>
          <a href="{{ route('jejakmaestro') }}" class="block py-2 px-3 md:p-0 md:border-b-2 transition-colors duration-200
            {{ request()->routeIs('jejakmaestro') 
                ? 'bg-teal-600 text-white rounded md:bg-transparent md:text-teal-600 md:border-teal-600 md:font-semibold md:rounded-none' 
                : 'text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-transparent md:hover:text-teal-600 md:hover:border-teal-600 md:rounded-none' 
            }}">Jejak Maestro</a>
        </li>

        <li>
          <a href="{{ route('contact') }}" class="block py-2 px-3 md:p-0 md:border-b-2 transition-colors duration-200
            {{ request()->routeIs('contact') 
                ? 'bg-teal-600 text-white rounded md:bg-transparent md:text-teal-600 md:border-teal-600 md:font-semibold md:rounded-none' 
                : 'text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-transparent md:hover:text-teal-600 md:hover:border-teal-600 md:rounded-none' 
            }}">Kontak</a>
        </li>

      </ul>
    </div>
  </div>
</nav>