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
                'subject' => 'Negociación',
                'html_template' => '<!doctype html>
                                    <html lang="es">
                                        <head>
                                            <meta charset="UTF-8">
                                            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
                                            <title>Negociación con {{ fromUserName }}</title>
                                        </head>
                                        <body>
                                            <p>{{ subject }}</p>
                                            <p>{{ msg }}</p>
                                            <p>Saludos, {{ fromUserName }}.</p>
                                        </body>
                                    </html>'
            ]
        );
    }
}
