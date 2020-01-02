<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/bulma.min.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
          <a class="navbar-item" href="https://bulma.io">
            <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
          </a>
      
          <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
          </a>
        </div>
      
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-end">
                <a class="navbar-item">Home</a>
                @guest
                    @if (Route::has('admin.login'))
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link">Admin</a>
                    
                            <div class="navbar-dropdown">
                                <a class="navbar-item" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
                                <a class="navbar-item" href="{{ route('admin.register') }}">{{ __('Register') }}</a>
                                {{-- <hr class="navbar-divider"> --}}
                            </div>
                        </div>
                    @endif
                @endguest
            </div>
        </div>
    </nav>

    <main class="bd-side-background">
        <div class="bd-main-container container">
            @yield('content')
        </div>
    </main>

    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</body>
</html>
