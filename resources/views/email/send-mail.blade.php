<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('app.name', 'VENTONIC') }}</title>
    </head>
    <body>
        {{ $msg }}
        @if (isset($url))
            <a href="{{ $url }}">$urlText</a>
        @endif
    </body>
</html>
