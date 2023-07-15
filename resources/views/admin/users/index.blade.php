@extends('admin.users.layout')
@section('content')

<center>
  <div class="flex-col justify-center items-center w-3/4 mt-28">
    <h1 class="mb-4 pt-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-5xl">GERER <span class="text-[#F16B07]">LES UTILISATEURS</span></h1>
    <a href="{{ route('admin.users.create') }}">
      <button class="bg-[#F16B07] p-2 px-10 text-lg text-white font-normal rounded-lg hover:bg-[#a9500c]">Ajouter un utilisateur</button>
    </a>
  </div>

  <div class="relative overflow-x-auto mt-7 mb-7">
    <table class="w-3/4 text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
         
          <th scope="col" class="px-6 py-3">
            Name
          </th>
          <th scope="col" class="px-6 py-3">
            Role
          </th>
          <th scope="col" class="px-6 py-3">
            Unité
          </th>
          <th scope="col" class="px-6 py-3">
            Action
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
           
            <td class="px-6 py-4">
                {{ $user->name }}
            </td>
            <td>
                @foreach($user->roles as $role)
                {{ $role->name }}<br>
                @endforeach
            </td>
            <td>
                @foreach($user->units as $unit)
                {{ $unit->name }}<br>
                @endforeach
            </td>
            <td class="px-6 py-4">
                <div>
                    <div>
                        <a href="{{ route('admin.users.edit', $user->id) }}">
                            <button class="bg-red-500 p-2 text-sm text-white font-normal rounded-lg hover:bg-red-800">Modifier</button>
                        </a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</center>

@endsection
