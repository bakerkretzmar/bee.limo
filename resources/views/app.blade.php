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

        <script defer src="{{ mix('/js/app.js') }}"></script>

        @if(app()->isProduction())
            <script>
                (function(f, a, t, h, o, m){
                    a[h]=a[h]||function(){
                        (a[h].q=a[h].q||[]).push(arguments)
                    };
                    o=f.createElement('script'),
                    m=f.getElementsByTagName('script')[0];
                    o.async=1; o.src=t; o.id='fathom-script';
                    m.parentNode.insertBefore(o,m)
                })(document, window, '//fathom.bakerkretzmar.ca/tracker.js', 'fathom');
                fathom('set', 'siteId', 'LXYSE');
            </script>
        @endif
    </head>
    <body>

        @inertia

    </body>
</html>
