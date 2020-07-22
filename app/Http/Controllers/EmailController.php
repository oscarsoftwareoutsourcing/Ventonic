<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Mail\Mailer;
use Webklex\IMAP\Client;
use Webklex\IMAP\Facades\Client as PresetClient;
use Webklex\IMAP\Exceptions\ConnectionFailedException;
use Swift_SmtpTransport;
use Swift_Mailer;
use App\EmailSetting;
use App\EmailMessage;
use App\Mail\UserManageMail;
use Carbon\Carbon;

class EmailController extends Controller
{
    public function index()
    {
        try {
            /** @var boolean Determina si el usuario ya tiene configurado el gestor de correo */
            $hasEmailConfig = !EmailSetting::where('user_id', auth()->user()->id)->get()->isEmpty();
            return view('email.manage', compact('hasEmailConfig'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getSetting(Request $request)
    {
        $emailSetting = EmailSetting::with('emailMessage')->where('user_id', auth()->user()->id)->first();

        return response()->json([
            'result' => true,
            'name' => $emailSetting->name,
            'email' => $emailSetting->email,
            'protocol' => $emailSetting->protocol,
            'incoming_server_host' => $emailSetting->incoming_server_host,
            'incoming_server_port' => $emailSetting->incoming_server_port,
            'outgoing_server_host' => $emailSetting->outgoing_server_host,
            'outgoing_server_port' => $emailSetting->outgoing_server_port,
            'username' => $emailSetting->username
        ], 200);
    }

    public function setSetting(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'incoming_server_host' => ['required'],
            'incoming_server_port' => ['required', 'numeric'],
            'outgoing_server_host' => ['required'],
            'outgoing_server_port' => ['required', 'numeric'],
            'protocol' => ['required'],
            'email' => ['required', 'email'],
            'username' => ['required'],
            'password' => ['required']
        ]);
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
            $message = $e->getMessage();
            if (strpos($message, "AUTHENTICATIONFAILED") !== false) {
                $message = 'Falló la autenticación del usuario, ' .
                           'por favor verifique los datos de acceso a su cuenta de correo.';
            } elseif (strpos($message, 'No such host') !== false) {
                $message = 'No se puede establecer conexión con el servidor de correo, por favor intente mas tarde. ' .
                           'Si el problema persiste contacte al administrador de la aplicación';
            } elseif (strpos($message, 'Connection timed out') !== false) {
                $message = 'El tiempo de conexión con el servidor de correo exedio el limite permitido, ' .
                           'por favor intente más tarde. ' .
                           'Si el problema persiste contacte al administrador de la aplicación';
            }
            return response()->json(['result' => false, 'message' => $message]);
        }


        $emailSetting = EmailSetting::updateOrCreate(
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
                'password' => Crypt::encryptString($request->password)
            ]
        );

        $emails = [];
        $emailFolders = $emailClient->getFolders();

        foreach ($emailFolders as $folder) {
            $messages = $folder->messages()->all()->get();
            $emails[strtolower($folder->name)] = [];
            foreach ($messages as $message) {
                EmailMessage::updateOrCreate(
                    ['message_id' => $message->message_id],
                    [
                        'message_nro' => $message->getMessageNo(),
                        'folder_type' => strtolower($folder->name),
                        'subject' => $message->getSubject(),
                        'references' => $message->getReferences(),
                        'message_at' => $message->getDate(),
                        'from' => json_encode($message->getFrom()),
                        'to' => json_encode($message->getTo()),
                        'cc' => ($message->getCc()) ? json_encode($message->getCc()) : null,
                        'bcc' => ($message->getBcc()) ? json_encode($message->getBcc()) : null,
                        'reply_to' => json_encode($message->getReplyTo()),
                        'sender' => json_encode($message->getSender()),
                        'attachments' => ($message->getAttachments()) ? json_encode($message->getAttachments()) : null,
                        'body' => ($message->hasHTMLBody())
                                  ? $message->getHTMLBody()
                                  : (($message->hasTextBody()) ? $message->getTextBody() : null),
                        'body_text' => $message->getTextBody() ?? '',
                        'email_setting_id' => $emailSetting->id
                    ]
                );
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
                    'body_text' => $message->getTextBody() ?? ''
                ]);
            }
        }

        return response()->json(['result' => true, 'emails_list' => $emails], 200);
    }

    /**
     * Obtiene los mensajes del servidor de correo
     *
     * @method    getMessages
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @param     [integer]     $download   Establece si se descarga o no los mensajes desde el servidor de correo
     *
     * @return    JsonResponse         Objeto con los mensajes del usuario
     */
    public function getMessages($download = 0)
    {
        $user = auth()->user();

        try {
            $emailSetting = EmailSetting::with('emailMessage')->where('user_id', auth()->user()->id)->first();

            if ($emailSetting) {
                if ($download || EmailMessage::where('email_setting_id', $emailSetting->id)->get()->isEmpty()) {
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
                            $emailMessage = EmailMessage::updateOrCreate(
                                ['message_id' => $message->message_id],
                                [
                                    'message_nro' => $message->getMessageNo(),
                                    'folder_type' => strtolower($folder->name),
                                    'subject' => $message->getSubject(),
                                    'references' => $message->getReferences(),
                                    'message_at' => $message->getDate(),
                                    'from' => json_encode($message->getFrom()),
                                    'to' => json_encode($message->getTo()),
                                    'cc' => ($message->getCc()) ? json_encode($message->getCc()) : null,
                                    'bcc' => ($message->getBcc()) ? json_encode($message->getBcc()) : null,
                                    'reply_to' => json_encode($message->getReplyTo()),
                                    'sender' => json_encode($message->getSender()),
                                    'attachments' => ($message->getAttachments())
                                                     ? json_encode($message->getAttachments()) : null,
                                    'body' => ($message->hasHTMLBody())
                                              ? $message->getHTMLBody()
                                              : (($message->hasTextBody()) ? $message->getTextBody() : null),
                                    'body_text' => $message->getTextBody() ?? '',
                                    'email_setting_id' => $emailSetting->id
                                ]
                            );
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
                                'body_text' => $message->getTextBody() ?? ''
                            ]);
                        }
                    }
                } else {
                    $emails = [];
                    foreach ($emailSetting->emailMessage()->get() as $message) {
                        $emails[$message->folder_type] = $emails[$message->folder_type] ?? [];
                        array_push($emails[$message->folder_type], [
                            'message_id' => $message->message_id,
                            'message_nro' => $message->message_nro,
                            'subject' => $message->subject,
                            'references' => $message->references,
                            'message_at' => $message->message_at,
                            'from' => json_decode($message->from),
                            'to' => json_decode($message->to),
                            'cc' => json_decode($message->cc),
                            'bcc' => json_decode($message->bcc),
                            'reply_to' => json_decode($message->reply_to),
                            'sender' => json_decode($message->sender),
                            'attachments' => json_decode($message->attachments),
                            'body' => $message->body,
                            'body_text' => $message->body_text
                        ]);
                    }
                }

                $trashed = $emailSetting->emailMessage()->onlyTrashed()->get();
                $favorites = $emailSetting->emailMessage()->where('favorite', true)->get();
                $sends = $emailSetting->emailMessage()->where('folder_type', 'sent')->get();

                return response()->json([
                    'result' => true, 'emails_list' => $emails, 'trashed' => $trashed, 'favorites' => $favorites,
                    'messages_send' => $sends
                ], 200);
            }

            return response()->json([
                'result' => false,
                'message' => 'No ha configurado una cuenta de correo. Verifique'
            ], 200);
        } catch (ConnectionFailedException $e) {
            return response()->json(['result' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Envía mensajes de correo electrónico
     *
     * @method    sentMessage
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @param     Request        $request    Objeto con la petición
     *
     * @return    JsonResponse         Devuelve un objeto con el resultado de la petición
     */
    public function sentMessage(Request $request)
    {
        $this->validate($request, [
            'to' => ['required'],
            'subject' => ['required'],
            'message' => ['required']
        ], [
            'to.required' => 'El campo "Para" es obligatorio',
            'subject.required' => 'El campo "Asunto" es obligatorio',
            'message.required' => 'El campo "Mensaje" es obligatorio'
        ]);

        $toEmails = explode(",", $request->to);
        if ($request->cc) {
            $ccEmails = explode(",", $request->cc);
        }
        if ($request->bcc) {
            $bccEmails = explode(",", $request->bcc);
        }

        $user = auth()->user();

        $emailSetting = EmailSetting::where('user_id', $user->id)->first();

        if ($emailSetting) {
            /** @var Swift_SmtpTransport Establece datos para el envío de correo dsegún configuración de smtp */
            $configuration = [
                'smtp_host'    => $emailSetting->outgoing_server_host,
                'smtp_port'    => $emailSetting->outgoing_server_port,
                'smtp_username'  => $emailSetting->username,
                'smtp_password'  => Crypt::decryptString($emailSetting->password),
                'smtp_encryption'  => 'ssl',
                'from_email'    => $emailSetting->email,
                'from_name'    => $user->name,
            ];

            $mailer = app()->makeWith('user.mailer', $configuration);
            $mailer->to($toEmails)->send(new UserManageMail($request->subject, $request->message));

            /** @var object Objeto con el último mensaje enviado si existe */
            $messagesSend = EmailMessage::where([
                'email_setting_id' => $emailSetting->id,
                'folder_type' => 'sent'
            ])->orderBy('message_nro', 'desc')->first();

            $now = Carbon::now();

            $to = $cc = $bcc = [];
            foreach ($toEmails as $toEmail) {
                array_push($to, [
                    "full" => "<".$toEmail.">",
                    "host" => explode("@", $toEmail)[1],
                    "mail" => $toEmail,
                    "mailbox" => explode("@", $toEmail)[0],
                    "personal" => ""
                ]);
            }

            if (isset($ccEmails)) {
                foreach ($ccEmails as $ccEmail) {
                    array_push($cc, [
                        "full" => "<".$ccEmail.">",
                        "host" => explode("@", $ccEmail)[1],
                        "mail" => $ccEmail,
                        "mailbox" => explode("@", $ccEmail)[0],
                        "personal" => ""
                    ]);
                }
            }
            if (isset($bccEmails)) {
                foreach ($bccEmails as $bccEmail) {
                    array_push($bcc, [
                        "full" => "<".$bccEmail.">",
                        "host" => explode("@", $bccEmail)[1],
                        "mail" => $bccEmail,
                        "mailbox" => explode("@", $bccEmail)[0],
                        "personal" => ""
                    ]);
                }
            }

            $from = [
                [
                    "full" => $user->name . " <" . $user->email . ">",
                    "host" => explode("@", $user->email)[1],
                    "mail" => $user->email,
                    "mailbox" => explode("@", $user->email)[0],
                    "personal" => $user->name
                ]
            ];

            /** Guarda el mensaje enviado en base de datos */
            EmailMessage::create([
                'message_id' => Crypt::encryptString((string)$user->id . $now),
                'message_nro' => ($messagesSend) ? ((int)$messagesSend->mesage_nro + 1) : 1,
                'folder_type' => 'sent',
                'subject' => $request->subject,
                'references' => '',
                'message_at' => $now,
                'from' => json_encode($from),
                'to' => json_encode($to),
                'cc' => (count($cc) > 0) ? json_encode($cc) : null,
                'bcc' => (count($bcc) > 0) ? json_encode($bcc) : null,
                'reply_to' => json_encode($from),
                'sender' => json_encode($from),
                'attachments' => null,
                'body' => $request->message,
                'body_text' => $request->message,
                'email_setting_id' => $emailSetting->id
            ]);

            /** @var object Objeto con un listado de mensajes enviados */
            $emailMessages = EmailMessage::where([
                'email_setting_id' => $emailSetting->id,
                'folder_type' => 'sent'
            ])->orderBy('message_nro', 'desc')->get();
        }

        return response()->json(['result' => true, 'messages_send' => $emailMessages], 200);
    }

    /**
     * Elimina uno o varios mensajes
     *
     * @method    destroyMessages
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @param     Request            $request    [description]
     *
     * @return    JsonResponse
     */
    public function destroyMessages(Request $request)
    {
        if (is_array($request->messages)) {
            foreach ($request->messages as $message) {
                $email = EmailMessage::where('message_id', $message)->first();
                if ($email) {
                    $email->delete();
                }
            }
        } else {
            $email = EmailMessage::where('message_id', $request->messages)->first();
            if ($email) {
                $email->delete();
            }
        }
        return response()->json(['result' => true], 200);
    }

    /**
     * Establece los mensages marcados como favoritos
     *
     * @method    setFavorite
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @param     Request        $request    Objeto con la petición
     */
    public function setFavorite(Request $request)
    {
        $message = EmailMessage::where('message_id', $request->message_id)->first();

        if (!$message) {
            return response()->json(['result' => false, 'message' => 'Mensage no encontrado'], 200);
        }

        $message->favorite = true;
        $message->save();
        return response()->json(['result' => true], 200);
    }

    /**
     * Guardar mensaje en borradores
     *
     * @method    saveDraft
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @param     Request      $request    Objeto con los datos de la petición
     *
     * @return    JsonResponse       Objeto con los datos de respuesta
     */
    public function saveDraft(Request $request)
    {
        $emailSetting = EmailSetting::where('user_id', $user->id)->first();

        /** Guarda el mensaje en la carpeta de borradores */
        /*EmailMessage::create([
            'message_id' => Crypt::encryptString((string)$user->id . $now),
            'message_nro' => ($messagesSend) ? ((int)$messagesSend->mesage_nro + 1) : 1,
            'folder_type' => 'sent',
            'subject' => $request->subject,
            'references' => '',
            'message_at' => $now,
            'from' => json_encode($from),
            'to' => json_encode($to),
            'cc' => (count($cc) > 0) ? json_encode($cc) : null,
            'bcc' => (count($bcc) > 0) ? json_encode($bcc) : null,
            'reply_to' => json_encode($from),
            'sender' => json_encode($from),
            'attachments' => null,
            'body' => $request->message,
            'body_text' => $request->message,
            'email_setting_id' => $emailSetting->id
        ]);*/

        $drafts = EmailMessage::where([
            'email_setting_id' => $emailSetting->id,
            'folder_type' => 'draft'
        ])->get();

        return response()->json(['result' => true, 'drafts' => $drafts], 200);
    }
}
