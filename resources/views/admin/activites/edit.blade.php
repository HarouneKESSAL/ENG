@extends('admin.activites.layout')
@section('content')
<center>
  <div class="w-3/4 h-3/4 py-16 mt-24">
    <div class="bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-lg font-medium mb-4">MODIFIER ACTIVITE</h2>
      <form action="{{ route('activites.update', $activite->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-5">
          <label for="name" class="block text-gray-700 font-bold mb-2">Nom de l'activité</label>
          <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $activite->name }}" required>
          @if ($errors->has('name'))
          <p class="text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
          @endif
        </div>
        <label for="familles" class="mt-5">Familles associées</label>
        <div class="grid grid-cols-3 gap-4 my-4">
          @foreach($familles as $famille)
          <div class="flex items-center mb-2">
            <input type="checkbox" name="familles[]" value="{{ $famille->id }} " class="form-checkbox h-5 w-5 text-gray-600" {{ in_array($famille->id, $activite->familles->pluck('id')->toArray()) ? 'checked' : '' }}>
            <label class="ml-2 text-gray-700">{{ $famille->name }}</label>
          </div>
          @endforeach
        </div>

        <div class="mt-8">
          <button type="submit" class="bg-[#F16B07] text-white p-2 rounded-full hover:bg-[#a14d0c] w-2/4 text-xl">Modifier l'activité</button>
        </div>
      </form>
      <div class=" mt-4">
        <form action="{{ route('activites.destroy', $activite->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette activité ?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-700 w-2/4 text-xl">Supprimer l'activité</button>
        </form>
      </div>


    </div>
  </div>
</center>
@endsection