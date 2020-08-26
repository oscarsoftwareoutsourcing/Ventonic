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
    }
}
