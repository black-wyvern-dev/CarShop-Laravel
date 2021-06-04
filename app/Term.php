<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Term extends Authenticatable
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
    protected $primaryKey = 'termID';
    protected $table = 'term';

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

}
