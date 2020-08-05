<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Generic as GenericEmail;
use App\User;
use App\Email;

class EmailAppController extends Controller
{
    /**
     * Registra un correo a envíar asociado a una negociación
     *
     * @method    setEmail
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Request     $request    Objeto con datos de la petición
     *
     * @return  JsonResponse  Objeto con información de respuesta a la petición
     */
    public function setEmail(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'subject' => ['required'],
            'message' => ['required']
        ]);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['result' => false, 'message' => 'El contacto no existe'], 200);
        }

        $model = "App\\" . ucfirst($request->modelRelationClass);

        Email::create([
            'subject' => $request->subject,
            'message' => $request->message,
            'from_user_id' => auth()->user()->id,
            'to_user_id' => $user->id,
            'emailable_type' => $model,
            'emailable_id' => $request->modelRelationId
        ]);

        Mail::to($user)->send(
            new GenericEmail(
                $user->email,
                $user->name,
                $request->subject,
                $request->message,
                __($request->modelRelationClass)
            )
        );

        return response()->json(['result' => true], 200);
    }

    /**
     * Obtiene un listado de correos asociados a una negociación
     *
     * @method    getEmails
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Negotiation    $negotiation    Objeto con información de la negociación
     *
     * @return    JsonResponse   Objeto con datos de respuesta a la petición
     */
    public function getEmails($class, $id)
    {
        $model = "App\\" . ucfirst($class);
        $record = $model::find($id);

        if (!$record || !method_exists($record, 'emails')) {
            return response()->json(['result' => true, 'emails' => []]);
        }

        return response()->json([
            'result' => true, 'emails' => $record->emails()->orderBy('created_at', 'desc')->get()
        ], 200);
    }
}
