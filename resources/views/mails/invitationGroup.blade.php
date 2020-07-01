<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Nueva Invitacion grupo</title>
</head>
<body>
<p>Hola! Has sido invitado a unirte al grupo {{$name_group}}</p>

    <p>Si deseas unirte ve a la siguiente url para 
        <a class="text-primary" href="{{ url(env('APP_URL').'/registro') }}">registrarte</a>
        en nuestra plataforma! Una vez registrado encontrarás la invitación en tu perfil.
    </p>

    <p>Saludos, Equipo Ventonic.</p>
</body>
</html>