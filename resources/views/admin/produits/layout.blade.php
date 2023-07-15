<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>ENG</title>


  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
  <style>
    body {
      font-family: 'Lato', sans-serif;
    }
  </style>
  <!-- Scripts -->
  @vite( 'resources/js/app.js')
</head>

<body class="overflow-x-hidden">
  <div id="app">



  <nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700 shadow-lg w-screen h-26 fixed top-0 z-10">
      <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
        <div>
          <a href="/admin" class="flex items-center gap-2 ">
            <img src="{{ asset('images/logo.jpg') }}" alt="#" class="h-10 w-10 rounded-full ">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">ENG</span>
          </a>
        </div>
        <div class="pl-28">Admin: {{ Auth::user()->name }}</div>



        <div>
          <ul class="flex justify-center items-center gap-4">
            <li>
              <a href="/admin" class="block py-2 pl-3 pr-4 text-[#F16B07] hover:text-[#ab4c04]  rounded" aria-current="page">Dashboard</a>
            </li>
            <div>

            </div>
            <div>
              <!-- Dropdown  -->
              <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-black hover:text-[#ab4c04]  font-medium rounded-lg text-lg px-4 py-2.5 text-center inline-flex items-center" type="button">Gérer<svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg></button>
              <!-- Dropdown menu -->
              <div id="dropdown" class="absolute top-16  z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                  <li>
                    <a href="/admin/users" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">les utilisateurs</a>
                  </li>
                  <li>
                    <a href="/admin/units" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">les unités</a>
                  </li>

                  <li>
                    <a href="/admin/produits" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">les produits</a>
                  </li>
                  <li>
                    <a href="{{ route('familles.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Les familles</a>
                  </li>
                  <li>
  <a href="{{ route('activites.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Les Activites</a>
</li>

                </ul>
              </div>
            </div>


            <a href="#" class="pr-4 text-gray-900 rounded hover:bg-[#af540e]">
              <a class="bg-[#F16B07] text-white p-2 pr-4 pl-4 rounded-full hover:bg-[#af540e]" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
              </form>
            </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>




<div class="mt-24">
  @yield('content')

@yield('edit')

@yield('create')
</div>


</div>
  <script>
    const dropdownToggle = document.querySelector('[data-dropdown-toggle]');
    const dropdownMenu = document.getElementById('dropdown');
    // Hide the dropdown menu by default
    dropdownMenu.classList.add('hidden');
    // Toggle the dropdown menu on hover
    dropdownToggle.addEventListener('mouseover', function() {
      dropdownMenu.classList.toggle('hidden');
    });
    // Hide the dropdown menu when the mouse leaves the dropdown menu
    dropdownMenu.addEventListener('mouseleave', function() {
      dropdownMenu.classList.add('hidden');
    });
  </script>

</body>

</html>