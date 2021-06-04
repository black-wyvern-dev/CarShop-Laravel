<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Banners extends Authenticatable
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
    protected $primaryKey = 'bannerID';
    protected $table = 'banners';

    protected $pageMap = [
        1 => 'Listing page',
        2 => 'Search page',
        3 => 'Home page',
    ];

    protected $fillable = [
        'page',
        'name',
        'image',
        'link',
    ];

}
