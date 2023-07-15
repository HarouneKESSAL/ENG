@extends('admin.users.layout')

@section('content')

<center>
<div class="mt-24 mb-10 w-2/5 h-4/5  bg-white  shadow-[0_2.8px_2.2px_rgba(0,_0,_0,_0.034),_0_6.7px_5.3px_rgba(0,_0,_0,_0.048),_0_12.5px_10px_rgba(0,_0,_0,_0.06),_0_22.3px_17.9px_rgba(0,_0,_0,_0.072),_0_41.8px_33.4px_rgba(0,_0,_0,_0.086),_0_100px_80px_rgba(0,_0,_0,_0.12)] rounded-3xl">
<div class="p-4 space-y-4">

<h1 class="font-bold text-2xl   text-[#000000]">Mofier  and account</h1>

  <form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom:</label>
      <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" class="focus:outline-none focus:ring-0 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required autofocus>
    </div>

    <div class="mb-3">
      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse e-mail:</label>
      <input id="email" type="email" name="email" class="focus:outline-none focus:ring-0 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="mb-3">
      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mot de passe:</label>
      <input id="password" type="password" name="password" class="focus:outline-none focus:ring-0 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autocomplete="new-password">
    </div>

    <div class="mb-3">
      <label for="password-confirm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmez le mot de passe:</label>
      <input id="password-confirm" type="password" class="focus:outline-none focus:ring-0 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="password_confirmation" autocomplete="new-password">
    </div>
    <div class="mb-3">
  <label for="unit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unité :</label>
  <select id="unit" name="unit" required class="focus:outline-none focus:ring-0 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    @foreach($units as $unit)
      <option value="{{ $unit->id }}" @if($user->unit_id == $unit->id) selected @endif>{{ $unit->name }}</option>
    @endforeach
  </select>
</div >

    <div class="mb-3">
      <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" >Rôle:</label>
      <select id="role" name="role" class="focus:outline-none focus:ring-0 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        @foreach($roles as $role)
        <option value="{{ $role->id }}" @if($user->roles->contains($role)) selected @endif>{{ $role->name }}</option>
        @endforeach
      </select>
    </div>



    <button type="submit" class="bg-[#F16B07] w-2/4 p-3 rounded-full text-lg text-white hover:bg-[#af540e]">Modifier</button>

  </form>

  <form method="post" action="{{ route('users.destroy', $user->id) }}">
    @csrf
    @method('DELETE')

    <button type="submit" formaction="{{ route('users.destroy', $user->id) }}" class="bg-red-500 w-2/4 p-3 rounded-full text-lg text-white hover:bg-red-700">Supprimer</button>

  </form>



</div>
</div>
</center>
@endsection