<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValuesVariable extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'values_variables';
    
    protected $fillable = [
        'idreport', 'idvariablesprojects', 'valor'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}