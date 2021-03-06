<?php
namespace App;

use App\GroupUser;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    protected $fillable = ['name', 'user_id'];

    public function groupUser()
    {
        return $this->hasMany('App\GroupUser');
    }

    public function invitation()
    {
        return $this->hasMany('App\Invitation');
    }

    /**
     * Group has many Negotiations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function negotiations()
    {
        return $this->belongsToMany(Negotiation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Group belongs to Contacts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contacts()
    {
        return $this->belongsToMany(Contacts::class);
    }

    public static function getUserByGroup($group_id)
    {
        $users_txt='';
        $users=GroupUser::where('group_id', $group_id)->get();
        foreach ($users as $usuario) {
            $users_txt.=$usuario->user->name.", ";
        }
        $usuarios=rtrim($users_txt, ', ');
        return $usuarios;
    }

    public static function getName($user_id)
    {
        $name=User::where('id', $user_id)->value('name');
        $apellido=User::where('id', $user_id)->value('last_name');
        $nombreCompleto=$name.' '.strtoUpper(substr($apellido, 0, 1));
        return $nombreCompleto;
    }
}
