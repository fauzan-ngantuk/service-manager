<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FunctionToken extends Model
{
    use SoftDeletes;
    
    public $table = 'function_token';

    protected $primaryKey = 'id';

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public $fillable = [
        'id_token',
        'id_function'
    ];

    public function function()
    {
        return $this->hasOne('App\Model\Functions', 'id', 'id_function');
    }
}
