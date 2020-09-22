<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'projects';
    
    protected $fillable = [
        'name', 'descripcion', 'idCliente'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}