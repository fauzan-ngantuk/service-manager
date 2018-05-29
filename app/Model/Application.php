<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;
    
    public $table = 'application';

    protected $primaryKey = 'id';

    public $fillable = [
        'name'
    ];
}
