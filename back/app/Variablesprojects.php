<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VariablesProjects extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'variablesprojects';
    
    protected $fillable = [
        'idproyecto', 'idVariable', 'max', 'min', 'razon_outrange'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}