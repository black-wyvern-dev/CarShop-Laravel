<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AdvertPackage extends Model
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
    protected $primaryKey = 'advertPackageID';
    protected $table = 'advertPackage';

    protected $fillable = [
        'name',
        'price',
        'advertsNumber',
        'period',
    ];



}
