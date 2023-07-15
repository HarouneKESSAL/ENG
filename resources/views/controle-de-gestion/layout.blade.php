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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/css/bootstrap-notify.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3.1.4/notyf.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/notyf@3.1.4/notyf.min.js"></script>  
  <!-- Scripts -->
  @vite( 'resources/js/app.js')
</head>

<body class="overflow-x-hidden  ">
  <div id="app">


    <nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700 shadow-lg w-screen h-26">
      <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
        <div>
          <a href="/controle-de-gestion" class="flex items-center gap-2 ">
            <img src="{{ asset('images/logo.jpg') }}" alt="#" class="h-10 w-10 rounded-full ">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">ENG</span>
          </a>
        </div>
        <div class="pl-28">Controleur : {{ Auth::user()->name }}</div>



        <div>
          <ul class="flex justify-center items-center gap-4">
            <li>
              <a href="/controle-de-gestion/create" class="block py-2 pl-3 pr-4 text-[#F16B07] hover:text-[#ab4c04]  rounded" aria-current="page">Dashboard</a>
            </li>
            <li>
              <a href="/controle-de-gestion/create-previsions" class="block py-2 pl-3 pr-4 text-[#F16B07] hover:text-[#ab4c04]  rounded" aria-current="page">Previsions</a>
            </li>
            
            <div>

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
  <center>
    @yield('create')

  </center>
   







      <!-- ######################################### -->
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