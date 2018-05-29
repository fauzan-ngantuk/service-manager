<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Functions extends Model
{
    use SoftDeletes;
    
    public $table = 'function';

    protected $primaryKey = 'id';

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public $fillable = [
        'id_aplication',
        'code',
        'name'
    ];

    public function application()
    {
        return $this->hasOne('App\Model\Application', 'id', 'id_application');
    }
}
