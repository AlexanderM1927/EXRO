<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppLog extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'logs';
    
    protected $fillable = [
        'user_id', 'type', 'action'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}