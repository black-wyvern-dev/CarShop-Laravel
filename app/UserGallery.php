<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserGallery extends Authenticatable
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
    protected $primaryKey = 'userGalleryID';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'userGallery';


    protected $fillable = [
        'userID','name',
    ];


}
