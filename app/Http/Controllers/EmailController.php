<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Webklex\IMAP\Client;
use Webklex\IMAP\Exceptions\ConnectionFailedException;
use Swift_SmtpTransport;
use App\EmailSetting;
use App\EmailMessage;
use App\Mail\UserManageMail;
use App\Repositories\UploadRepository;
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
            'password' => ['required'],
            'download_time' => ['required', 'integer']
        ]);
        $user = auth()->user();

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
                'password' => Crypt::encryptString($request->password),
                'download_time' => $request->download_time
            ]
        );

        $emails = [];
        $emailFolders = $emailClient->getFolders();

        foreach ($emailFolders as $folder) {
            $messages = $folder->messages()->all()->get();
            /** @var integer Número total de mensajes de la bandeja */
            $totalMessages = $messages->count();
            /** @var integer Contador para los mensajes a mostrar. Por defecto se evalúan los últimos 10 */
            $countMessage = 0;
            /**
             * Indice del mensaje que se va a recorrer en el foreach para determinar si corresponde a los
             * últimos 10 mensajes
             *
             * @var    integer
             */
            $indexMessage = 0;
            $lastMessages = $totalMessages  - 10;
            $emails[strtolower($folder->name)] = [];
            foreach ($messages as $message) {
                if ($countMessage < 10 && $indexMessage >= $lastMessages) {
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
                        'body_text' => $message->getTextBody() ?? '',
                        'read' => false
                    ]);
                    $countMessage++;
                }
                $indexMessage++;
            }
        }

        return response()->json(['result' => true, 'emails_list' => $emails], 200);
    }

    /**
     * Elimina la configuración de la cuenta de correo
     *
     * @method    destroySetting
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @param     Request           $request    Objeto con datos de la petición
     *
     * @return    JsonResponse      Objeto Json con datos de respuesta a la petición
     */
    public function destroySetting(Request $request)
    {
        /** @var object Datos de la configuración a eliminar */
        $emailSetting = EmailSetting::where('user_id', auth()->user()->id)->first();

        /** @var object Mensajes asociados a la configuración a eliminar */
        $emailMessages = EmailMessage::where('email_setting_id', $emailSetting->id)->get();

        foreach ($emailMessages as $message) {
            $attachments = ($message->attachments !== null) ? json_decode($message->attachments) : [];
            if (count($attachments) > 0) {
                /** Elimina los archivos adjuntos */
                foreach ($attachments as $attachment) {
                    if (empty(env('AWS_BUCKET', '')) && strpos($attachment, 'http') !== false) {
                        //Lo elimina de AWS storage
                        Storage::disk('s3')->delete(auth()->user()->uuid . '/' . $attachment);
                    } else {
                        //Lo elimina del storage local en el servidor de la aplicación
                        Storage::disk('attachments')->delete($attachment);
                    }
                }
            }
            /** Elimina el mensaje */
            $message->delete();
        }

        $emailSetting->delete();
        return response()->json(['result' => true], 200);
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
                    //dd($emailFolders[5]);
                    foreach ($emailFolders as $folder) {
                        if (strpos($emailSetting->email, 'gmail') !== false && strpos(strtolower($folder->name), 'gmail') !== false) {
                            foreach ($folder->children as $subFolder) {
                                if (strtolower($subFolder->name) === 'spam') {
                                    $folderName = 'spam';
                                } elseif (strtolower($subFolder->name) === 'drafts' || strtolower($subFolder->name) === 'borradores') {
                                    $folderName = 'drafts';
                                } elseif (strtolower($subFolder->name) === 'featured' || strtolower($subFolder->name) === 'destacados' || strtolower($subFolder->name) === 'importantes') {
                                    $folderName = 'starred';
                                } elseif (strtolower($subFolder->name) === 'sent' || strtolower($subFolder->name) === 'enviados') {
                                    $folderName = 'sent';
                                } elseif (strtolower($subFolder->name) === 'trash' || strtolower($subFolder->name) === 'papelera') {
                                    $folderName = 'trash';
                                }
                            }
                        }
                        $messages = $folder->messages()->all()->get()->take(10);
                        $folderName = strtolower($folder->name);
                        $emails[$folderName] = [];
                        foreach ($messages as $message) {
                            $aAttachment = $message->getAttachments();
                            $attachments = [];
                            $aAttachment->each(function ($oAttachment) {

                                    /** Si no esta configurado el servicio de AWS */
                                $path = config('filesystems.disks.attachments.root');
                                /** @var \Webklex\IMAP\Attachment $oAttachment */
                                $oAttachment->save($path);
                                /** Si esta configurado el servicio de AWS */
                                if (!empty(env('AWS_BUCKET', ''))) {
                                    $upload = Storage::disk('s3')->put(
                                        auth()->user()->uuid . '/' . $oAttachment->getName(),
                                        File::get($path . '/' . $oAttachment->getName())
                                    );
                                    $file = Storage::disk('s3')->url($oAttachment->getName());
                                    return $file;
                                }
                                return $path . '/' . $oAttachment->getName();
                            });

                            foreach ($message->getAttachments() as $attachFile) {
                                if (empty(env('AWS_BUCKET', ''))) {
                                    $path = config('filesystems.disks.attachments.root');
                                    $file = $path . '/' . $attachFile->getName();
                                } else {
                                    $file = Storage::disk('s3')->url(
                                        auth()->user()->uuid . '/' . $attachFile->getName()
                                    );
                                }
                                array_push($attachments, $file);
                            }

                            $alreadyMessage = EmailMessage::where('message_id', $message->message_id)->first();

                            $emailMessage = EmailMessage::updateOrCreate(
                                ['message_id' => $message->message_id],
                                [
                                    'message_nro' => $message->getMessageNo(),
                                    'folder_type' => $folderName,
                                    'subject' => $message->getSubject(),
                                    'references' => $message->getReferences(),
                                    'message_at' => $message->getDate(),
                                    'from' => json_encode($message->getFrom()),
                                    'to' => json_encode($message->getTo()),
                                    'cc' => ($message->getCc()) ? json_encode($message->getCc()) : null,
                                    'bcc' => ($message->getBcc()) ? json_encode($message->getBcc()) : null,
                                    'reply_to' => json_encode($message->getReplyTo()),
                                    'sender' => json_encode($message->getSender()),
                                    'attachments' => (count($attachments) > 0) ? json_encode($attachments) : null,
                                    'body' => ($message->hasHTMLBody())
                                              ? $message->getHTMLBody()
                                              : (($message->hasTextBody()) ? $message->getTextBody() : null),
                                    'body_text' => $message->getTextBody() ?? '',
                                    'email_setting_id' => $emailSetting->id,
                                    'read' => ($alreadyMessage)?$alreadyMessage->read:false
                                ]
                            );
                            array_push($emails[$folderName], [
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
                                'attachments' => (count($attachments) > 0) ? json_encode($attachments) : [],
                                'body' => ($message->hasHTMLBody())
                                          ? $message->getHTMLBody()
                                          : (($message->hasTextBody()) ? $message->getTextBody() : null),
                                'body_text' => $message->getTextBody() ?? '',
                                'read' => ($alreadyMessage)?$alreadyMessage->read:false,
                            ]);
                        }
                    }
                } else {
                    $emails = [];
                    foreach ($emailSetting->emailMessage()->orderBy('message_at', 'desc')->get() as $message) {
                        $emails[$message->folder_type] = $emails[$message->folder_type] ?? [];
                        array_push($emails[$message->folder_type], [
                            'message_id' => $message->message_id,
                            'message_nro' => $message->message_nro,
                            'favorite' => $message->favorite,
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
                            'body_text' => $message->body_text,
                            'read' => $message->read,
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
            $msg = $e->getMessage();
            if (strpos($msg, 'Can not authenticate')) {
                $msg = "Fallo la autenticación con el servidor de correo. Verifique la configuración";
            }
            return response()->json(['result' => false, 'message' => $msg]);
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
    public function sentMessage(Request $request, UploadRepository $up)
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

            $attach = $request->attachments;
            $mailer = app()->makeWith('user.mailer', $configuration);

            /** Verifica si hay un archivo adjunto para subirlo al servidor y enviarlo en el correo */
            /*if ($request->file('attachmentEmail')) {
                if ($up->upload($request->file('attachmentEmail'), 'attachments', true)) {
                    $attach = $up->getStoredPath();
                }
            }*/

            $mailer->to($toEmails)->send(new UserManageMail($request->subject, $request->message, $attach));

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
                'attachments' => ($attach !== null && count($attach) > 0) ? json_encode($attach) : null,
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
        $message->favorite = !$message->favorite;
        $message->save();
        return response()->json(['result' => true, 'message' => $message], 200);
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

    /**
     * Marca un mensaje como leído o no leído de acuerdo al evento generado
     *
     * @method    markRead
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Request     $request    Objeto con información de la petición
     *
     * @return    JsonResponse            Objeto JSON con datos de la respuesta
     */
    public function markRead(Request $request)
    {
        $emailMessage = EmailMessage::where('message_id', $request->message_id)->first();
        if ($emailMessage) {
            $emailMessage->read = $request->read ?? true;
            $emailMessage->save();
        }
        return response()->json(['result' => true], 200);
    }

    /**
     * Guarda el archivo, a adjuntar en el correo, en el servidor para su posterior envío
     *
     * @method    uploadAttachment
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Request             $request    Objeto con datos de la petición
     *
     * @return    JsonResponse        Objeto JSON con datos de respuesta
     */
    public function uploadAttachment(Request $request, UploadRepository $up)
    {
        if ($request->file('attachmentEmail')) {
            if ($up->upload($request->file('attachmentEmail'), 'attachments', true, false, false, false)) {
                $attach = $up->getStoredPath();
                return response()->json(['result' => true, 'attach' => $attach], 200);
            }
        }

        return response()->json(['result' => false], 200);
    }

    /**
     * Elimina archivos adjuntos de un correo a ser enviado
     *
     * @method    destroyAttachment
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @param     Request              $request    Objeto con datos de la petición
     *
     * @return    JsonResponse         Objeto Json con datos de respuesta a la petición
     */
    public function destroyAttachment(Request $request)
    {
        if (empty(env('AWS_BUCKET', '')) && strpos($request->attachFile, 'http') !== false) {
            //Lo elimina de AWS storage
            Storage::disk('s3')->delete(auth()->user()->uuid . '/' . $request->attachFile);
        } else {
            //Lo elimina del storage local en el servidor de la aplicación
            Storage::disk('attachments')->delete($request->attachFile);
        }
        return response()->json(['result' => true], 200);
    }

    /**
     * Establece la(s) etiqueta(s) de un mensaje de correo
     *
     * @method    setTags
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @param     Request    $request    Objeto con datos de la petición
     *
     * @return    JsonResponse               Objeto con datos de respuesta a la petición
     */
    public function setTags(Request $request)
    {
        $emails = EmailMessage::whereIn('message_id', $request->emails)->get();
        foreach ($emails as $email) {
            $email->labels = (($email->labels !== null && !empty($email->labels)) ? $email->labels . ',' : '') .
                             strtolower($request->tag);
            $email->save();
        }
        return response()->json(['result' => true], 200);
    }

    /**
     * Obtiene listado de mensajes etiquetados
     *
     * @method    getTaggedMessages
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @return    JsonResponse               Objeto con datos de respuesta a la petición
     */
    public function getTaggedMessages()
    {
        $emails = EmailMessage::whereNotNull('labels')->get();

        $tagged = [
            'pe' => [],
            'co' => [],
            'im' => [],
            'pr' => []
        ];

        foreach ($emails as $email) {
            $tags = explode(",", $email->labels);
            foreach ($tags as $tag) {
                array_push($tagged[$tag], $email);
            }
        }

        return response()->json(['result' => true, 'tagged' => $tagged], 200);
    }

    /**
     * Determina la configuración a aplicar de acuerdo al dominio de la cuenta de correo suministrada
     *
     * @method    checkAutoConfig
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @param     Request            $request    Objeto con datos de la petición
     *
     * @return    JsonResponse                   Objeto con datos de respuesta a la petición
     */
    public function checkAutoConfig(Request $request)
    {
        try {
            //Verificar conexión con el servidor para determinar si todo esta correcto y es posible establecer
            //la conexión
            /*$emailClient = new Client([
                'host'          => $request->incoming_server_host,
                'port'          => $request->incoming_server_port ?? 993,
                'encryption'    => 'ssl',
                'validate_cert' => true,
                'username'      => $request->username,
                'password'      => $request->password,
                'protocol'      => $request->protocol
            ]);*/

            $config = $this->typeAccounts($request->email, $request->username, $request->pass);
            //dd($config);
            $client = new Client($config);
            $client->connect();

            if (!$client->isConnected()) {
                return response()->json([
                    'result' => false,
                    'message' => 'No se pudo establecer la conexión con el servidor, ' .
                                 'verifique la configuración e intente de nuevo'
                ], 200);
            }
        } catch (ConnectionFailedException $e) {
            return response()->json([
                'result' => false,
                'message' => `Ocurrió un error al tratar de conectar con el servidor. Debe ingresar los datos del
                              servidor manualmente`
            ], 200);
        }
        return response()->json(['result' => true, 'serverInfo' => $config], 200);
    }

    /**
     * Determina los datos de conexión al servidor de correo de acuerdo al dominio de la cuenta de correo
     *
     * @method    typeAccounts
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @param     string          $email       Dirección de correo electrónico
     * @param     string          $username    Nombre de usuario con acceso a la cuenta de correo electrónico
     * @param     string          $pass        Contraseña de acceso a la cuenta de correo electrónico
     * @param     string          $protocol    Tipo de protocolo a implementar. Este parámetro es opcional,
     *                                         si no se especifica el valor por defecto es el protocolo IMAP
     *
     * @return    array           Arreglo con información de acceso al servidor de correo
     */
    private function typeAccounts($email, $username, $pass, $protocol = 'imap') : array
    {
        list($usr, $domain) = explode("@", $email);
        $type = explode(".", $domain)[0];
        $extension = explode(".", $domain)[1];
        $host = $protocol . '.' .$domain;
        $outHost = 'mail' . '.' . $domain;

        if (in_array($type, ['hotmail', 'outlook'])) {
            $type = 'microsoft';
        }

        $accounts = [
            'default' => [
                'host'  => $host,
                'port'  => 993,
                'protocol'  => $protocol,
                'encryption'    => 'ssl',
                'validate_cert' => true,
                'username' => $username,
                'password' => $pass,
                'out_host' => $outHost,
                'out_port' => 465,
            ],
            'gmail' => [
                'host' => 'imap.gmail.com',
                'port' => 993,
                'protocol' => 'imap',
                'encryption' => 'ssl',
                'validate_cert' => true,
                'username' => $username,
                'password' => $pass,
                'out_host' => 'smtp.gmail.com',
                'out_port' => 587,
            ],
            'yahoo' => [
                'host' => 'imap.mail.yahoo.' . $extension,
                'port' => 993,
                'protocol' => 'imap',
                'encryption' => 'ssl',
                'validate_cert' => true,
                'username' => $username,
                'password' => $pass,
                'out_host' => 'smtp.mail.yahoo.' . $extension,
                'out_port' => 465,
            ],
            'microsoft' => [
                'host' => 'imap-mail.outlook.com',
                'port' => 993,
                'protocol' => 'imap',
                'encryption' => 'ssl',
                'validate_cert' => true,
                'username' => $username,
                'password' => $pass,
                'out_host' => 'smtp-mail.outlook.com',
                'out_port' => 587,
            ],
            'aol' => [
                'host' => 'imap.aol.com',
                'port' => 993,
                'protocol' => 'imap',
                'encryption' => 'ssl',
                'validate_cert' => true,
                'username' => $username,
                'password' => $pass,
                'out_host' => 'smtp.aol.com',
                'out_port' => 465,
            ],
        ];

        return $accounts[(isset($accounts[$type])) ? $type : 'default'];
    }

    /**
     * Permite marcar los mensajes de correo de acuerdo al tipo especificado. Ej. draft, spam, trash, readed o unreaded
     *
     * @method    markMessagesAs
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @param     Request           $request    Objeto con datos de la petición
     *
     * @return    JsonResponse                  Objeto con datos de respuesta a la petición
     */
    public function markMessagesAs(Request $request)
    {
        $emails = $request->emails;
        $emailList = [];

        foreach ($emails as $email_id) {
            $em = EmailMessage::where(['message_id' => $email_id])->first();
            if ($em) {
                $oldFolder = $em->folder_type;
                if ($request->type === 'unreaded') {
                    $em->read = false;
                } elseif ($request->type === 'readed') {
                    $em->read = true;
                } else {
                    $em->folder_type = $request->type;
                }
                $em->save();
                $newFolder = $em->folder_type;
                array_push($emailList, $em);
            }
        }
        return response()->json([
            'result' => true, 'oldFolder' => $oldFolder, 'newFolder' => $newFolder,
            'emails' => $emails, 'emailList' => $emailList
        ], 200);
    }

    /**
     * Verifica si tiene configurada una cuenta externa para la gestión de correos
     *
     * @method    hasExternalEmail
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @return    boolean             Devuelve verdadero si el usuario ha configurado una cuenta externa,
     *                                de lo contrario devuelve falso
     */
    public function hasExternalEmail()
    {
        $emailSetting = EmailSetting::where('user_id', auth()->user()->id)->first();

        return response()->json(['result' => ($emailSetting !== null)]);
    }
}
