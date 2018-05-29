<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    use SoftDeletes;
    
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
