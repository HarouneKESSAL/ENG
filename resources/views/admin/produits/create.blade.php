@extends('admin.produits.layout')


@section('create')
<center>
  <div class="w-3/4 h-3/4 py-16">
    <div class="bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-lg font-medium mb-4">AJOUTER PRODUIT</h2>
      <form method="POST" action="{{ route('admin.produits.store') }}">
        @csrf
        <div class="mb-4">
          <label for="nameproduit" class="block text-gray-700 font-medium mb-2">Nom du produit:</label>
          <input type="text" name="nameproduit" id="nameproduit" class="border border-[#713406] p-2 w-3/4 rounded-xl" value="{{ old('nameproduit') }}">
          @error('nameproduit')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-4">
          <label for="mesure_id" class="block text-gray-700 font-medium mb-2">Mesure:</label>
          <select name="mesure_id" id="mesure_id" class="border border-[#713406] p-2 w-3/4 rounded-xl">
            @foreach ($mesures as $mesure)
              <option value="{{ $mesure->id }}">{{ $mesure->name }}</option>
            @endforeach
          </select>
          @error('mesure_id')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <button type="submit" class="bg-[#F16B07] text-white p-2 rounded-full hover:bg-[#a14d0c] w-2/4 text-xl">Ajouter</button>
      </form>
      
    </div>
  </div>

</center>

@endsection