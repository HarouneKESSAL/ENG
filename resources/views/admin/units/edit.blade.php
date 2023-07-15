@extends('admin.units.layout')

@section('edit')
<center>
  <div class="w-3/4 h-3/4 py-16 mt-24">
    <div class="bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-lg font-medium mb-4">MODIFIER L'UNITÉ</h2>
      <form action="{{ route('admin.units.update', $unit->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="name" class="block text-gray-700 font-bold mb-2">Nom de l'unité :</label>
          <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') is-invalid @enderror" id="name" name="name" value="{{ $unit->name }}">
          @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="code_unit" class="block text-gray-700 font-bold mb-2">Code de l'unité :</label>
          <input type="text" class=" shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline form-control @error('code_unit') is-invalid @enderror" id="code_unit" name="code_unit" value="{{ $unit->code_unit }}">
          @error('code_unit')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group mt-10">
          <label for="activites">Activités :</label>

          <div class="grid grid-cols-2 gap-4 mt-10">
            @foreach ($activites as $activite)
            <div class="flex items-center">
              <input type="checkbox" id="activite_{{ $activite->id }}" class="form-checkbox h-5 w-5 text-gray-600" name="activites[]" value="{{ $activite->id }}" {{ $unit->activites->contains($activite->id) ? 'checked' : '' }}>
              <label for="activite_{{ $activite->id }}" class="ml-2 text-gray-700 text-lg">{{ $activite->name }} </label>
            </div>
            @endforeach
          </div>
<br>
          <button type="submit" class="bg-[#F16B07] text-white p-2 rounded-full hover:bg-[#a14d0c] w-2/4 text-xl">Enregistrer les modifications</button>
      </form>
      <button type="button" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-700 w-2/4 text-xl mt-4" onclick="event.preventDefault(); if(confirm('Voulez-vous vraiment supprimer cette unité?')) { document.getElementById('delete-form').submit(); }">Supprimer l'unité</button>

      <form id="delete-form" action="{{ route('admin.units.destroy', $unit->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
      </form>

    </div>
  </div>
</center>
@endsection