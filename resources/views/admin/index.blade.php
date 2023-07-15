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

    @vite('resources/js/app.js')


</head>

<body class="overflow-x-hidden">
    <div id="app">


        <nav
            class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700 shadow-lg w-screen h-26 fixed top-0 z-10">
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
                            <a href="/admin" class="block py-2 pl-3 pr-4 text-[#F16B07] hover:text-[#ab4c04]  rounded"
                                aria-current="page">Dashboard</a>
                        </li>
                        <div>

                        </div>
                        <div>
                            <!-- Dropdown  -->
                            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                                class="text-black hover:text-[#ab4c04]  font-medium rounded-lg text-lg px-4 py-2.5 text-center inline-flex items-center"
                                type="button">Gérer<svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg></button>
                            <!-- Dropdown menu -->
                            <div id="dropdown"
                                class="absolute top-16   hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownDefaultButton">
                                    <li>
                                        <a href="/admin/users"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">les
                                            utilisateurs</a>
                                    </li>
                                    <li>
                                        <a href="/admin/units"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">les
                                            unités</a>
                                    </li>

                                    <li>
                                        <a href="/admin/produits"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">les
                                            produits</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('familles.index') }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Les
                                            familles</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('activites.index') }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Les
                                            Activites</a>
                                    </li>

                                </ul>
                            </div>
                        </div>


                        <a href="#" class="pr-4 text-gray-900 rounded hover:bg-[#af540e]">
                            <a class="bg-[#F16B07] text-white p-2 pr-4 pl-4 rounded-full hover:bg-[#af540e]"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
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
            <div class="flex w-full justify-between p-4 px-10 items-center mt-20">
                <div class="flex items-center">
                    <h1 class="text-3xl font-bold">{{ now()->format('Y-m-d') }}</h1>
                    <form method="GET" class="flex gap-4 items-center ml-4 justify-start">
                        <input type="date" id="selected_date" name="selected_date" value="{{ $selectedDate }}"
                        
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-orange-500 focus:border-orange-500 block w-full pl-10 p-2.5"
                            > 
                        
                        
                            <button class="bg-[#F16B07] text-white p-2 pr-4 pl-4 rounded-full hover:bg-[#af540e]"
                            type="submit" name="submit" value="selected_date">Filter</button>

                </div>
                <div class="flex gap-4">
                    <button
                        class="bg-[#F16B07] text-white shadow-[0px_4px_16px_rgba(17,17,26,0.1),_0px_8px_24px_rgba(17,17,26,0.1),_0px_16px_56px_rgba(17,17,26,0.1)] p-2 pr-4 pl-4 rounded-full hover:bg-[#af540e]"
                        type="submit" name="cumule" value="cumule">Cumule du mois</button>
                    <button
                        class="bg-[#F16B07] text-white shadow-[0px_4px_16px_rgba(17,17,26,0.1),_0px_8px_24px_rgba(17,17,26,0.1),_0px_16px_56px_rgba(17,17,26,0.1)] p-2 pr-4 pl-4 rounded-full hover:bg-[#af540e]"
                        type="submit" name="cumule_jfm" value="cumule_jfm">Cumule Trimestriel</button>
                </div>
                </form>
            </div>


            <div class="w-full p-2 overflow-hidden rounded-lg shadow-xs pt-5">
                <div class="w-full overflow-x-auto ">
                    <table class="w-full whitespace-no-wrap ">
                        <thead>
                            <tr
                                class="text-xs font-medium tracking-wide text-left text-gray-700 uppercase border-b bg-gray-50">
                                <th class="px-4 py-3 ">Activité</th>
                                <th class="px-4 py-3 ">Unité</th>
                                <th class="px-4 py-3 bg-orange-200">Previsions Production</th>
                                <th class="px-4 py-3 bg-orange-200">Réalisations Production</th>
                                <th class="px-4 py-3 bg-red-400">Taux Production</th>
                                <th class="px-4 py-3 bg-blue-200">Previsions Vente</th>
                                <th class="px-4 py-3 bg-blue-200">Réalisations Vente</th>
                                <th class="px-4 py-3 bg-blue-400">Taux Vente</th>
                                <th class="px-4 py-3 bg-green-200">Previsions Production Vendue</th>
                                <th class="px-4 py-3 bg-green-200">Réalisations Production Vendue</th>
                                <th class="px-4 py-3 bg-green-500">Taux Production Vendue</th>

                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            @if ($activities)
                                @php
                                    $sum1 = 0; // Initialize $sum1 to 0
                                    $sum2 = 0; // Initialize $sum1 to 0
                                @endphp
                                @foreach ($activities as $activity)
                                    <tr>
                                        <td rowspan="{{ count($activity->units) + 1 }}">{{ $activity->name }} </td>
                                    </tr>
                                    @foreach ($activity->units as $unit)
                                           <tr>
                                
                                            <td>
                                                @if (isset($_GET['cumule']) && $_GET['cumule'] === 'cumule')
                                                    <a
                                                        href="{{ url('/admin/show?selected_date=' . $selectedDate . '&unit_id=' . $unit->id .'&activite_id=' . $activity->id . '&cumule=cumule') }}">{{ $unit->name }}</a>
                                                @else
                                                    <a
                                                        href="{{ url('/admin/show?selected_date=' . $selectedDate . '&unit_id=' . $unit->id .'&activite_id=' . $activity->id . '&submit=selected_date') }}">{{ $unit->name }}</a>
                                                @endif

                                            </td>
                                                <td>{{ $journalTotals[$activity->id][$unit->id]['Previsions_Production'] }}</td>
                                                <td>{{ $journalTotals[$activity->id][$unit->id]['Realisation_Production'] }}</td>
                                                <td
                                                    class="py-3{{ $journalTotals[$activity->id][$unit->id]['Previsions_Production'] > 0 && $journalTotals[$activity->id][$unit->id]['Realisation_Production'] / $journalTotals[$activity->id][$unit->id]['Previsions_Production'] < 0.8 ? ' bg-red-500' : (($journalTotals[$activity->id][$unit->id]['Previsions_Production'] > 0 && $journalTotals[$activity->id][$unit->id]['Realisation_Production'] / $journalTotals[$activity->id][$unit->id]['Previsions_Production']) * 100 >= 100 ? ' bg-green-500' : (($journalTotals[$activity->id][$unit->id]['Previsions_Production'] > 0 && $journalTotals[$activity->id][$unit->id]['Realisation_Production'] / $journalTotals[$activity->id][$unit->id]['Previsions_Production']) * 100 >= 80 ? ' bg-yellow-500' : ' bg-red-500')) }}">
                                                    {{ $journalTotals[$activity->id][$unit->id]['Realisation_Production'] > 0 ? number_format(($journalTotals[$activity->id][$unit->id]['Realisation_Production'] / $journalTotals[$activity->id][$unit->id]['Previsions_Production']) * 100, 2) : '-' }} %
                                                </td>


                                                <td>{{ $journalTotals[$activity->id][$unit->id]['Previsions_Vent'] }}</td>
                                                <td>{{ $journalTotals[$activity->id][$unit->id]['Realisation_Vent'] }}</td>
                                                <td
                                                    class="py-3{{ $journalTotals[$activity->id][$unit->id]['Previsions_Vent'] > 0 && $journalTotals[$activity->id][$unit->id]['Realisation_Vent'] / $journalTotals[$activity->id][$unit->id]['Previsions_Vent'] < 0.8 ? ' bg-red-500' : (($journalTotals[$activity->id][$unit->id]['Previsions_Vent'] > 0 && $journalTotals[$activity->id][$unit->id]['Realisation_Vent'] / $journalTotals[$activity->id][$unit->id]['Previsions_Vent']) * 100 >= 100 ? ' bg-green-500' : (($journalTotals[$activity->id][$unit->id]['Previsions_Vent'] > 0 && $journalTotals[$activity->id][$unit->id]['Realisation_Vent'] / $journalTotals[$activity->id][$unit->id]['Previsions_Vent']) * 100 >= 80 ? ' bg-yellow-500' : ' bg-red-500')) }}">
                                                    {{ $journalTotals[$activity->id][$unit->id]['Previsions_Vent'] > 0 ? number_format(($journalTotals[$activity->id][$unit->id]['Realisation_Vent'] / $journalTotals[$activity->id][$unit->id]['Previsions_Vent']) * 100, 2) : '-' }} %
                                                </td>

                                                <td>{{ $journalTotals[$activity->id][$unit->id]['Previsions_ProductionVendue'] }}</td>
                                                <td>{{ $journalTotals[$activity->id][$unit->id]['Realisation_ProductionVendue'] }}</td>
                                                <td
                                                    class="py-3{{ $journalTotals[$activity->id][$unit->id]['Previsions_ProductionVendue'] > 0 && $journalTotals[$activity->id][$unit->id]['Realisation_ProductionVendue'] / $journalTotals[$activity->id][$unit->id]['Previsions_ProductionVendue'] < 0.8 ? ' bg-red-500' : (($journalTotals[$activity->id][$unit->id]['Previsions_ProductionVendue'] > 0 && $journalTotals[$activity->id][$unit->id]['Realisation_ProductionVendue'] / $journalTotals[$activity->id][$unit->id]['Previsions_ProductionVendue']) * 100 >= 100 ? ' bg-green-500' : (($journalTotals[$activity->id][$unit->id]['Previsions_ProductionVendue'] > 0 && $journalTotals[$activity->id][$unit->id]['Realisation_ProductionVendue'] / $journalTotals[$activity->id][$unit->id]['Previsions_ProductionVendue']) * 100 >= 80 ? ' bg-yellow-500' : ' bg-red-500')) }}">
                                                    {{ $journalTotals[$activity->id][$unit->id]['Previsions_ProductionVendue'] > 0 ? number_format(($journalTotals[$activity->id][$unit->id]['Realisation_ProductionVendue'] / $journalTotals[$activity->id][$unit->id]['Previsions_ProductionVendue']) * 100, 2) : '-' }} %
                                                </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="bg-amber-100">Total d'Activité</td>
                                        <td class="bg-amber-100"></td>

                                        <td class="bg-amber-100">
                                            {{ $activity->units->sum(function ($unit) use ($journalTotals,$activity) {return $journalTotals[$activity->id][$unit->id]['Previsions_Production'];}) }}
                                        </td>
                                        <td class="bg-amber-100">
                                            {{ $activity->units->sum(function ($unit) use ($journalTotals,$activity) {return $journalTotals[$activity->id][$unit->id]['Realisation_Production'];}) }}
                                        </td>
                                        <td
                                        @php
                                            $previsionSum = $activity->units->sum(function ($unit) use ($journalTotals,$activity) {
                                                return $journalTotals[$activity->id][$unit->id]['Previsions_Production'];
                                            });

                                            $realisationSum = $activity->units->sum(function ($unit) use ($journalTotals,$activity) {
                                                return $journalTotals[$activity->id][$unit->id]['Realisation_Production'];
                                            });

                                            $ratio = $previsionSum != 0 ? ($realisationSum / $previsionSum) * 100 : 0;
                                            $class = '';

                                            if ($ratio >= 100) {
                                                $class = 'bg-green-300';
                                            } elseif ($ratio >= 80 && $ratio < 100) {
                                                $class = 'bg-yellow-300';
                                            } else {
                                                $class = 'bg-red-500';
                                            }
                                        @endphp

                                        <div class="{{ $class }}">
                                            {{ number_format($ratio, 2) }}%
                                        </div>
                                        </td>

                                        <td class="bg-amber-100">
                                            {{ $activity->units->sum(function ($unit) use ($journalTotals,$activity) {return $journalTotals[$activity->id][$unit->id]['Previsions_Vent'];}) }}
                                        </td>
                                        <td class="bg-amber-100">
                                            {{ $activity->units->sum(function ($unit) use ($journalTotals,$activity) {return $journalTotals[$activity->id][$unit->id]['Realisation_Vent'];}) }}
                                        </td>
                                        <td
                                        @php
                                            $previsionSum = $activity->units->sum(function ($unit) use ($journalTotals,$activity) {
                                                return $journalTotals[$activity->id][$unit->id]['Previsions_Vent'];
                                            });

                                            $realisationSum = $activity->units->sum(function ($unit) use ($journalTotals,$activity) {
                                                return $journalTotals[$activity->id][$unit->id]['Realisation_Vent'];
                                            });

                                            $ratio = $previsionSum != 0 ? ($realisationSum / $previsionSum) * 100 : 0;
                                            $class = '';

                                            if ($ratio >= 100) {
                                                $class = 'bg-green-300';
                                            } elseif ($ratio >= 80 && $ratio < 100) {
                                                $class = 'bg-yellow-300';
                                            } else {
                                                $class = 'bg-red-500';
                                            }
                                        @endphp

                                        <div class="{{ $class }}">
                                            {{ number_format($ratio, 2) }}%
                                        </div>
                                        </td>

                                        <td class="bg-amber-100">
                                            {{ $activity->units->sum(function ($unit) use ($journalTotals,$activity) {return $journalTotals[$activity->id][$unit->id]['Previsions_ProductionVendue'];}) }}
                                            @php
                                                $sum2 += $activity->units->sum(function ($unit) use ($journalTotals,$activity) {
                                                    return $journalTotals[$activity->id][$unit->id]['Previsions_ProductionVendue'];
                                                }); // Add the sum for this unit to $sum1
                                            @endphp
                                        </td>
                                        <td class="bg-amber-100">
                                            {{ $activity->units->sum(function ($unit) use ($journalTotals,$activity) {return $journalTotals[$activity->id][$unit->id]['Realisation_ProductionVendue'];}) }}
                                        </td>
                                        @php
                                            $sum1 += $activity->units->sum(function ($unit) use ($journalTotals,$activity) {
                                                return $journalTotals[$activity->id][$unit->id]['Realisation_ProductionVendue'];
                                            }); // Add the sum for this unit to $sum1
                                        @endphp

                                        <td
                                        @php
                                            $previsionSum = $activity->units->sum(function ($unit) use ($journalTotals,$activity) {
                                                return $journalTotals[$activity->id][$unit->id]['Previsions_ProductionVendue'];
                                            });

                                            $realisationSum = $activity->units->sum(function ($unit) use ($journalTotals,$activity) {
                                                return $journalTotals[$activity->id][$unit->id]['Realisation_ProductionVendue'];
                                            });

                                            $ratio = $previsionSum != 0 ? ($realisationSum / $previsionSum) * 100 : 0;
                                            $class = '';

                                            if ($ratio >= 100) {
                                                $class = 'bg-green-300';
                                            } elseif ($ratio >= 80 && $ratio < 100) {
                                                $class = 'bg-yellow-300';
                                            } else {
                                                $class = 'bg-red-500';
                                            }
                                        @endphp

                                        <div class="{{ $class }}">
                                            {{ number_format($ratio, 2) }}%
                                        </div>
                                        </td>



                                    </tr>
                                @endforeach

                            @endif
                        </tbody>
                    </table>


                </div>
                <div
                    class="bg-white shadow-[0px_4px_16px_rgba(17,17,26,0.1),_0px_8px_24px_rgba(17,17,26,0.1),_0px_16px_56px_rgba(17,17,26,0.1)] w-full my-8 p-2 flex justify-between items-center">
                    <h1 class="text-3xl font-bold ">TOTAL GÉNÉRAL</h1>
                    <div class="flex items-center w-[31%] justify-between">
                        <h1 class="text-2xl ">{{ $sum2 }}</h1>
                        <h1 class="text-2xl ">{{ $sum1 }}</h1>
                        <h1
                            class=" text-2xl w-max p-2 rounded-2xl @if ($sum2 != 0) {{ ($sum1 / $sum2) * 100 >= 100 ? 'bg-green-400' : (($sum1 / $sum2) * 100 >= 80 ? 'bg-yellow-400' : 'bg-red-400') }} @endif">
                            {{ $sum2 != 0 ? number_format(($sum1 / $sum2) * 100, 2) : '-' }}% </h1>
                    </div>

                </div>

            </div>
        </center>



    </div>
    <script>
        const tooltips = document.querySelectorAll('[data-tooltip-target]');

        tooltips.forEach((tooltip) => {
            const target = document.getElementById(tooltip.dataset.tooltipTarget);
            const popperInstance = Popper.createPopper(tooltip, target, {
                placement: tooltip.dataset.tooltipPlacement,
                modifiers: [{
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
