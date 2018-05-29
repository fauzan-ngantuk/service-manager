<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Token extends Model
{
    use SoftDeletes;
    
    public $table = 'token';

    protected $primaryKey = 'id';

    protected $hidden = ['token', 'created_at', 'updated_at', 'deleted_at'];

    public $fillable = [
        'id_user',
        'token',
        'expired_at',
        'limit',
        'accessed'
    ];

    public function function_token()
    {
        return $this->hasMany('App\Model\FunctionToken', 'id_token', 'id')->with('function');
    }

    public function user()
    {
        return $this->hasOne('App\Model\Users', 'id', 'id_user');
    }
}
