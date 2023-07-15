@extends('admin.familles.layout')

@section('create')
<center>
<div class="w-3/4 h-3/4 py-16 mt-14">
    <div class="bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-lg font-medium mb-4">AJOUTER FAMILLE</h2>
      
  <form action="{{ route('familles.store') }}" method="POST">

    @csrf

    <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2" for="name">
        Nom de la famille :
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="Entrez le nom de la famille">
      @error('name')
      <p class="text-red-500">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4 ">
      <label class="block text-gray-700 font-bold mb-2">
        Produits :
      </label>
      <div class="grid grid-cols-4 gap-4 mt-4">
  @foreach($produits as $produit)
      <div class="flex items-center mb-2">
        <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" id="produit-{{ $produit->id }}" name="produits[{{ $produit->id }}][id]" value="{{ $produit->id }}">
        <label for="produit-{{ $produit->id }}" class="ml-2 text-gray-700">
          {{ $produit->name }}
        </label>
      </div>
  @endforeach
</div>

      
    </div>
  
      <button class="bg-[#F16B07] text-white p-2 rounded-full hover:bg-[#a14d0c] w-2/4 text-xl" type="submit">
        Enregistrer
      </button>

  </form>
  </div>
  </div>
</center>

@endsection