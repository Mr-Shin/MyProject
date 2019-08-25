<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>My Project</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>

        main > .container {

            padding-top: 60px
        }

    </style>
</head>
<body>
<div id="app">
@include('includes.navbar')
    <main>
        <div class="container col-sm-7">
            @include('includes.flash-messages')
            @yield('content')
        </div>
    </main>
</div>

<div id="footer" class="text-center border-top">
    &copy;MyProject
</div>
<script>
    $(document).ready(function() {

        !$("div.alert").delay(2000).fadeOut(700);
    })
</script>
</body>
</html>
