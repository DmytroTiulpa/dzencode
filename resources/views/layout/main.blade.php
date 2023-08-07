<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--<title>Document</title>--}}
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="Dmytro Tiulpa">

    {{-- UIkit CSS --}}
    {{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.21/dist/css/uikit.min.css"/>--}}
    <link rel="stylesheet" href="{{ asset('css/uikit.min.css') }}"/>

    {{-- UIkit JS --}}
    {{--<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.21/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.21/dist/js/uikit-icons.min.js"></script>--}}
    <script src="{{ asset('js/uikit.min.js') }}"></script>
    <script src="{{ asset('js/uikit-icons.min.js') }}"></script>

    {{-- My styles & scripts --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    {{-- <script src="{{ asset('js/script.js') }}"></script>--}}

    {{-- JQuery / Ajax --}}
    <script src="https://code.jquery.com/jquery-latest.js"></script>

    {{-- DataTables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

</head>
<body>

@yield('content')
@yield('js')

</body>
</html>
