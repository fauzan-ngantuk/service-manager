<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FunctionToken extends Model
{
    public $table = 'function_token';

    protected $primaryKey = 'id';

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public $fillable = [
        'id_token',
        'id_function'
    ];

    public function function_token()
    {
        return $this->hasOne('App\Model\Functions', 'id', 'id_function');
    }
}
