<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link rel="shortcut icon" type="image/png" href="/icon.png" />
        <link href="https://use.typekit.net/sto6skh.css" rel="stylesheet" />
        <x-inertia::head />
        @routes
        @vite('resources/js/app.js')
        @production
            <script src="https://cdn.usefathom.com/script.js" data-site="NMHGBIOO" data-spa="auto" defer></script>
        @endproduction
    </head>
    <body>
        <x-inertia::app />
    </body>
</html>
