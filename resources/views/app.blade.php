<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', "Simpl'Achat") }}</title>

        <link rel="apple-touch-icon" sizes="180x180" href="https://tailwindcss.com/favicons/apple-touch-icon.png?v=3">
        <link rel="icon" type="image/png" sizes="32x32" href="https://tailwindcss.com/favicons/favicon-32x32.png?v=3">
        <link rel="icon" type="image/png" sizes="16x16" href="https://tailwindcss.com/favicons/favicon-16x16.png?v=3">
        <link rel="shortcut icon" href="https://tailwindcss.com/favicons/favicon.ico?v=3">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
