<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  data-bs-theme='dark'>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </head>
    <body>
        <div class="container">
            <div class="py-4">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>