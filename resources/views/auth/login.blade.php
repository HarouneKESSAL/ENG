<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>ENG</title>


  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
  <style>
    body {
      font-family: 'Lato', sans-serif;
    }
  </style>
  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <center>
      <div class="mt-24">

        <div class="w-2/5 h-4/5 bg-white  shadow-[0_2.8px_2.2px_rgba(0,_0,_0,_0.034),_0_6.7px_5.3px_rgba(0,_0,_0,_0.048),_0_12.5px_10px_rgba(0,_0,_0,_0.06),_0_22.3px_17.9px_rgba(0,_0,_0,_0.072),_0_41.8px_33.4px_rgba(0,_0,_0,_0.086),_0_100px_80px_rgba(0,_0,_0,_0.12)] rounded-3xl">
          <div class="p-4">

            <img src="{{ asset('images/logo.jpg') }}" alt="#" class="h-24 w-24 rounded-2xl mb-4">

            <h1 class="font-bold text-2xl   text-[#5E5E5E]">welcome to ENG</h1>
            <p class="text-sm pt-16">
              Fill in the login details to access
            </p>
            <!-- input -->
            <div class="mt-4">

              <div class="relative w-3/4 rounded-xl shadow-xl bg-white">
                <label for="email" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-black peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">{{ __('Email Address') }}</label>

                <div class="">
                  <input id="email" type="email" class="px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('email') is-invalid @enderror " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />

                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <!-- password input -->
              <div class="relative w-3/4 rounded-xl shadow-xl mt-8 bg-white">
                <input type="password" id="password" name="password" required autocomplete="current-password" class=" @error('password') is-invalid @enderror block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0  peer" placeholder=" " />
                <label for="password" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-black peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">{{ __('Password') }}</label>
              </div>

              <!-- button -->
              <button type="submit" class="w-2/4 bg-[#F16B07] p-3 rounded-full mt-10 text-xl text-white hover:bg-[#af540e]"> {{ __('Login') }}</button>
            </div>
            
          </div>
        </div>
      </div>

    </center>
  </form>

</body>

</html>