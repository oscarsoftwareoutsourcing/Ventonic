<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Invitation;

class InvitationRule implements Rule
{
    protected $groupId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($groupId)
    {
        $this->groupId = $groupId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Invitation::where(['group_id' => $this->groupId, 'email' => $value])->get()->isEmpty();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ya se encuentra registrada una invitación con el correo electrónico indicado';
    }
}
