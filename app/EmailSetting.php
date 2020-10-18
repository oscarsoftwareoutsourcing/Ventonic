<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailSetting extends Model
{
    protected $fillable = [
        'name', 'incoming_server_host', 'incoming_server_port', 'outgoing_server_host', 'outgoing_server_port',
        'protocol', 'encryption', 'validate_cert', 'email', 'username', 'password', 'download_time', 'user_id'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * EmailSetting belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * EmailSetting has many EmailMessage.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emailMessage()
    {
        return $this->hasMany(EmailMessage::class);
    }
}
