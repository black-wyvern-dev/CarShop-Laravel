<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class TermMeta extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    /**
     *  Table PK
     *
     * @var string
     */
    protected $primaryKey = 'termMetaID';
    protected $table = 'termMeta';


    protected $fillable = [
        'termID',
        'name',
        'value',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
