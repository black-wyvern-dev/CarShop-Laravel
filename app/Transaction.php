<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Transaction extends Model
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
    protected $primaryKey = 'transictionID';
    protected $table = 'transiction';

    protected $fillable = [
        'advertPackageID',
        'userID',
        'status',
        'sum',
        'paypalTransactionID',
        'stripeTransactionID',
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
