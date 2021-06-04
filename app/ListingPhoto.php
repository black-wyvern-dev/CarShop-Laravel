<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ListingPhoto extends Model
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
    protected $primaryKey = 'listingPhotoID';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'listingPhoto';


    protected $fillable = [
        'listingID',
        'name',
    ];

    public function listing()
    {
        return $this->hasOne('App\Listing','listingID');
    }

}
