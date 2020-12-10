<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'chats';
    
    protected $fillable = [
        'subject', 'message', 'type', 'idusuario'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}
