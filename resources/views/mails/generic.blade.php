<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>{{ ($module) ? $module . ' | ' : '' }}{{ $fromUserName }}</title>
    <style>
        .btn {
            display: inline-block;
            font-weight: 400;
            color: #626262;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 0 solid transparent;
            padding: 0.9rem 2rem;
            font-size: 1rem;
            line-height: 1;
            border-radius: 0.4285rem;
            -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .btn-primary {
            border-color: #4839EB !important;
            background-color: #0087FF !important;
            color: #FFFFFF;
        }
        button, [type="button"], [type="reset"], [type="submit"] {
            -webkit-appearance: button;
        }
        button, select {
    text-transform: none;
}
button, input {
    overflow: visible;
}
    </style>
</head>
<body>
<p>{{ $subject }}</p>

<p>{!! $msg !!}</p>
@if (isset($url))
    <a class="btn btn-primary" href="{{ $url }}">{!! $urlText !!}</a>
@endif

    <p>Saludos, {{ $fromUserName }}.</p>
</body>
</html>
