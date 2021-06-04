<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
    protected $primaryKey = 'userID';


    protected $fillable = [
        'type',
        'firstName',
        'lastName',
        'businessName',
        'mobileNumber',
        'phoneNumber',
        'street',
        'street2',
        'town',
        'country',
        'postCode',
        'vatNumber',
        'website',
        'currency',
        'description',
        'specialism',
        'weSpeak',
        'logo',
        'facebook',
        'twitter',
        'instagram',
        'email',
        'email_verified_at',
        'validationToken',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function listings()
    {
        return $this->hasMany('App\Listing', 'userID');
    }
}
