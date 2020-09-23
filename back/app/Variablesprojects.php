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
        'idProject', 'idVariable', 'max', 'min'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}