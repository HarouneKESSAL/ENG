@extends('admin.activites.layout')
@section('content')

<center>
  <div class="flex-col justify-center items-center w-3/4 mt-24">
    <h1 class="mb-4 pt-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-5xl">GERER <span class="text-[#F16B07]">LES ACTIVITÉS</span></h1>
    <a href="{{ route('activites.create') }}">
      <button class="bg-[#F16B07] p-2 px-10 text-lg text-white font-normal rounded-lg hover:bg-[#a9500c]">Ajouter un activité</button>
    </a>
  </div>

  <div class="relative overflow-x-auto mt-7 mb-7">

    <table class="w-3/4 text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          {{-- <th scope="col" class="px-6 py-3">
            ID
          </th> --}}
          <th scope="col" class="px-6 py-3">
            Activité
          </th>
          <th scope="col" class="px-6 py-3">
            Famille de cette activité
          </th>
          <th scope="col" class="px-6 py-3">
            Action
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach($activites as $activite)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
          {{-- <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $activite->id }}
          </th> --}}
          <td class="px-6 py-4">
            {{ $activite->name }}
          </td>

          <td class="px-6 py-4">

          <select name="famille_id">
    @foreach($activite->familles as $famille)
        <option value="{{ $famille->id }}" {{ $famille->id == $activite->famille_id ? 'selected' : '' }}>{{ $famille->name }}</option>
    @endforeach
</select>

          </td>

          <td class="px-6 py-4">
          <a href="{{ route('activites.edit', $activite->id) }}" class="bg-red-500 p-2 text-sm text-white font-normal rounded-lg hover:bg-red-800">Modifier</a>

          </td>

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</center>

@endsection