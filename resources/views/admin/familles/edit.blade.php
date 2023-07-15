@extends('admin.familles.layout')

@section('content')
<center>
<div class="w-3/4 h-3/4 py-16 mt-24">
    <div class="bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-lg font-medium mb-4">MODIFIER FAMIILE</h2>

<div class="relative overflow-x-auto mt-7 mb-7">
  <form action="{{ route('familles.update', $famille->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2" for="name">
        Nom de la famille :
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="Entrez le nom de la famille" value="{{ $famille->name }}">
      @error('name')
      <p class="text-red-500">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
  <label class="block text-gray-700 font-bold mb-2">
    Produits :
  </label>
  <div class="grid grid-cols-4 gap-4">
    @foreach($produits as $produit)
    <div class="flex items-center">
      <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" id="produit-{{ $produit->id }}" name="produits[{{ $produit->id }}][id]" value="{{ $produit->id }}" {{ $famille->produits->contains($produit->id) ? 'checked' : '' }}>
      <label for="produit-{{ $produit->id }}" class="ml-2 text-gray-700">
        {{ $produit->name }}
      </label>
    </div>
    @endforeach
  </div>
</div>


    <div class="mt-8">
      <button class="bg-[#F16B07] text-white p-2 rounded-full hover:bg-[#a14d0c] w-2/4 text-xl" type="submit">
        Enregistrer
      </button>
    </div>
  </form>

  <form action="{{ route('familles.destroy', $famille->id) }}" method="POST">
  @csrf
  @method('DELETE')
  <button class="bg-red-500 text-white p-2 rounded-full mt-4 hover:bg-red-700 w-2/4 text-xl" type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette famille ?')">
    Supprimer
  </button>
</form>
</div>
</center>

@endsection