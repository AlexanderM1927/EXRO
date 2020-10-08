<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'reports';
    
    protected $fillable = [
        'idingeniero', 'idproyecto', 'fecha'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}