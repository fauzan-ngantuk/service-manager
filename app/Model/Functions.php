<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Functions extends Model
{
    public $table = 'function';

    protected $primaryKey = 'id';

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public $fillable = [
        'id_aplication',
        'code',
        'name'
    ];
}
