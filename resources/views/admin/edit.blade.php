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
  <!-- Include Tippy.js CSS -->
<link rel="stylesheet" href="https://unpkg.com/@popperjs/core@2.9.3/dist/umd/popper.css" />

<!-- Include Tippy.js JavaScript -->
<script src="https://unpkg.com/@popperjs/core@2.9.3/dist/umd/popper.js"></script>

  @vite( 'resources/js/app.js')
</head>

<body class="">
  <div id="app">


    <nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700 shadow-lg w-screen h-26">
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
              <div id="dropdown" class="absolute top-16  z-100 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
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
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 5.652a.5.5 0 0 0-.707 0L10 9.293 6.357 5.652a.5.5 0 0 0-.707.707L9.293 10l-3.643 3.643a.5.5 0 0 0 .708.707L10 10.707l3.643 3.643a.5.5 0 0 0 .707-.707L10.707 10l3.641-3.648a.5.5 0 0 0 0-.7z"/>
            </svg>
        </span>
    </div>
@endif

   
    @if(session()->has('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
      <strong class="font-bold">Error!</strong>
      <span class="block sm:inline">{{ session('error') }}</span>
      <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 6.066 4.652a1 1 0 00-1.414 1.414L8.586 10l-3.934 3.934a1 1 0 001.414 1.414L10 11.414l3.934 3.934a1 1 0 001.414-1.414L11.414 10l3.934-3.934a1 1 0 000-1.414z"/></svg>
      </span>
    </div>
  @endif
    <center>
      <table class="table mt-10">
          <thead>
              <tr class="bg-gray-100 border-b">
                  <th class="px-4 py-3 w-1/12 text-left">Date</th>
                  <th class="px-4 py-3 bg-orange-200 text-center">Prévisions Production</th>
                  <th class="px-4 py-3 bg-orange-200 text-center">Réalisations Production</th>
                  <th class="px-4 py-3 bg-blue-200 text-center">Prévisions Vente</th>
                  <th class="px-4 py-3 bg-blue-200 text-center">Réalisations Vente</th>
                  <th class="px-4 py-3 bg-green-200 text-center">Prévisions Production Vendue</th>
                  <th class="px-4 py-3 bg-green-200 text-center">Réalisations Production Vendue</th>
              </tr>
          </thead>
          <tbody>
              <tr class="bg-white border-b">
                  <td class="px-4 py-3">{{ $journal->date }}</td>
                  <form action="{{ route('admin.update', ['id' => $journal->id]) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <input type="date" id="date" name="date" value="{{ $journal->date }}" hidden>

                      <input type="number" hidden id="unit_id" name="unit_id" value="{{ $journal->unit_id }}">
                      <td class="px-4 py-3"><input readonly type="number" id="Previsions_Production" name="Previsions_Production"
                              value="{{ $journal->Previsions_Production }}" class="w-full">
                            
                            </td>

                      <td class="px-4 py-3"><input type="number" id="Realisation_Production" name="Realisation_Production"
                          value="{{ $journal->Realisation_Production }}" class="w-full">
                            </td>

                      <td class="px-4 py-3"><input type="number" readonly id="Previsions_Vent" name="Previsions_Vent"
                          value="{{ $journal->Previsions_Vent }}" class="w-full">
                            </td>

                      <td class="px-4 py-3"><input type="number" id="Realisation_Vent" name="Realisation_Vent"
                          value="{{ $journal->Realisation_Vent }}" class="w-full">
                            </td>

                      <td class="px-4 py-3"><input type="number" readonly id="Previsions_ProductionVendue" name="Previsions_ProductionVendue" 
                        value="{{ $journal->Previsions_ProductionVendue }}"
                              class="w-full">
                            </td>

                      <td class="px-4 py-3"><input type="number" id="Realisation_ProductionVendue"
                              name="Realisation_ProductionVendue" value="{{ $journal->Realisation_ProductionVendue }}"
                              class="w-full">
                            </td>
              </tr>
          </tbody>
      </table>
      <textarea id="description" name="description"
          class="border border-gray-300 mt-5 px-3 py-2 w-3/4 text-center">{{ $journal->description }}</textarea>
          <br>
      <button type="submit"
          class="bg-[#F16B07] text-white p-2 rounded-full hover:bg-[#a14d0c] w-2/4 h-11 mt-5 text-xl ">Modifier</button>
      </form>
  </center>
  
       

        
        
        
    


<script>
    const tooltips = document.querySelectorAll('[data-tooltip-target]');
  
    tooltips.forEach((tooltip) => {
      const target = document.getElementById(tooltip.dataset.tooltipTarget);
      const popperInstance = Popper.createPopper(tooltip, target, {
        placement: tooltip.dataset.tooltipPlacement,
        modifiers: [
          {
            name: 'offset',
            options: {
              offset: [0, 8],
            },
          },
          {
            name: 'preventOverflow',
            options: {
              boundary: document.body,
            },
          },
        ],
      });
  
      function showTooltip() {
        target.classList.add('opacity-100');
        target.classList.remove('invisible');
      }
  
      function hideTooltip() {
        target.classList.remove('opacity-100');
        target.classList.add('invisible');
      }
  
      tooltip.addEventListener('mouseenter', () => {
        showTooltip();
      });
  
      tooltip.addEventListener('focus', () => {
        showTooltip();
      });
  
      tooltip.addEventListener('mouseleave', () => {
        hideTooltip();
      });
  
      tooltip.addEventListener('blur', () => {
        hideTooltip();
      });
    });
  
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