@extends('admin.units.layout')

@section('create')
<center>
  <div class="w-3/4 h-3/4 py-16 mt-24">
    <div class="bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-lg font-medium mb-4">AJOUTER UNITE</h2>
      <form method="POST" action="{{ route('units.store') }}">
        @csrf
        <label for="name" class="block text-gray-700 font-bold mb-2">Nom de l'unité :</label>
        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        @error('name')
        <div class="text-red-500">{{ $message }}</div>
        @enderror
        <br>
        <label for="code_unit" class="block mt-5 text-gray-700 font-bold mb-2">code_unit :</label>
        <input type="text" name="code_unit" id="code_unit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        @error('code_unit')
        <div class="text-red-500">{{ $message }}</div>
        @enderror
        <br>
        <div class="mt-5">
          <label for="activites">Activités :</label>
          <div class="grid grid-cols-2 gap-4 mt-10">

            @foreach ($activites as $activite)
            <div class="flex items-center mb-2">
              <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" name="activites[]" value="{{ $activite->id }}" id="activite-{{ $activite->id }}">
              <label for="activite-{{ $activite->id }} " class="ml-2 text-gray-700">{{ $activite->name }}</label>
            </div>
            @endforeach

          </div>

        </div>

        <br>
        <button type="submit" class="bg-[#F16B07] text-white p-2 rounded-full hover:bg-[#a14d0c] w-2/4 text-xl">Créer l'unité</button>
      </form>
    </div>
  </div>
</center>
@endsection