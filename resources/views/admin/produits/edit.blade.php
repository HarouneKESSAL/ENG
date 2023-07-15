@extends('admin.produits.layout')


@section('create')
<center>
  <div class="w-3/4 h-3/4 py-16 ">
    <div class="bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-lg font-medium mb-4">Modifier le produit "{{ $produit->name }}"</h2>
      <form method="POST" action="{{ route('admin.produits.update', $produit->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
          <label for="nameproduit" class="block text-gray-700 font-medium mb-2">Nom du produit:</label>
          <input required type="text" name="nameproduit" id="nameproduit" class="border border-[#713406] p-2 w-3/4 rounded-xl" value="{{ old('nameproduit', $produit->name) }}">
          @error('nameproduit')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-4">
  <label for="mesure_id" class="block text-gray-700 font-medium mb-2">Mesure:</label>
  <select required name="mesure_id" id="mesure_id" class="border border-[#713406] p-2 w-3/4 rounded-xl">
    @foreach ($mesures as $mesure)
      <option value="{{ $mesure->id }}" {{ $mesure->id == $produit->mesure_id ? 'selected' : '' }}>{{ $mesure->name }}</option>
    @endforeach
  </select>
  @error('mesure_id')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
  @enderror
</div>


        <div class="flex flex-col gap-4 justify-center items-center">
          <button type="submit" class="bg-[#F16B07] text-white p-2 rounded-full hover:bg-[#a14d0c] w-2/4 text-xl">Modifier</button>
          <button type="button" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-700 w-2/4 text-xl" onclick="event.preventDefault();if(confirm('Êtes-vous sûr de vouloir supprimer ce produit?')){document.getElementById('delete-form').submit();}">Supprimer</button>
        </div>
      </form>
      <form id="delete-form" action="{{ route('admin.produits.destroy', $produit->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
      </form>
    </div>
  </div>


</center>


@endsection