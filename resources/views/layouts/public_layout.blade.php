<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    <wireui:scripts />
</head>

<body class="bg-gray-100 text-gray-900 min-h-screen flex items-center justify-center">

    {{ $slot }}

    @livewireScripts
</body>
</html>
