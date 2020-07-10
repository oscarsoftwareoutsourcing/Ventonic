<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cache;
use Webklex\IMAP\Client;
use Webklex\IMAP\Exceptions\ConnectionFailedException;
use App\EmailSetting;

class EmailController extends Controller
{
    public function index()
    {
        try {
            /** @var boolean Determina si el usuario ya tiene configurado el gestor de correo */
            $hasEmailConfig = Cache::rememberForever('email-config-' . auth()->user()->id, function () {
                return !EmailSetting::where('user_id', auth()->user()->id)->get()->isEmpty();
            });
            return view('email.manage', compact('hasEmailConfig'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function setSetting(Request $request)
    {
        $user = auth()->user();

        if ($request->autoConfig !== null) {
            //realizar proceso de configuración automática
        }

        try {
            //Verificar conexión con el servidor para determinar si todo esta correcto y es posible establecer
            //la conexión
            $emailClient = new Client([
                'host'          => $request->incoming_server_host,
                'port'          => $request->incoming_server_port ?? 993,
                'encryption'    => 'ssl',
                'validate_cert' => true,
                'username'      => $request->username,
                'password'      => $request->password,
                'protocol'      => $request->protocol
            ]);
            $emailClient->connect();

            if (!$emailClient->isConnected()) {
                return response()->json([
                    'result' => false,
                    'message' => 'No se pudo establecer la conexión con el servidor, ' .
                                 'verifique la configuración e intente de nuevo'
                ], 200);
            }
        } catch (ConnectionFailedException $e) {
            return response()->json(['result' => false, 'message' => $e->getMessage()]);
        }


        EmailSetting::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $request->name ?? $user->name,
                'incoming_server_host' => $request->incoming_server_host,
                'incoming_server_port' => $request->incoming_server_port ?? 993,
                'outgoing_server_host' => $request->outgoing_server_host,
                'outgoing_server_port' => $request->outgoing_server_port ?? 993,
                'protocol' => $request->protocol,
                'encryption' => $request->encryption ?? 'ssl',
                'validate_cert' => $request->validate_cert ?? true,
                'email' => $request->email,
                'username' => $request->username,
                'password' => ($request->rememberPassword) ? Crypt::encryptString($request->password) : null
            ]
        );

        $emails = [];
        $emailFolders = $emailClient->getFolders();

        foreach ($emailFolders as $folder) {
            $messages = $folder->messages()->all()->get();
            $emails[strtolower($folder->name)] = [];
            foreach ($messages as $message) {
                array_push($emails[strtolower($folder->name)], [
                    'message_id' => $message->message_id,
                    'message_nro' => $message->getMessageNo(),
                    'subject' => $message->getSubject(),
                    'references' => $message->getReferences(),
                    'message_at' => $message->getDate(),
                    'from' => $message->getFrom(),
                    'to' => $message->getTo(),
                    'cc' => $message->getCc(),
                    'bcc' => $message->getBcc(),
                    'reply_to' => $message->getReplyTo(),
                    'sender' => $message->getSender(),
                    'attachments' => $message->getAttachments(),
                    'body' => ($message->hasHTMLBody())
                              ? $message->getHTMLBody()
                              : (($message->hasTextBody()) ? $message->getTextBody() : null),
                ]);
            }
        }

        Cache::forget('email-config-' . $user->id);

        return response()->json(['result' => true, 'emails_list' => $emails], 200);
    }

    /**
     * Obtiene los mensajes del servidor de correo
     *
     * @method    getMessages
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @return    JsonResponse         Objeto con los mensajes del usuario
     */
    public function getMessages()
    {
        $user = auth()->user();

        try {
            $emailSetting = Cache::rememberForever('email-config-' . $user->id, function () use ($user) {
                return EmailSetting::where('user_id', $user->id)->first();
            });

            if ($emailSetting) {
                $emailClient = new Client([
                    'host'          => $emailSetting->incoming_server_host,
                    'port'          => $emailSetting->incoming_server_port,
                    'encryption'    => 'ssl',
                    'validate_cert' => true,
                    'username'      => $emailSetting->username,
                    'password'      => Crypt::decryptString($emailSetting->password),
                    'protocol'      => $emailSetting->protocol
                ]);
                $emailClient->connect();

                if (!$emailClient->isConnected()) {
                    return response()->json([
                        'result' => false,
                        'message' => 'No se pudo establecer la conexión con el servidor, ' .
                                     'verifique la configuración e intente de nuevo'
                    ], 200);
                }

                $emails = [];
                $emailFolders = $emailClient->getFolders();

                foreach ($emailFolders as $folder) {
                    $messages = $folder->messages()->all()->get();
                    $emails[strtolower($folder->name)] = [];
                    foreach ($messages as $message) {
                        array_push($emails[strtolower($folder->name)], [
                            'message_id' => $message->message_id,
                            'message_nro' => $message->getMessageNo(),
                            'subject' => $message->getSubject(),
                            'references' => $message->getReferences(),
                            'message_at' => $message->getDate(),
                            'from' => $message->getFrom(),
                            'to' => $message->getTo(),
                            'cc' => $message->getCc(),
                            'bcc' => $message->getBcc(),
                            'reply_to' => $message->getReplyTo(),
                            'sender' => $message->getSender(),
                            'attachments' => $message->getAttachments(),
                            'body' => ($message->hasHTMLBody())
                                      ? $message->getHTMLBody()
                                      : (($message->hasTextBody()) ? $message->getTextBody() : null),
                        ]);
                    }
                }

                return response()->json(['result' => true, 'emails_list' => $emails], 200);
            }
        } catch (ConnectionFailedException $e) {
            return response()->json(['result' => false, 'message' => $e->getMessage()]);
        }
    }
}
