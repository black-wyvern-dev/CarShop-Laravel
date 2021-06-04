<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pages extends Authenticatable
{
    protected $table = 'pages';

    /**
     *  Table PK
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'title',
        'description',
        'sequence',
        'enabled',
    ];
}
