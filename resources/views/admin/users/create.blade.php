@extends('admin.units.layout')


@section('create')
<center>
  <div class="mt-24 w-2/5 h-4/5 bg-white  shadow-[0_2.8px_2.2px_rgba(0,_0,_0,_0.034),_0_6.7px_5.3px_rgba(0,_0,_0,_0.048),_0_12.5px_10px_rgba(0,_0,_0,_0.06),_0_22.3px_17.9px_rgba(0,_0,_0,_0.072),_0_41.8px_33.4px_rgba(0,_0,_0,_0.086),_0_100px_80px_rgba(0,_0,_0,_0.12)] rounded-3xl">

    <div class="p-4 space-y-4">

      <h1 class="font-bold text-2xl   text-[#000000]">Create and account</h1>

      {!! Form::open(['action' => '\App\Http\Controllers\UsersController@store', 'method' => 'POST', 'enctype' =>'multipart/form-data' ]) !!}

      @csrf

      <div class="mb-3">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Name') }}</label>
        <div>
          <input id="name" type="text" class="focus:outline-none focus:ring-0 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="namename" required="">
          @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div>

        <div class="mb-3">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Email Address') }}</label>
          <div>
            <input type="email" name="email" id="email" class="focus:outline-none focus:ring-0 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('email') is-invalid @enderror" placeholder="Email@gmail.com" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="mb-3">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Password') }}</label>
          <div>
            <input type="password" name="password" id="password" placeholder="••••••••" class="focus:outline-none focus:ring-0 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('password') is-invalid @enderror" required autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="row mb-3">
          <label for="password-confirm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Confirm Password') }}</label>
          <div class="">
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="focus:outline-none focus:ring-0 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required autocomplete="new-password">
          </div>
        </div>
        <div class="mb-3">


          <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Role') }}</label>
          <div>
            <select id="role" name="role" class="focus:outline-none focus:ring-0 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              @foreach($roles as $role)
              <option value="{{ $role->id }}">{{ $role->name }}</option>
              @endforeach
            </select>
          </div>

          <label for="unit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Unité') }}</label>
          <div>
            <select id="unit" name="unit" class="focus:outline-none focus:ring-0 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              @foreach ($units as $unit)
              <option value="{{ $unit->id }}">{{ $unit->name }}</option>
              @endforeach
            </select>
          </div>

          <br>

          {{Form::submit('Submit',['class' => 'bg-[#F16B07] w-2/4 p-3 rounded-full text-lg text-white hover:bg-[#af540e]'])}}
          {!! Form::close() !!}
        </div>
      </div>
</center>



@endsection