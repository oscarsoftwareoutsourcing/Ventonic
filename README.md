# Web y panel de Ventonic

##

-   PHP >= 7.3
-   Laravel Framework 6.18.10
-   OpenSSL PHP Extension
-   PDO PHP Extension
-   Mbstring PHP Extension
-   Tokenizer PHP Extension
-   XML PHP Extension
-   Composer
-   IMAP Library for Laravel (https://github.com/Webklex/laravel-imap)

##Instalación del panel

Clonar el repositorio y accede a el

```bash
    git clone url https del repositorio
```

-   Ejecuta el siguiente comando por consola

```bash
    cp .env.example env.
```

-   Modificar el archivo .env en al siguientes li­neas - dejar en blanco estas variables no estan en uso actualmente

```text
APP_DEBUG=              para producuion cambiar a false
APP_ORDER_PAGINATE=     numero de ordenes por pagina
APP_URL_FRONT=          Url donde la interface
APP_TIMEZONE=           Zona horaria
APP_LOCALE=             Idioma por defecto
```

-   Configurar los datos de la base

```text
DB_HOST=                host de base de datos
DB_DATABASE=            nombre de la base de datos
DB_USERNAME=            usuario de la base de datos
DB_PASSWORD=            contraseña de la base de datos

```

-   Si utiliza otro servidor de correo que no sea gmail modifique las siguientes lineas
    con los datos del servidor a utilizar

```text
MAIL_DRIVER=
MAIL_HOST=
MAIL_PORT=
```

-   Si esta usando gmail solo modifica los siguientes datos

```text
MAIL_USERNAME=          nombre de usuario o correo gmail
MAIL_PASSWORD=          contraseña del usuario o del correo gmail
MAIL_FROM_ADDRESS=      correo el cual aparecerá en la cabecera del email
```

-   Para instalar la base de datos ejecutar

```text
    php artisan migrate
```

-   Luego ingresar datos a las tablas basicas

```shell
   php artisan db:seed
```

## IMAP Library for Laravel

-   Para el manejo y gestion de descargas de email y configracion de cuentas de usario se utilizo el siguiente paquete https://github.com/Webklex/laravel-imap

Se debe tener en cuenta las siguientes dependencias

## Installation

1. Install the php-imap library if it isn't already installed:

```shell
   sudo apt-get install php*-imap php*-mbstring php*-mcrypt && sudo apache2ctl graceful
```

You might also want to check `phpinfo()` if the extension is enabled.


## Para la configuracion del chat se debe tener en cuenta

-   ejecutar el comando: composer install
-   ejecutar el comando: npm install
-   ejecutar el comando: npm run dev
-   configurar las variables de entorno del archivo .env:

```text
BROADCAST_DRIVER=pusher

PUSHER_APP_ID=un-id-numerico-de-6-cifras
PUSHER_APP_KEY=una-cadena-de-texto-de-10-o-mas-caracteres
PUSHER_APP_SECRET=una-cadena-de-texto-de-10-o-mas-caracteres
PUSHER_APP_CLUSTER=mt1
PUSHER_APP_TLS=true

WEBSOCKETS_HOST=127.0.0.1(para pruebas en producción debes colocar la ip o dominio del servidor)
WEBSOCKETS_PORT=6001(este puerto debe estar disponible en el servidor de producción
o cualquier otro que quieras especificar aquí)
```

-   Importante en la variable WEBSOCKETS_HOST puede generar en algunas instalaciones error, por lo cual se debe modifcar el archivo resourses/js/bootstrap.js la variable wsHost y colocar wsHost: window.location.hostname, por defecto para usar la variable de .env debe estar wsHost: process.env.MIX_WEBSOCKETS_HOST,

-   Las variables del .env que te describo a continuación deben quedar tal cual te las estoy pasando.

```text
MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
MIX_WEBSOCKETS_HOST="${WEBSOCKETS_HOST}"
MIX_WEBSOCKETS_PORT="${WEBSOCKETS_PORT}"
```

-   Ejecutar el comando: php artisan websockets:serve

-   Configurar uso de coma en formato decimal

```text
Este archivo es node_modules/vuelidate/lib/validators/decimal.js
Lo que debes hacer es comentar la expresión regular actual de este validador y pegar esta:
var _default = (0, _common.regex)('decimal', /^[-]?\d*(\,\d+)?$/);
```

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
