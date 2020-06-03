<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $with = ['sellerProfile', 'companyProfile'];
    protected $appends = ['filterable_seller', 'photo'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'type', 'status', 'password', 'last_login'
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

    public function getPhotoAttribute()
    {
        return ($this->sellerProfile!==null)
               ? ($this->sellerProfile->photo ?? '')
               : (($this->companyProfile!==null) ? ($this->companyProfile->photo ?? '') : '');
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
}
