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
            'email' => ['required'],
            'subject' => ['required'],
            'message' => ['required']
        ]);

        $emails = explode(",", $request->email);

        foreach ($emails as $email) {
            $user = User::where('email', trim($email))->first();
            /*if (!$user) {
                return response()->json(['result' => false, 'message' => 'El contacto no existe'], 200);
            }*/
            $model = "App\\" . ucfirst($request->modelRelationClass);

            Email::create([
                'subject' => $request->subject,
                'message' => $request->message,
                'from_user_id' => auth()->user()->id,
                'to_user_id' => ($user) ? $user->id : null,
                'destination_email' => trim($email),
                'emailable_type' => $model,
                'emailable_id' => $request->modelRelationId
            ]);

            Mail::to(($user) ? $user : trim($email))->send(
                new GenericEmail(
                    trim($email),
                    ($user) ? $user->name : '',
                    $request->subject,
                    $request->message,
                    __($request->modelRelationClass)
                )
            );
        }



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

    /**
     * Obtiene un listado de contactos de acuerdo a los parámetros de búsqueda solicitados
     *
     * @method    getContactEmails
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Request             $request    Objeto con datos de la petición
     *
     * @return    JsonResponse        Objeto JSON con los datos de respuesta a la solicitud
     */
    public function getContactEmails(Request $request)
    {
        if (empty($request->searchText)) {
            return response()->json(['result' => true, 'contacts' => auth()->user()->contact], 200);
        }

        $contacts = auth()->user()->contact()->where('name', 'like', $request->searchText . '%')
                          ->orWhere('name', 'like', '%' . $request->searchText . '%')
                          ->orWhere('name', 'like', '%' . $request->searchText)
                          ->orWhere('last_name', 'like', $request->searchText . '%')
                          ->orWhere('last_name', 'like', '%' . $request->searchText . '%')
                          ->orWhere('last_name', 'like', '%' . $request->searchText)
                          ->orWhere('email', 'like', $request->searchText . '%')
                          ->orWhere('email', 'like', '%' . $request->searchText . '%')
                          ->orWhere('email', 'like', '%' . $request->searchText)->get();
        return response()->json(['result' => 'true', 'contacts' => $contacts], 200);
    }
}
