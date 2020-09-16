<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\VerifyEmail;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $with = ['sellerProfile', 'companyProfile'];
    protected $appends = ['filterable_seller', 'photo', 'unreaded_messages', 'chat_rooms'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'name', 'last_name', 'email', 'type', 'status', 'password', 'last_login', 'is_admin', 'dash_demo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'filterable_seller' => 'array',
        'last_login' => 'datetime:d/m/Y h:i:s A'
    ];

    /**
    * Reescribe el método que permite enviar la notificación de verificación de registro
    *
    * @return void
    */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * User has many ChatRoomUsers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chatRoomUsers()
    {
        return $this->hasMany(ChatRoomUser::class);
    }

    /**
     * User has one SellerProfile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sellerProfile()
    {
        return $this->hasOne(SellerProfile::class);
    }

    /**
     * User has one CompanyProfile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function companyProfile()
    {
        return $this->hasOne(CompanyProfile::class);
    }

    /**
     * User has many SellerAnsweredSurveys.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sellerAnsweredSurveys()
    {
        return $this->hasMany(SellerAnsweredSurvey::class);
    }

    /* User has many Contacts.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function contact()
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * User has many CompanyAnsweredSurveys.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function companyAnsweredSurveys()
    {
        return $this->hasMany(CompanyAnsweredSurvey::class);
    }

    /**
     * User has many Message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * User has many Events.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }


    public function oportunity()
    {
        return $this->hasMany('App\Oportunity');
    }

    /**
     * User has many CallEvents.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function callEvents()
    {
        return $this->hasMany(CallEvent::class);
    }

    /**
     * User has many Tasks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // User notes
    public function todos()
    {
        return $this->hasMany(Todo::class);
    }

    // User negotiations
    public function negotiations()
    {
        return $this->hasMany(Negotiation::class);
    }

    // User related negotiations
    public function related_negotiations()
    {
        return $this->belongsToMany(Negotiation::class);
    }

    // User moduleLabels
    public function negotiation_processes()
    {
        return $this->hasMany(UserModuleLabel::class);
    }

    /**
    * User has many EmailSettings.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function emailSettings()
    {
        return $this->hasMany(EmailSetting::class);
    }

    // User groups
    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function related_groups()
    {
        // return $this->hasManyThrough(Group::class, GroupUser::class);
        return $this->hasMany('App\GroupUser', 'user_id');
    }

    /**
     * User has many FromEmails.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fromEmails()
    {
        return $this->hasMany(Email::class, 'from_user_id');
    }

    /**
     * User has many ToEmails.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function toEmails()
    {
        return $this->hasMany(Email::class, 'to_user_id');
    }

    /**
     * User has many Notes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * User has many Widgets.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function widgets()
    {
        return $this->hasMany(Widget::class);
    }

    public function getPhotoAttribute()
    {
        return ($this->sellerProfile!==null)
               ? ($this->sellerProfile->photo ?? '')
               : (($this->companyProfile!==null) ? ($this->companyProfile->photo ?? '') : '');
    }

    /**
     * Agrega un atributo para obtener el tipo de usuario (vendedor o empresa)
     *
     * @method    getTypeAttribute
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @return    string              Devuelve el tipo de usuario, si es vendedor o empresa
     */
    //public function getTypeAttribute()
    //{
        //return ($this->sellerProfile!==null) ? 'Vendedor' : (($this->companyProfile!==null) ? 'Empresa' : '');
        //return $this->type;
    //}



    public function getTypeuserAttribute()
    {
        return ($this->sellerProfile!==null) ? 'V' : (($this->companyProfile!==null) ? 'E' : '');
    }

    /**
     * Evalua y agrega un atributo con los usuarios del tipo vendedor que hayan respondido una encuesta
     *
     * @method     getFilterableSellerAttribute
     *
     *
     * @return     string|array|null    Devuelve nulo si el vendedor no ha llenado la encuesta, de lo contrario
     *                                  devuelve todas las opciones seleccionadas
     */
    public function getFilterableSellerAttribute()
    {
        return (
            !is_null($this->sellerProfile) && !is_null($this->sellerProfile->answered)
        ) ? $this->sellerProfile->answered : null;
    }

    public function getUnreadedMessagesAttribute()
    {
        return count($this->messages()->where('unreaded', true)->get());
    }

    public function getChatRoomsAttribute()
    {
        return $this->chatRoomUsers()->latest('updated_at')->get('chat_room_id');
    }

    /**
     * Filtra la consulta solo para usuarios de tipo vendedor
     *
     * @method     scopeSeller
     *
     *
     * @param      object           $query    Objeto con la consulta
     *
     * @return     object           Objeto con la consulta filtrada
     */
    public function scopeSeller($query)
    {
        return $query->whereType('V');
    }

    /**
     * Filtra la consulta solo para usuarios que se encuentran conectados
     *
     * @method     scopeStatusConnected
     *
     * @param      object           $query    Objeto con la consulta
     *
     * @return     object           Objeto con la consulta filtrada
     */
    public function scopeStatusConnected($query)
    {
        return $query->whereStatus(true);
    }

    /**
     * Filtra la consulta solo para usuarios que se encuentran desconectados
     *
     * @method     scopeStatusDisconnected
     *
     *
     * @param      object           $query    Objeto con la consulta
     *
     * @return     object           Objeto con la consulta filtrada
     */
    public function scopeStatusDisconnected($query)
    {
        return $query->whereStatus(false);
    }

    /**
     * Filtra la consulta solo para usuarios que contengan en el nombre la condición dada
     *
     * @method     scopeByName
     *
     *
     * @param      object           $query    Objeto con la consulta
     * @param      string           $text     Texto con el nombre a filtrar
     *
     * @return     object           Objeto con la consulta filtrada
     */
    public function scopeByName($query, $text)
    {
        if (empty($text)) {
            return $query;
        }

        return $query->where('name', 'like', '%' . $text . '%')
                     ->orWhere('name', 'like', '%' . $text)
                     ->orWhere('name', 'like', $text . '%');
    }

    public function scopeOrByName($query, $text)
    {
        if (empty($text)) {
            return $query;
        }

        return $query->orWhere('name', 'like', '%' . $text . '%')
                     ->orWhere('name', 'like', '%' . $text)
                     ->orWhere('name', 'like', $text . '%');
    }

    /**
     * Filtra la consulta solo para usuarios que contengan en el apellido la condición dada
     *
     * @method     scopeByName
     *
     * @param      object           $query    Objeto con la consulta
     * @param      string           $text     Texto con el apellido a filtrar
     *
     * @return     object           Objeto con la consulta filtrada
     */
    public function scopeByLastName($query, $text)
    {
        if (empty($text)) {
            return $query;
        }

        return $query->where('last_name', 'like', '%' . $text . '%')
                     ->orWhere('last_name', 'like', '%' . $text)
                     ->orWhere('last_name', 'like', $text . '%');
    }


    public function scopeOrByLastName($query, $text)
    {
        if (empty($text)) {
            return $query;
        }

        return $query->orWhere('last_name', 'like', '%' . $text . '%')
                     ->orWhere('last_name', 'like', '%' . $text)
                     ->orWhere('last_name', 'like', $text . '%');
    }

    /**
     * Filtra la consulta solo para usuarios que contengan en el correo electrónico la condición dada
     *
     * @method     scopeByName
     *
     * @param      object           $query    Objeto con la consulta
     * @param      string           $text     Texto con el correo electrónico a filtrar
     *
     * @return     object           Objeto con la consulta filtrada
     */
    public function scopeByEmail($query, $text)
    {
        if (empty($text)) {
            return $query;
        }

        return $query->where('email', 'like', '%' . $text . '%')
                     ->orWhere('email', 'like', '%' . $text)
                     ->orWhere('email', 'like', $text . '%');
    }

    public function scopeOrByEmail($query, $text)
    {
        if (empty($text)) {
            return $query;
        }

        return $query->orWhere('email', 'like', '%' . $text . '%')
                     ->orWhere('email', 'like', '%' . $text)
                     ->orWhere('email', 'like', $text . '%');
    }

    /**
     * Filtra la consulta solo para usuarios que hayan respondido la encuesta con las condiciones indicadas
     *
     * @method     scopeByAnswered
     *
     *
     * @param      object           $query    Objeto con la consulta
     * @param      array            $filters  Arreglo con las opciones a filtrar
     *
     * @return     object           Objeto con la consulta filtrada
     */
    public function scopeByAnswered($query, $filters)
    {
        return $query->whereHas('sellerAnsweredSurveys', function ($q) use ($filters) {
            $index = 0;
            foreach ($filters as $filter) {
                $condition = ['question_id' => $filter['question_id'], 'option_index' => $filter['option_index']];
                if ($index === 0) {
                    $q->where($condition);
                    $index++;
                } else {
                    $q->orWhere($condition);
                }
            }
            return $q;
        });
    }

    public static function getAnsweredAnios($user_id, $question_id)
    {
        $sellerAnswer=SellerAnsweredSurvey::where('user_id', (int)$user_id)
                                            ->where('question_id', (int)$question_id)
                                            ->get();

        $result='';
        $option_index='';
        foreach ($sellerAnswer as $seller) {
            $result=$seller->user_id;
            $option_index=$seller->option_index;
        }

        // if($option_index==''){
        //     return 'Por completar en el perfil';
        // }

        if (isset($result) && $result == $user_id) {
            $answered=Question::where('id', $question_id)->value('options');
            $answered=ltrim($answered, '[');
            $answered=rtrim($answered, ']');
            $answered=str_replace('\u00f1', 'ñ', $answered);
            $answered=str_replace('\u00e1', 'á', $answered);
            $answered_string=str_replace('"', '', $answered);

            $answeredArray=explode(',', $answered_string);
            $respuesta='';
            foreach ($answeredArray as $i => $answer) {
                if ($i==$option_index) {
                    $respuesta=$answer;
                }
            }
        } else {
            $respuesta="Sin respuesta registrada en el perfil";
        }
        return $respuesta;
    }

    public static function getExperiencie($user_id, $question_id)
    {
        $sellerAnswer=SellerAnsweredSurvey::where('user_id', (int)$user_id)
                                            ->where('question_id', (int)$question_id)
                                            ->get();

        $result='';
        $option_index='';
        foreach ($sellerAnswer as $seller) {
            $result=$seller->user_id;
            $option_index=$seller->option_index;
        }

        if (isset($result) && $result == $user_id) {
            $answered=Question::where('id', $question_id)->value('options');
            $answered=ltrim($answered, '[');
            $answered=rtrim($answered, ']');
            $answered=str_replace('"', '', $answered);
            $answered=str_replace('\u00e9', 'é', $answered);
            $answered_string=str_replace('\u00ed', 'í', $answered);

            $answeredArray=explode(',', $answered_string);
            $respuesta='';
            foreach ($answeredArray as $i => $answer) {
                if ($i==$option_index) {
                    $respuesta=$answer;
                }
            }
        } else {
            $respuesta="Sin respuesta registrada en el perfil";
        }
        return $respuesta;
    }

    public static function getDisponibilidad($user_id, $question_id)
    {
        $sellerAnswer=SellerAnsweredSurvey::where('user_id', (int)$user_id)
                                            ->where('question_id', (int)$question_id)
                                            ->get();
        $result='';
        $option_index='';
        foreach ($sellerAnswer as $seller) {
            $result=$seller->user_id;
            $option_index=$seller->option_index;
        }


        if (isset($result) && $result == $user_id) {
            $answered=Question::where('id', $question_id)->value('options');
            $answered=ltrim($answered, '[');
            $answered=rtrim($answered, ']');
            $answered=str_replace('"', '', $answered);
            $answered_string=str_replace('\u00f1', 'ñ', $answered);
            $answeredArray=explode(',', $answered_string);
            $respuesta='';
            foreach ($answeredArray as $i => $answer) {
                if ($i==$option_index) {
                    $respuesta=$answer;
                }
            }
        } else {
            $respuesta="Sin respuesta registrada en el perfil";
        }
        return $respuesta;
    }

    public static function getTipoColaboration($user_id, $question_id)
    {
        $sellerAnswer=SellerAnsweredSurvey::where('user_id', (int)$user_id)
                                            ->where('question_id', (int)$question_id)
                                            ->get();

        $result='';
        $option_index='';
        foreach ($sellerAnswer as $seller) {
            $result=$seller->user_id;
            $option_index=$seller->option_index;
        }

        if (isset($result) && $result == $user_id) {
            $answered=Question::where('id', $question_id)->value('options');
            $answered=ltrim($answered, '[');
            $answered=rtrim($answered, ']');
            $answered=str_replace('"', '', $answered);
            $answered=str_replace('\u00f1', 'ñ', $answered);
            $anios_string=str_replace('\u00f3', 'ó', $answered);
            $answeredArray=explode(',', $anios_string);
            $respuesta='';
            foreach ($answeredArray as $i => $answer) {
                if ($i==$option_index) {
                    $respuesta=$answer;
                }
            }
        } else {
            $respuesta="Sin respuesta registrada en el perfil";
        }
        return $respuesta;
    }
}
