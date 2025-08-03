<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title }}</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="font-sans">

    {{ $slot }}

    @if (session('success'))
        <x-alerts.success :message="session('success')"/>
    @endif

    @if ($errors->any())
        <x-alerts.error :errors="$errors->all()" />
    @endif

    @if (session('danger'))
        <x-alerts.error :errors="[session('danger')]" />
    @endif

    <script src="{{ asset('scripts/script.js') }}"></script>
</body>
</html>