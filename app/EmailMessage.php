<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailMessage extends Model
{
    protected $fillable = [
        'message_id', 'message_nro', 'subject', 'references', 'message_at', 'from', 'to', 'cc', 'bcc', 'reply_to',
        'sender', 'read', 'folder_type', 'labels', 'body', 'email_setting_id'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * EmailMessage belongs to EmailSetting.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function emailSetting()
    {
        return $this->belongsTo(EmailSetting::class);
    }
}