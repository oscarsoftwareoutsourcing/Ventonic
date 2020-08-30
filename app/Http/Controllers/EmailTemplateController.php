<?php

namespace App\Http\Controllers;

use App\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emailTemplates = EmailTemplate::all();
        return view('mails.list-templates', compact('emailTemplates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mails.edit-template');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            //'mailable' => ['required', 'unique:email_templates,mailable'],
            'mailable' => ['required'],
            'name' => ['required'],
            'type' => ['required'],
            'subject' => ['required'],
            'body' => ['required']
        ]);

        EmailTemplate::updateOrCreate(
            ['mailable' => $request->mailable],
            [
                'name' => $request->name,
                'type' => $request->type,
                'module' => $request->module ?? null,
                'subject' => $request->subject,
                'html_template' => $request->body
            ]
        );

        return response()->json(['result' => true], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(EmailTemplate $emailTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $emailTemplate = EmailTemplate::find($id);
        $mailable = $emailTemplate->mailable;
        $templateVariables = [];
        foreach ($mailable::getVariables() as $variable) {
            array_push($templateVariables, [
                'name' => $variable,
                'description' => ''
            ]);
        }
        return view('mails.edit-template', compact('emailTemplate', 'templateVariables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailTemplate $emailTemplate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailTemplate $emailTemplate)
    {
        //
    }

    public function getVariables(Request $request)
    {
        $mailable = $request->mailable;
        $variables = [];
        foreach ($mailable::getVariables() as $variable) {
            array_push($variables, [
                'name' => $variable,
                'description' => ''
            ]);
        }

        return response()->json(['variables' => $variables], 200);
    }

    public function getMailables()
    {
        return response()->json([
            'mailables' => [
                [
                    'text' => 'Genérico', 'class' => '\App\Mail\Generic',
                    'variables' => [
                        ['name' => 'fromUserName', 'description' => 'Nombre de usuario que envía'],
                        ['name' => 'fromUserEmail', 'description' => 'Correo de usuario que envía'],
                        ['name' => 'msg', 'description' => 'Mensaje dinámico'],
                        ['name' => 'module', 'description' => 'Nombre del módulo u opción del sistema. Opcional'],
                    ]
                ]
            ]
        ], 200);
    }

    public function getModules()
    {
        //notificaciones, registros, bienvenida, recuperar clave, oportunidades, negociaciones, widget
        $modules = [
            ['text' => 'Aplicación en general', 'class' => ''],
            ['text' => 'Registro de usuario', 'class' => ''],
            ['text' => 'Bienvenida de usuario', 'class' => ''],
            ['text' => 'Recuperar contraseña', 'class' => ''],
            ['text' => 'Perfil incompleto', 'class' => ''],
            ['text' => 'Perfil completo', 'class' => ''],
            ['text' => 'Invitación a grupo', 'class' => ''],
            ['text' => 'Mensajes del chat', 'class' => ''],
            ['text' => 'Notificaciones', 'class' => \App\Notification::class],
            ['text' => 'Oportunidades', 'class' => \App\Oportunity::class],
            ['text' => 'Negociaciones', 'class' => \App\Negotiation::class],
            ['text' => 'Widgets', 'class' => \App\Widget::class],
        ];
        return response()->json(['modules' => $modules], 200);
    }
}
