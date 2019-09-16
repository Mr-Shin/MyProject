<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>My Project</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://kit.fontawesome.com/82c393b6f6.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')

</head>
<body>
<div id="app">
    @include('includes.navbar')
    <main>
        <div class="container col-sm-8">
            @include('includes.flash-messages')

            <div class="row">
                <div class="col-4">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="{{route('posts')}}">Posts</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('notifications')}}">Notifications</a>
                        </li>
                    </ul>
                </div>
                <div class="col-8">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
</div>
<div style="clear: both"></div>
<div id="footer" class="text-center border-top">
    &copy;MyProject
</div>
@yield('scripts')
<script>
    $(document).ready(function() {
        $("div.alert").delay(2000).fadeOut(700);
    });
</script>
@yield('readyscript')

</body>
</html>

@section('content')

@endsection