<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--Style-->
    <link rel="stylesheet" href="{{ asset('js/libs/animate/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('js/libs/font-awesome-4.6.3/css/font-awesome.min.css') }}">
    <!--Bootstrap-->
    <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"-->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!--плагин owl carousel-->
    <link rel="stylesheet" href="{{ asset('assets/css/libs/owl.carousel.css') }}">
    <!--плагин air date-->
    <link rel="stylesheet" href="{{ asset('js/libs/air-datepicker/dist/css/datepicker.min.css') }}" type="text/css">
    <!--плагин magic suggest-->
    <link rel="stylesheet" href="{{ asset('js/libs/magicsuggest/magicsuggest-min.css') }}" type="text/css">

    <!--мои стили-->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>
    <div id="app">

        <div class="toast-container">
            <div id="toastMessage" class="toast-message">
                <p>Данные сохранены</p>
            </div>

        </div>

        @include('layouts/header')

        <div class="content-container">
            @yield('content')
        </div>

        @include('layouts/footer')
    </div>

    <!-- Scripts -->
    <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script-->
    <script src="{{ asset('js/libs/jquery-1.11.min.js') }}"></script>
    <script src="{{ asset('js/libs/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/libs/air-datepicker/dist/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('js/libs/magicsuggest/magicsuggest-min.js') }}"></script>

    <!--script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script-->
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script-->
    <script src="{{ asset('js/libs/popper.min.js') }}"></script>
    <script src="{{ asset('js/libs/bootstrap.min.js') }}"></script>


    <!--script src=" asset('js/script.js') "></script-->

    @yield('script')
</body>
</html>
