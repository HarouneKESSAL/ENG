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
        @php
            $rowCount = 0;
        @endphp

        <nav
            class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700 shadow-lg w-screen h-26 fixed top-0 z-10">
            <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
                <div>
                    <a href="/visiteur" class="flex items-center gap-2 ">
                        <img src="{{ asset('images/logo.jpg') }}" alt="#" class="h-10 w-10 rounded-full ">
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">ENG</span>
                    </a>
                </div>
                <div class="pl-28">visiteur: {{ Auth::user()->name }}</div>



              
                      


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

            <div class="w-screen p-2 overflow-hidden rounded-lg shadow-xs pt-5 mt-20">
                @if (request()->has('submit'))
                    <h1 class="text-4xl"> Entrées de Journal pour : {{ $selectedDate }}</h1>
                @endif

                @if (request()->has('cumule'))
                    <h1 class="text-4xl text-[#F16B07]">CUMULE</h1>
                @endif



                @if (request()->has('cumule'))
                    @foreach ($activities as $activity)
                        @foreach ($activity->units as $unit)
                            @if ($unit->id === $unit_id)
                                <h1 class="text-4xl mt-20">Entrées pour l'unité : {{ $unit->name }}
                                    {{ $unit->id }}</h1>
                            @break
                        @endif
                    @endforeach
                @endforeach
            @endif



            <br>
            <div class="w-full p-2 overflow-hidden rounded-lg shadow-xs pt-5 pr-8">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-medium tracking-wide text-left text-gray-700 uppercase border-b bg-gray-50 ">
                                @if (request()->has('submit'))
                                    <th class="px-4 py-3 bg-gray-300 ">Produit</th>
                                @endif
                                @if (request()->has('cumule'))
                                    <th class="px-4 py-3 bg-gray-300 w-1/12">Date</th>
                                @endif
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
                            @php
                                $descriptions = [];
                            @endphp

                            @foreach ($units as $unit)
                                @foreach ($unit->journals as $journal)
                                    @if ($journal->date === $selectedDate || $unit->id === $unit_id)
                                        @php
                                            $description = $journal->description;
                                            if (!in_array($description, $descriptions)) {
                                                array_push($descriptions, $description);
                                            } else {
                                                $description = '';
                                            }
                                        @endphp


                                        <tr>
                                            @if (request()->has('submit'))
                                                @foreach ($unit->activites as $activite)
                                                    @foreach ($activite->familles as $famille)
                                                        @foreach ($famille->produits as $produit)
                                                            @if ($journal->produit_id === $produit->id)
                                                                <td>{{ $produit->name }}</td>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                                <td>{{ $journal->Previsions_Production }}</td>
                                                <td>{{ $journal->Realisation_Production }}</td>
                                                <td>{{ $journal->Previsions_Production != 0 ? round(($journal->Realisation_Production / $journal->Previsions_Production) * 100, 2) : 'N/A' }}%
                                                </td>
                                                <td>{{ $journal->Previsions_Vent }}</td>
                                                <td>{{ $journal->Realisation_Vent }}</td>
                                                <td>{{ $journal->Previsions_Vent != 0 ? round(($journal->Realisation_Vent / $journal->Previsions_Vent) * 100, 2) : 'N/A' }}%
                                                </td>
                                                <td>{{ $journal->Previsions_ProductionVendue }}</td>
                                                <td>{{ $journal->Realisation_ProductionVendue }}</td>
                                                <td>{{ $journal->Previsions_ProductionVendue != 0 ? round(($journal->Realisation_ProductionVendue / $journal->Previsions_ProductionVendue) * 100, 2) : 'N/A' }}%
                                                </td>
                                            @endif

                                        </tr>
                                    @endif
                                @endforeach
                                @if (request()->has('cumule'))
                                    @foreach ($journalTotals as $date => $totals)
                                        @php
                                            $rowCount++;
                                        @endphp
                                        <tr @if ($rowCount === count($journalTotals)) class="bg-gray-200" @endif>

                                            <td>{{ $date }}</td>

                                            <td>{{ $totals['Previsions_Production'] }}</td>
                                            <td>{{ $totals['Realisation_Production'] }}</td>
                                            <td>{{ $totals['Previsions_Production'] != 0 ? round(($totals['Realisation_Production'] / $totals['Previsions_Production']) * 100, 2) : 'N/A' }}%
                                            </td>


                                            <td>{{ $totals['Previsions_Vent'] }}</td>
                                            <td>{{ $totals['Realisation_Vent'] }}</td>
                                            <td>{{ $totals['Previsions_Vent'] != 0 ? round(($totals['Realisation_Vent'] / $totals['Previsions_Vent']) * 100, 2) : 'N/A' }}%
                                            </td>


                                            <td>{{ $totals['Previsions_ProductionVendue'] }}</td>
                                            <td>{{ $totals['Realisation_ProductionVendue'] }}</td>
                                            <td>{{ $totals['Previsions_ProductionVendue'] != 0 ? round(($totals['Realisation_ProductionVendue'] / $totals['Previsions_ProductionVendue']) * 100, 2) : 'N/A' }}%
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>

            @if (!empty($descriptions))
                <div class="my-4">
                    <h4 class="text-3xl font-medium pb-2">Descriptions:</h4>
                    <ul class="border w-max p-4 list-none  ">
                        @foreach ($descriptions as $description)
                            <li class="text-xl">{{ $description }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (request()->has('submit'))
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-white rounded-lg shadow-lg p-4">
                        <canvas id="lineChart" width="400" height="400"></canvas>
                    </div>
                    <div class="bg-white rounded-lg shadow-lg p-4">
                        <canvas id="pieChart" width="400" height="400"></canvas>
                    </div>
                    <div class="bg-white rounded-lg shadow-lg p-4">
                        <canvas id="barChart" width="400" height="400"></canvas>
                    </div>

                </div>
            @endif

            @if (request()->has('cumule'))
                <div class="grid grid-cols-3 gap-4 mt-10 pr-8">
                    <div class="bg-white rounded-lg  p-4 col-span-2 h-96 shadow-[0px_-3px_20px_10px_#00000024]">
                        <canvas id="lineChart2" height="400" class="w-full"></canvas>
                    </div>
                    <div class="bg-white rounded-lg  p-4 h-96 shadow-[0px_-3px_20px_10px_#00000024]">
                        <canvas id="pieChart2" height="400" class="w-max"></canvas>
                    </div>
                    <div class=" w-screen pr-12">
                        <div class="bg-white rounded-lg shadow-2xl p-8 h96 mb-10 w-full">
                            <canvas id="barChart2" height="400" class="w-full"></canvas>
                        </div>
                    </div>
            @endif


    </center>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@1.0.0"></script>
    @if (request()->has('cumule'))
        @php
            $labels = [];
            $production = [];
            $vente = [];
            $vendue = [];
            foreach ($journalTotals as $date => $totals) {
                $labels[] = $date;
                $production[] = $totals['Realisation_Production'];
                $vente[] = $totals['Realisation_Vent'];
                $vendue[] = ($totals['Realisation_ProductionVendue'] / 1000000) * 100; // calculate percentage of Realisation_ProductionVendue over 1000
            }
        @endphp
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('lineChart2').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: 'Production',
                        data: {!! json_encode($production) !!},
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderWidth: 1
                    }, {
                        label: 'Vente',
                        data: {!! json_encode($vente) !!},
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 1
                    }, 
                    // {
                    //     label: 'Production vendue',
                    //     data: {!! json_encode($vendue) !!},
                    //     borderColor: 'rgba(255, 206, 86, 1)',
                    //     backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    //     borderWidth: 1
                    // }
                ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            var ctx = document.getElementById('pieChart2').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Production', 
                    'Vente', 
                    // 'Production vendue'
                ],
                    datasets: [{
                        label: 'Realisations',
                        data: [{!! $production[count($production) - 1] !!}, {!! $vente[count($vente) - 1] !!},
                        //  {!! $vendue[count($vendue) - 1] !!}
                        ]
                         ,
                        backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)'
                        ],
                        borderColor: ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        datalabels: {
                            display: true,
                            color: 'white'
                        }
                    }
                }
            });
            var ctx = document.getElementById('barChart2').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: 'Production',
                        data: {!! json_encode($production) !!},
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255,99,132,1)',
                        borderWidth: 1
                    }, {
                        label: 'Vente',
                        data: {!! json_encode($vente) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    //  {
                    //     label: 'Production vendue',
                    //     data: {!! json_encode($vendue) !!},
                    //     backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    //     borderColor: 'rgba(255, 206, 86, 1)',
                    //     borderWidth: 1
                    // }
                ]
                },
                options: {
                    plugins: {
                        datalabels: {
                            display: true,
                            color: 'white'
                        }
                    }
                }
            });
        </script>
    @endif

    @php
        $labels = [];
        $production = [];
        $vente = [];
        $vendue = [];
        foreach ($units as $unit) {
            foreach ($unit->journals as $journal) {
                if ($journal->date === $selectedDate || $unit->id === $unit_id) {
                    $description = $journal->description;
                    if (!in_array($description, $descriptions)) {
                        array_push($descriptions, $description);
                    } else {
                        $description = '';
                    }
                    $labels[] = $journal->date;
                    $production[] = $journal->Realisation_Production;
                    $vente[] = $journal->Realisation_Vent;
                    // $vendue[] =( $journal->Realisation_ProductionVendue);
                }
            }
        }
    @endphp

    <script>
        const labels = <?php echo json_encode($labels); ?>;
        const production = <?php echo json_encode($production); ?>;
        const vente = <?php echo json_encode($vente); ?>;
        const vendue = <?php echo json_encode($vendue); ?>;

        var ctxLine = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Production',
                    data: production,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }, {
                    label: 'Vente',
                    data: vente,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }, 
                // {
                //     label: 'Vendue',
                //     data: vendue,
                //     backgroundColor: 'rgba(255, 206, 86, 0.2)',
                //     borderColor: 'rgba(255, 206, 86, 1)',
                //     borderWidth: 1
                // }
            ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctxPie = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Production', 'Vente',
                //  'Vendue'
                ],
                datasets: [{
                    label: 'Total',
                    data: [
                        production.reduce((a, b) => a + b, 0),
                        vente.reduce((a, b) => a + b, 0),
                        vendue.reduce((a, b) => a + b, 0)
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54  , 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        color: '#fff',
                        anchor: 'end',
                        align: 'start',
                        offset: 10,
                        borderWidth: 2,
                        borderColor: '#fff',
                        borderRadius: 25,
                        backgroundColor: (context) => {
                            return context.dataset.backgroundColor;
                        },
                        font: {
                            weight: 'bold',
                            size: '18'
                        },
                        formatter: (value) => {
                            return value + ' T';
                        }
                    }
                }
            }
        });
        // add chart bar
        var ctxBar = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Production', 'Vente',
                //  'Vendue'
                ],
                datasets: [{
                    label: 'Total',
                    data: [
                        production.reduce((a, b) => a + b, 0),
                        vente.reduce((a, b) => a + b, 0),
                        vendue.reduce((a, b) => a + b, 0)
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54  , 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54  , 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        color: '#fff',
                        anchor: 'end',
                        align: 'start',
                        offset: 10,
                        borderWidth: 2,
                        borderColor: '#fff',
                        borderRadius: 25,
                        backgroundColor: (context) => {
                            return context.dataset.backgroundColor;
                        },
                        font: {
                            weight: 'bold',
                            size: '18'
                        },
                        formatter: (value) => {
                            return value + ' T';
                        }
                    }
                }
            }
        });
    </script>

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
