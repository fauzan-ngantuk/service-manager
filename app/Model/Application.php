<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public $table = 'application';

    protected $primaryKey = 'id';

    public $fillable = [
        'name'
    ];
}
