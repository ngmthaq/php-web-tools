<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Default Meta Tags --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Meta & CSS Stacks --}}
    @stack('meta')
    @stack('css')

    {{-- Dynamic Title --}}
    <title>@yield('title')</title>
</head>

<body>
    {{-- Body Content --}}
    @yield('body')

    {{-- Main Script --}}
    <script src="{{ assets('bundles/main.bundle.js') }}"></script>

    {{-- Script Stacks --}}
    @stack('js')
</body>

</html>
