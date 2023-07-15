@extends('controle-de-gestion.layout')

@section('create')
    <center>

        @foreach ($units as $unit)
            <input type="hidden" name="unit_id[]" value="{{ $unit->id }}">
        @endforeach

        @foreach ($activites as $activite)
        <input type="hidden" name="activite_id[]" value="{{ $activite->id }}">
        @endforeach

        <div class="screen:container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">

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

                            <form action="{{ route('controle-de-gestion.store') }}" method="POST">
                                @csrf

                                <select name="unit_id[]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-max p-3"
                                    hidden>
                                    <option value="{{ $unit->id }}" selected class="hidden">{{ $unit->id }}</option>
                                </select>

                                <select name="activite_id[]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-max p-3"
                                    hidden>
                                    <option value="{{ $activite->id }}" selected class="hidden">{{ $activite->id }}</option>
                                </select>
                                <div class="flex justify-center  gap-10  px-10 items-center mt-10"> 
                                    <div class="flex flex-col"> 
                                        <h1 class="text-3xl font-bold">
                                            {{ now()->format('Y-m-d') }}
                                        </h1>
                                    </div>
                                <div class="flex flex-col">
                                    
                                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-orange-500 focus:border-orange-500 block w-full pl-10 p-2.5"
                                        type="date" name="date" id="date" placeholder="<?= Date('j-n-Y') ?>"
                                        value="{{ old('date') }}">
                                    @error('date')
                                        <div class="text-red-500 mt-2 text-sm">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                </div>
                                <center>
                                    <div class="print:w-[100vw] relative overflow-x-auto pt-20 px-4">
                                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                            <thead
                                                class="text-xs text-gray-700 uppercase bg-red-50 dark:bg-gray-700 dark:text-gray-400">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">
                                                        Nom Produit
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Previsions Production
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Realisation Production
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Previsions Vent
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Realisation Vent
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Previsions Production Vendue
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Realisation Production Vendue
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                             
                                                @foreach ($unit->activites as $activite)
                                                    @foreach ($activite->familles as $famille)
                                                        @foreach ($famille->produits as $produit)
                                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                               
                                                                <input type="hidden" name="produit_id[]"
                                                                    value="{{ $produit->id }}">
                                                                <td class="px-6 py-4">{{ $produit->name }}</td>
                                                                <td class="px-6 py-4">
                                                                    @foreach ($unit->previsions as $prevision)
                                                                    @if ($produit->id === $prevision->produit_id && date('m', strtotime($prevision->date)) == date('m'))
                                                                   
                                                                     {{ number_format(($prevision->Previsions_Production / $prevision->number_of_working_days), 2); }}
                                                                    @endif
                                                                @endforeach
                                                                
                                                                </td>
                                                                <td class="px-6 py-4">
                                                                    <input type="number" name="Realisation_Production[]"
                                                                        class="w-full bg-transparent border-none @error('Realisation_Production.*') border-red-500 @enderror"
                                                                        placeholder="Realisation Production"
                                                                        value="{{ old('Realisation_Production.' . $loop->index) }}">
                                                                    @error('Realisation_Production.*')
                                                                        <span
                                                                            class="text-sm text-red-500">{{ $message }}</span>
                                                                    @enderror
                                                                </td>
                                                                <td class="px-6 py-4">
                                                                    @foreach ($unit->previsions as $prevision)
                                                                    @if ($produit->id === $prevision->produit_id && date('m', strtotime($prevision->date)) == date('m'))
                                                                    {{number_format(($prevision->Previsions_Vent / $prevision->number_of_working_days), 2);  }}
                                                                    @endif
                                                                @endforeach
                                                                </td>
                                                                <td class="px-6 py-4">
                                                                    <input type="number" name="Realisation_Vent[]"
                                                                        class="w-full bg-transparent border-none @error('Realisation_Vent.*') border-red-500 @enderror"
                                                                        placeholder="Realisation Vente"
                                                                        value="{{ old('Realisation_Vent.' . $loop->index) }}">
                                                                    @error('Realisation_Vent.*')
                                                                        <span
                                                                            class="text-sm text-red-500">{{ $message }}</span>
                                                                    @enderror
                                                                </td>
                                                                <td class="px-6 py-4">
                                                                    @foreach ($unit->previsions as $prevision)
                                                                    @if ($produit->id === $prevision->produit_id && date('m', strtotime($prevision->date)) == date('m'))
                                                                    {{ round($prevision->Previsions_ProductionVendue / $prevision->number_of_working_days); }}
                                                                    @endif
                                                                @endforeach
                                                                
                                                                </td>
                                                                <td class="px-6 py-4">
                                                                    <input type="number"
                                                                        name="Realisation_ProductionVendue[]"
                                                                        class="w-full bg-transparent border-none @error('Realisation_ProductionVendue.*') border-red-500 @enderror"
                                                                        placeholder="Realisation Production Vendue "
                                                                        value="{{ old('Realisation_ProductionVendue.' . $loop->index) }}">
                                                                    @error('Realisation_ProductionVendue.*')
                                                                        <span
                                                                            class="text-sm text-red-500">{{ $message }}</span>
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @endforeach
                                                    @endforeach
                                                  
                                                {{-- @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </center>
                                 <div class="flex  flex-col  justify-center items-center   ">
                                     <div class="flex  items-center p-7">
                                         <label class=" font-bold text-2xl text-gray-700" for="description">Observation</label>
                                     </div> 
                                     <div class="flex  items-center pb-10 w-2/4">
                                         <textarea type="text" name="description"
                                             class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-orange-500 focus:border-orange-500 block w-full pl-10 p-2.5"
                                             placeholder="Observation">
                                        </textarea>
                                         @error('description')
                                         <div class="text-red-500 mt-2 text-sm">
                                             {{ $message }}
                                         </div>
                                         @enderror
                                     </div>
                                 
                                 </div>
                                <div class="flex justify-center items-center gap-6 ">
                                    <button type="submit" onclick="submitForm()" id="submit-all"
                                        class="bg-[#F16B07] rounded-xl w-2/4 h-11 text-lg text-white hover:bg-[#a44a06]"
                                        onclick="return confirm('Are you sure you want to submit the form?')">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </center>
@endsection
