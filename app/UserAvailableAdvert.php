<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserAvailableAdvert extends Model
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
    protected $primaryKey = 'UserAvailableAdvertID';
    protected $table = 'UserAvailableAdvert';

    protected $fillable = [
        'advertPackageID',
        'userID'
    ];

    /**
     *
     *
     * Relations
     *
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'userID');
    }
    public function advertPackage()
    {
        return $this->belongsTo('App\AdvertPackage', 'advertPackageID');
    }


}
