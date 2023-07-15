@extends('controle-de-gestion.layout')

@section('create')
    <center>

        @foreach ($units as $unit)
            <input type="hidden" name="unit_id[]" value="{{ $unit->id }}">
        @endforeach

        <div class="container">
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
                          
                        
                           <form action="{{ route('controle-de-gestion.store-previsions') }}" method="POST">
                                @csrf

                                <select name="unit_id[]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-max p-3"
                                    hidden>
                                    <option value="{{ $unit->id }}" selected class="hidden">{{ $unit->id }}</option>
                                </select>
                               
                            <div class="flex justify-between gap-10 p-4 px-10 items-center mt-10"> 
                                
                                <div class="flex "> 
                                    <h1 class="text-3xl font-bold">
                                        {{ now()->format('Y-m-d') }}
                                    </h1>
                                </div>
                                <div class="flex gap-4">
                                    <div class="flex flex-col">
                                    
                                        <label class="mb-1 font-bold text-lg text-gray-400" for="date">Date</label>
                                        <input  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-orange-500 focus:border-orange-500 block w-full pl-10 p-2.5"
                                            type="month" name="date" id="date" placeholder="<?= Date('01-m-Y') ?>"
                                            value="{{ old('date') }}">
                                        @error('date')
                                            <div class="text-red-500 mt-2 text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    

                                    <div class="flex flex-col">
                                        <label class="mb-1 font-bold text-lg text-gray-400" for="number_of_working_days">Nombre de jours ouvrables</label>
                                        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-orange-500 focus:border-orange-500 block w-full pl-10 p-2.5"
                                            type="number" name="number_of_working_days" id="number_of_working_days"
                                            value="{{ old('number_of_working_days') }}">
                                        @error('number_of_working_days')
                                            <div class="text-red-500 mt-2 text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                                <center>
                                    <div class="relative overflow-x-auto pt-20 px-4">
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
                                                        Previsions Vente
                                                    </th>
                                                    
                                                    <th scope="col" class="px-6 py-3">
                                                        Previsions Production Vendue
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
                                                                    <input type="number" name="Previsions_Production[]"
                                                                        class="w-full bg-transparent border-none"
                                                                        placeholder="Previsions Production"
                                                                        value="{{ old('Previsions_Production.' . $loop->index) }}">
                                                                    @error('Previsions_Production.*')
                                                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                                                    @enderror
                                                                </td>
                                                               
                                                                <td class="px-6 py-4">
                                                                    <input type="number" name="Previsions_Vent[]"
                                                                        class="w-full bg-transparent border-none"
                                                                        placeholder="Previsions Vente"
                                                                        value="{{ old('Previsions_Vent.' . $loop->index) }}">
                                                                    @error('Previsions_Vent.*')
                                                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                                                    @enderror
                                                                </td>
                                                               
                                                                <td class="px-6 py-4">
                                                                    <input type="number" name="Previsions_ProductionVendue[]"
                                                                        class="w-full bg-transparent border-none"
                                                                        placeholder="Previsions Production Vendue"
                                                                        value="{{ old('Previsions_ProductionVendue.' . $loop->index) }}">
                                                                    @error('Previsions_ProductionVendue.*')
                                                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @endforeach
                                                    @endforeach
                                                 
                                            </tbody>
                                        </table>
                                    </div>
                                </center>


                                <div class="flex justify-center items-center gap-6 mt-10 mb-10">
                                    <button type="submit" onclick="submitForm()" id="submit-all"
                                        class="bg-[#F16B07] rounded-xl w-2/4 h-11 text-lg text-white hover:bg-[#a44a06]"
                                        onclick="return confirm('Êtes-vous sûr de vouloir soumettre les prévisions ?')">Submit</button>
                                </div>
                            </form>






                        </div>
                    </div>
                </div>
            </div>
        </div>
     
    
    </center>
@endsection
