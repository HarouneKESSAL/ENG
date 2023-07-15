@extends('admin.activites.layout')

@section('content')
<center>
  <div class="w-3/4 h-3/4 py-16 mt-24">
    <div class="bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-lg font-medium mb-4">AJOUTER ACTIVITE</h2>
      <form action="{{ route('activites.store') }}" method="POST">
        @csrf
        <div class="mb-5">
          <label for="name" class="block text-gray-700 font-bold mb-2">Nom de l'activité</label>
          <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
          <p id="error-name" class="text-red-500 text-xs italic hidden">Ce nom existe déjà.</p>
          @if ($errors->has('name'))
          <p class="text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
          @endif
        </div>
        <label for="familles" class="mt-5">Familles associées</label>
        <div class="grid grid-cols-2 gap-4 mt-4">
          @foreach($familles as $famille)
          <div class="flex items-center mb-2">
            <input type="checkbox" name="familles[]" value="{{ $famille->id }} " class="form-checkbox h-5 w-5 text-gray-600">
            <label class="ml-2 text-gray-700">{{ $famille->name }}</label>
          </div>
          @endforeach
        </div>

        @if ($errors->has('familles'))
        <p class="text-red-500 text-xs italic">{{ $errors->first('familles') }}</p>
        @endif
        <button type="submit" class="bg-[#F16B07] text-white p-2 rounded-full hover:bg-[#a14d0c] w-2/4 text-xl">Créer l'activité</button>
      </form>
    </div>
  </div>
</center>

@push('scripts')
<script>
  // Récupère l'élément d'entrée du nom de l'activité
  const inputName = document.querySelector('#name');

  // Récupère le message d'erreur du nom de l'activité
  const errorName = document.querySelector('#error-name');

  // Ajoute un écouteur d'événements à l'élément d'entrée
  inputName.addEventListener('blur', () => {
    // Vérifie si le nom existe déjà dans la base de données
    axios.get(`/activites/check-name/${inputName.value}`)
      .then(response => {
        // Si le nom existe déjà, affiche un message d'erreur
        if (response.data.exists) {
          errorName.classList.remove('hidden');
        } else {
          errorName.classList.add('hidden');
        }
      });
  });
</script>
@endpush
@endsection