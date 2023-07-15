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
                <div class="pl-28">Visiteur: {{ Auth::user()->name }}</div>



                <div>
                    <ul class="flex justify-center items-center gap-4">
                        <li>
                            <a href="/visiteur" class="block py-2 pl-3 pr-4 text-[#F16B07] hover:text-[#ab4c04]  rounded"
                                aria-current="page">Dashboard</a>
                        </li>
                        <div>

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



        <center>
          <div class="flex w-full justify-between p-4 px-10 items-center mt-20">
            <div class="flex items-center">
                <h1 class="text-3xl font-bold">{{ now()->format('Y-m-d') }}</h1>
                <form method="GET" class="flex gap-4 items-center ml-4 justify-start">
                    <input type="date" id="selected_date" name="selected_date" value="{{ $selectedDate }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-orange-500 focus:border-orange-500 block w-full pl-10 p-2.5">
                    <button class="bg-[#F16B07] text-white p-2 pr-4 pl-4 rounded-full hover:bg-[#af540e]" type="submit" name="submit" value="selected_date">Filter</button>
                
            </div>
            <div class="flex gap-4">
                <button class="bg-[#F16B07] text-white shadow-[0px_4px_16px_rgba(17,17,26,0.1),_0px_8px_24px_rgba(17,17,26,0.1),_0px_16px_56px_rgba(17,17,26,0.1)] p-2 pr-4 pl-4 rounded-full hover:bg-[#af540e]" type="submit" name="cumule" value="cumule">Cumule</button>
                <button class="bg-[#F16B07] text-white shadow-[0px_4px_16px_rgba(17,17,26,0.1),_0px_8px_24px_rgba(17,17,26,0.1),_0px_16px_56px_rgba(17,17,26,0.1)] p-2 pr-4 pl-4 rounded-full hover:bg-[#af540e]" type="submit" name="cumule_jfm" value="cumule_jfm">Cumule Trimestriel</button>
            </div>
          </form>
        </div>
        

            <div class="w-full p-2 overflow-hidden rounded-lg shadow-xs pt-5">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-medium tracking-wide text-left text-gray-700 uppercase border-b bg-gray-50 ">
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
                                        <td rowspan="{{ count($activity->units) + 1 }}">{{ $activity->name }}</td>

                                    </tr>

                                    @foreach ($activity->units as $unit)
                                        <tr>
                                            <td>
                                                @if (isset($_GET['cumule']) && $_GET['cumule'] === 'cumule')
                                                    <a
                                                        href="{{ url('visiteur/show?selected_date=' . $selectedDate . '&unit_id=' . $unit->id . '&cumule=cumule') }}">{{ $unit->name }}</a>
                                                @else
                                                    <a
                                                        href="{{ url('visiteur/show?selected_date=' . $selectedDate . '&unit_id=' . $unit->id . '&submit=selected_date') }}">{{ $unit->name }}</a>
                                                @endif

                                            </td>



                                            <td>{{ $journalTotals[$unit->id]['Previsions_Production'] }}</td>
                                            <td>{{ $journalTotals[$unit->id]['Realisation_Production'] }}</td>
                                            <td
                                                class="py-3{{ $journalTotals[$unit->id]['Previsions_Production'] > 0 && $journalTotals[$unit->id]['Realisation_Production'] / $journalTotals[$unit->id]['Previsions_Production'] < 0.5 ? ' bg-red-400' : (($journalTotals[$unit->id]['Previsions_Production'] > 0 && $journalTotals[$unit->id]['Realisation_Production'] / $journalTotals[$unit->id]['Previsions_Production']) * 100 >= 100 ? ' bg-green-500' : (($journalTotals[$unit->id]['Previsions_Production'] > 0 && $journalTotals[$unit->id]['Realisation_Production'] / $journalTotals[$unit->id]['Previsions_Production']) * 100 >= 80 ? ' bg-yellow-500' : ' bg-red-500')) }}">
                                                {{ $journalTotals[$unit->id]['Realisation_Production'] > 0 ? number_format(($journalTotals[$unit->id]['Realisation_Production'] / $journalTotals[$unit->id]['Previsions_Production']) * 100, 2) : '-' }} %
                                            </td>


                                            <td>{{ $journalTotals[$unit->id]['Previsions_Vent'] }}</td>
                                            <td>{{ $journalTotals[$unit->id]['Realisation_Vent'] }}</td>
                                            <td
                                                class="py-3{{ $journalTotals[$unit->id]['Previsions_Vent'] > 0 && $journalTotals[$unit->id]['Realisation_Vent'] / $journalTotals[$unit->id]['Previsions_Vent'] < 0.5 ? ' bg-red-400' : (($journalTotals[$unit->id]['Previsions_Vent'] > 0 && $journalTotals[$unit->id]['Realisation_Vent'] / $journalTotals[$unit->id]['Previsions_Vent']) * 100 >= 100 ? ' bg-green-500' : (($journalTotals[$unit->id]['Previsions_Vent'] > 0 && $journalTotals[$unit->id]['Realisation_Vent'] / $journalTotals[$unit->id]['Previsions_Vent']) * 100 >= 80 ? ' bg-yellow-500' : ' bg-red-500')) }}">
                                                {{ $journalTotals[$unit->id]['Previsions_Vent'] > 0 ? number_format(($journalTotals[$unit->id]['Realisation_Vent'] / $journalTotals[$unit->id]['Previsions_Vent']) * 100, 2) : '-' }} %
                                            </td>

                                            <td>{{ $journalTotals[$unit->id]['Previsions_ProductionVendue'] }}</td>
                                            <td>{{ $journalTotals[$unit->id]['Realisation_ProductionVendue'] }}</td>
                                            <td
                                                class="py-3{{ $journalTotals[$unit->id]['Previsions_ProductionVendue'] > 0 && $journalTotals[$unit->id]['Realisation_ProductionVendue'] / $journalTotals[$unit->id]['Previsions_ProductionVendue'] < 0.5 ? ' bg-red-400' : (($journalTotals[$unit->id]['Previsions_ProductionVendue'] > 0 && $journalTotals[$unit->id]['Realisation_ProductionVendue'] / $journalTotals[$unit->id]['Previsions_ProductionVendue']) * 100 >= 100 ? ' bg-green-500' : (($journalTotals[$unit->id]['Previsions_ProductionVendue'] > 0 && $journalTotals[$unit->id]['Realisation_ProductionVendue'] / $journalTotals[$unit->id]['Previsions_ProductionVendue']) * 100 >= 80 ? ' bg-yellow-500' : ' bg-red-500')) }}">
                                                {{ $journalTotals[$unit->id]['Previsions_ProductionVendue'] > 0 ? number_format(($journalTotals[$unit->id]['Realisation_ProductionVendue'] / $journalTotals[$unit->id]['Previsions_ProductionVendue']) * 100, 2) : '-' }} %
                                            </td>

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="bg-amber-100">Total</td>
                                        <td class="bg-amber-100"></td>

                                        <td class="bg-amber-100">
                                            {{ $activity->units->sum(function ($unit) use ($journalTotals) {return $journalTotals[$unit->id]['Previsions_Production'];}) }}
                                        </td>
                                        <td class="bg-amber-100">
                                            {{ $activity->units->sum(function ($unit) use ($journalTotals) {return $journalTotals[$unit->id]['Realisation_Production'];}) }}
                                        </td>
                                        <td
                                        @php
                                            $previsionSum = $activity->units->sum(function ($unit) use ($journalTotals) {
                                                return $journalTotals[$unit->id]['Previsions_Production'];
                                            });

                                            $realisationSum = $activity->units->sum(function ($unit) use ($journalTotals) {
                                                return $journalTotals[$unit->id]['Realisation_Production'];
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
                                            {{ $activity->units->sum(function ($unit) use ($journalTotals) {return $journalTotals[$unit->id]['Previsions_Vent'];}) }}
                                        </td>
                                        <td class="bg-amber-100">
                                            {{ $activity->units->sum(function ($unit) use ($journalTotals) {return $journalTotals[$unit->id]['Realisation_Vent'];}) }}
                                        </td>
                                        <td
                                        @php
                                            $previsionSum = $activity->units->sum(function ($unit) use ($journalTotals) {
                                                return $journalTotals[$unit->id]['Previsions_Vent'];
                                            });

                                            $realisationSum = $activity->units->sum(function ($unit) use ($journalTotals) {
                                                return $journalTotals[$unit->id]['Realisation_Vent'];
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
                                            {{ $activity->units->sum(function ($unit) use ($journalTotals) {return $journalTotals[$unit->id]['Previsions_ProductionVendue'];}) }}
                                            @php
                                                $sum1 += $activity->units->sum(function ($unit) use ($journalTotals) {
                                                    return $journalTotals[$unit->id]['Previsions_ProductionVendue'];
                                                }); // Add the sum for this unit to $sum1
                                            @endphp
                                        </td>

                                        <td class="bg-amber-100">
                                            {{ $activity->units->sum(function ($unit) use ($journalTotals) {return $journalTotals[$unit->id]['Realisation_ProductionVendue'];}) }}
                                            @php
                                                $sum2 += $activity->units->sum(function ($unit) use ($journalTotals) {
                                                    return $journalTotals[$unit->id]['Realisation_ProductionVendue'];
                                                }); // Add the sum for this unit to $sum1
                                            @endphp
                                        </td>
                                       

                                        <td
                                        @php
                                            $previsionSum = $activity->units->sum(function ($unit) use ($journalTotals) {
                                                return $journalTotals[$unit->id]['Previsions_ProductionVendue'];
                                            });

                                            $realisationSum = $activity->units->sum(function ($unit) use ($journalTotals) {
                                                return $journalTotals[$unit->id]['Realisation_ProductionVendue'];
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
                    <h1 class="text-3xl font-bold ">TOTAL</h1>
                    <div class="flex items-center w-[31%] justify-between">
                        <h1 class="text-2xl ">{{ $sum1 }}</h1>
                        <h1 class="text-2xl ">{{ $sum2 }}</h1>
                        <h1
                            class=" text-2xl w-max p-2 rounded-2xl @if ($sum1 != 0) {{ ($sum2 / $sum1) * 100 >= 100 ? 'bg-green-400' : (($sum2 / $sum1) * 100 >= 80 ? 'bg-yellow-400' : 'bg-red-400') }} @endif">
                            {{ $sum2 != 0 ? number_format(($sum2 / $sum1) * 100, 2) : '-' }}
                        </h1>
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

          

        
    </script>

</body>

</html>
