<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

  <!-- Fonts -->
{{--   <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-light bg-white">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
          @auth
            <li class="nav-item">
              <a class="nav-link" href="{{ route('notes.index') }}">
                {{ __('Notes') }}
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal">{{ __('All files') }}</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Public page') }}</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Settings') }}</a>
            </li>

          @endauth
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->
          @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
            @endif
          @else

            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="
                    event.preventDefault();
                    document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <main class="container">
    @if (session('message'))
      <div class="alert alert-info text-center" role="alert">
        {!! session('message') !!}
      </div>
    @endif

    @yield('content')
  </main>
</body>
</html>
