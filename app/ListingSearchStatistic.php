<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ListingSearchStatistic extends Model
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
    protected $primaryKey = 'listingSearchStatisticID';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'listingSearchStatistic';


    protected $fillable = [
        'terms',
        'make',
        'model',
        'body'
    ];

}
