<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EngineersProjects extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'engineers_projects';
    
    protected $fillable = [
        'idingeniero', 'idproyecto'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}