<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public $table = 'users';

    protected $primaryKey = 'id';

    public $fillable = [
        'username',
        'password',
        'secret',
        'role',
        'application_grant'
    ];
}
