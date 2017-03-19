<!--
        _      __
       (_)____/ /_  ____ ___  ___________________
      / / ___/ __ \/ __ `__ \/ ___/ ___/ ___/ __ \
     / (__  ) / / / / / / / / /  / /  (__  ) / / /
  __/ /____/_/ /_/_/ /_/ /_/_/  /_/  /____/_/ /_/
/___/

-->
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>

    @yield('meta')

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Directory') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        @include('partials.nav')

        <div class="wrap">
            @include('flash::message')

            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/all.js') }}"></script>

    @yield('js')
</body>
</html>
