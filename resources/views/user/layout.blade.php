<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Album example for Bootstrap</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lightbox.css') }}" rel="stylesheet">

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">{{ (Route::currentRouteName() == 'user.stall.show') ? $stall->name : 'Cafeteria' }}</h1>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                @yield('content')
            </div>
        </div>

    </main>

    <footer class="text-muted">
        <div class="container">
            <p class="float-right">
                <a href="#">Back to top</a>
            </p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/holder.min.js') }}"></script>
    @yield('script')
</body>

</html>