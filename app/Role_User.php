<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_User extends Model
{

    protected $table = 'role_user';
    public $timestamps = true;

    protected $fillable = [
        'role_id', 'user_id',
    ];

    public function users()
    {
        return $this
            ->belongsToMany('App\User')
            ->withTimestamps();
    }

    public function roles()
    {
        return $this
            ->belongsToMany('App\Role')
            ->withTimestamps();
    }
}
