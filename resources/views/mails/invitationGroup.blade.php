<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Nueva Invitacion grupo</title>
</head>
<body>
    <p>Hola! Has sido invitado a unirte al grupo </p>

    <p>Si deseas unirte ve a la siguiente url para registrarte en nuestra plataforma y onfirmar tu invitación:</p>
    <ul>
        <li>
            <a class="text-primary" href="href="{{ url('registro/'. $confirmation_code) }}"">registrate</a>
        </li>
    </ul>
</body>
</html>