<?php

use Illuminate\Database\Seeder;
use App\EmailTemplate;

class EmailTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmailTemplate::updateOrCreate(
            ['mailable' => \App\Mail\Generic::class],
            [
                'name' => 'Plantilla genérica',
                'type' => 'N',
                'module' => 'General',
                'subject' => 'Ventonic',
                'html_template' => '<p>{{ subject }}</p><p>{{ msg }}</p><p>Saludos, {{ fromUserName }}.</p>',
                'text_template' => '{{ subject }}\n\n{{ msg }}\n\n Saludos, {{ fromUserName }}'
            ]
        );
        EmailTemplate::updateOrCreate(
            ['mailable' => \App\Mail\Negotiation::class],
            [
                'name' => 'Plantilla de negociaciones',
                'type' => 'N',
                'module' => 'Negociaciones',
                'subject' => 'Negociación',
                'html_template' => '<!doctype html>' .
                                   '<html lang="es">' .
                                        '<head>' .
                                            '<meta charset="UTF-8">' .
                                            '<meta name="viewport" ' .
                                                   'content="width=device-width, user-scalable=no, initial-scale=1.0">'.
                                            '<title>Negociación con {{ fromUserName }}</title>' .
                                        '</head>' .
                                        '<body>' .
                                            '<p>{{ subject }}</p>' .
                                            '<p>{{ msg }}</p>' .
                                            '<p>Saludos, {{ fromUserName }}.</p>' .
                                        '</body>' .
                                    '</html>'
            ]
        );
        EmailTemplate::updateOrCreate(
            ['mailable' => \App\Mail\NuevaInvitacionRecibida::class],
            [
                'name' => 'Plantilla de invitaciones a grupos recibida',
                'type' => 'N',
                'module' => 'Grupos',
                'subject' => 'Invitación a grupo',
                'html_template' =>  '<!doctype html>' .
                                    '<html lang="es">' .
                                        '<head>' .
                                            '<meta charset="UTF-8">' .
                                            '<meta name="viewport" ' .
                                                   'content="width=device-width, user-scalable=no, initial-scale=1.0">'.
                                            '<title>Nueva Invitación de grupo</title>' .
                                        '</head>' .
                                        '<body>' .
                                            '<p>Hola! Has sido invitado a unirte al grupo {{ name_group }}</p>' .
                                            '<p>' .
                                                'Si deseas unirte ve a la siguiente url para ' .
                                                '<a class="text-primary" href="{{ url(env("APP_URL")."/registro") }}">
                                                    registrarte
                                                </a>' .
                                                'en nuestra plataforma! Una vez registrado encontrarás ' .
                                                'la invitación en tu perfil.' .
                                            '</p>' .
                                            '<p>Saludos, Equipo Ventonic.</p>' .
                                        '</body>' .
                                    '</html>'
            ]
        );
        EmailTemplate::updateOrCreate(
            ['mailable' => \App\Mail\GroupInvitation::class],
            [
                'name' => 'Plantilla de nueva invitaciones a grupos enviadas',
                'type' => 'N',
                'module' => 'Grupos',
                'subject' => 'Nueva invitación recibida',
                'html_template' =>  '<!doctype html>' .
                                    '<html lang="es">' .
                                        '<head>' .
                                            '<meta charset="UTF-8">' .
                                            '<meta name="viewport" ' .
                                                   'content="width=device-width, user-scalable=no, initial-scale=1.0">'.
                                            '<title>Nueva Invitación de grupo</title>' .
                                        '</head>' .
                                        '<body>' .
                                            '<p>' .
                                                '¡Hola {{ name }}! Ha sido invitado a unirse al grupo {{ groupName }}' .
                                            '</p>' .
                                            '<p>' .
                                                'Si desea unirse haga click en <a href="{{ url }}">este enlace</a>' .
                                                ' para registrarse en nuestra plataforma. ' .
                                                'Una vez registrado encontrarás la invitación en tu perfil.' .
                                            '</p>' .
                                        '</body>' .
                                    '</html>'
            ]
        );

        EmailTemplate::updateOrCreate(
            ['mailable' => \App\Mail\Auth\VerifyEmail::class],
            [
                'name' => 'Plantilla para la verificación de correo',
                'type' => 'N',
                'module' => 'Acceso',
                'subject' => 'Verificar dirección de correo',
                'html_template' =>  '<!doctype html>' .
                                    '<html lang="es">' .
                                        '<head>' .
                                            '<meta charset="UTF-8">' .
                                            '<meta name="viewport" ' .
                                                   'content="width=device-width, user-scalable=no, initial-scale=1.0">'.
                                            '<title>Verificar dirección de correo</title>' .
                                        '</head>' .
                                        '<body>' .
                                            '<p>' .
                                                '¡Hola {{ name }}!' .
                                            '</p>' .
                                            '<p>' .
                                                'Haga clic en el siguiente botón para verificar su dirección ' .
                                                'de correo electrónico.' .
                                            '</p>' .
                                            '<p>' .
                                                '<button type="button" onclick="location.href={{ url }}" ' .
                                                        'style="margin:0 auto">' .
                                                    'Verificar dirección de correo' .
                                                '</button>' .
                                            '</p>' .
                                            '<p>' .
                                                'Si tiene problemas para hacer clic en el botón ' .
                                                '"Verificar dirección de correo", copie y pegue la URL a continuación '.
                                                'en su navegador web:<br>' .
                                                '<a href="{{ url }}" target="_blank">{{ url }}</a>' .
                                            '</p>' .
                                            '<p>' .
                                                'Si no ha creado una cuenta, no se requiere ninguna otra acción.' .
                                            '</p>' .
                                        '</body>' .
                                    '</html>'
            ]
        );

        EmailTemplate::updateOrCreate(
            ['mailable' => \App\Mail\Auth\WelcomeEmail::class],
            [
                'name' => 'Plantilla de bienvenida a la aplicación',
                'type' => 'N',
                'module' => 'Acceso',
                'subject' => 'Bienvenido a {{ appName }}',
                'html_template' =>  '<!doctype html>' .
                                    '<html lang="es">' .
                                        '<head>' .
                                            '<meta charset="UTF-8">' .
                                            '<meta name="viewport" ' .
                                                   'content="width=device-width, user-scalable=no, initial-scale=1.0">'.
                                            '<title>Bienvenida</title>' .
                                        '</head>' .
                                        '<body>' .
                                            '<p>' .
                                                '¡Bienvenido(a) {{ userName }}!, ' .
                                                'has sido verificado correctamente en nuestro sistema.' .
                                            '</p>' .
                                            '<p>' .
                                                'Ya puede hacer uso de todas las funcionalidades.' .
                                            '</p>' .
                                            '<p>' .
                                                '¡Gracias por usar nuestra aplicación!' .
                                            '</p>' .
                                            '<p>' .
                                                'Este correo es enviado de manera automática por la aplicación y ' .
                                                'no está siendo monitoreado. Por favor, no responda a este correo.' .
                                            '</p>' .
                                        '</body>' .
                                    '</html>'
            ]
        );

        EmailTemplate::updateOrCreate(
            ['mailable' => \App\Mail\Auth\ResetPasswordEmail::class],
            [
                'name' => 'Plantilla de reinicio de contraseña',
                'type' => 'N',
                'module' => 'Acceso',
                'subject' => 'Notificación de restablecimiento de contraseña',
                'html_template' =>  '<!doctype html>' .
                                    '<html lang="es">' .
                                        '<head>' .
                                            '<meta charset="UTF-8">' .
                                            '<meta name="viewport" ' .
                                                   'content="width=device-width, user-scalable=no, initial-scale=1.0">'.
                                            '<title>Notificación de restablecimiento de contraseña</title>' .
                                        '</head>' .
                                        '<body>' .
                                            '<p>' .
                                                'Recibió este correo electrónico porque recibimos una solicitud de ' .
                                                'restablecimiento de contraseña para su cuenta.' .
                                            '</p>' .
                                            '<p>' .
                                                '<a href="{{ url }}" target="_blank">Restablecer la contraseña</a>' .
                                            '</p>' .
                                            '<p>' .
                                                'Este enlace de restablecimiento de contraseña caducará en ' .
                                                ' {{ count }} minutos.' .
                                            '</p>' .
                                            '<p>' .
                                                '¡Gracias por usar nuestra aplicación!' .
                                            '</p>' .
                                            '<p>' .
                                                'Este correo es enviado de manera automática por la aplicación y ' .
                                                'no está siendo monitoreado. Por favor, no responda a este correo.' .
                                            '</p>' .
                                        '</body>' .
                                    '</html>'
            ]
        );
    }
}
