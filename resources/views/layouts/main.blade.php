<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Default Meta Tags --}}
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {!! xsrfMetaTag() !!}

    {{-- Meta & CSS Stacks --}}
    @stack('meta')
    @stack('css')

    {{-- Dynamic Title --}}
    <title>@yield('title')</title>
</head>

<body>
{{-- Body Content --}}
@yield('body')

{{-- Setup preload script --}}
<script>
    if (!window.PHP) window.PHP = {};
    window.PHP.currentLanguage = "{{ i18n()->getAppliedLang() }}";
</script>

{{-- Main Script --}}
<script src="{{ assets('bundles/main.bundle.js') }}"></script>

{{-- Script Stacks --}}
@stack('js')
</body>

</html>
