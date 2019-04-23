<!DOCTYPE html>
<html lang="fa">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>صحفه اصلی</title>
    <link href="/css/fontiran.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <script>
        window.csrf = "{{ csrf_token() }}";
        @if (Auth::user())
            window.user = {
            "name": "{{ Auth::user()->name }}",
            "email": "{{ Auth::user()->email }}",
            "id": "{{ Auth::user()->id }}"
        };
        @endif
    </script>

</head>
<body>
<br>
@include('layouts.navbar')
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            @yield('content')
        </div>
        <div class="col-md-3" style="border-right:1px solid #d4d4d4">
            @include('layouts.sidebar')
        </div>
    </div>
</div>

<script src="/js/app.js" ></script>
@yield('scripts')
</body>

</html>
