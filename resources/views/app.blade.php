<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- <meta name="twitter:title" content="{{ $page['props']['event']->title }}"> --}}

        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
        <link href="https://use.typekit.net/sto6skh.css" rel="stylesheet">

        @routes

        <script defer src="https://cdn.usefathom.com/script.js" site="NMHGBIOO" included-domains="bee.limo"></script>

        <script defer src="{{ mix('/js/app.js') }}"></script>
    </head>
    <body>

        @inertia

    </body>
</html>
