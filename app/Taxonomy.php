<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Taxonomy extends Authenticatable
{


    /**
     *  Table PK
     *
     * @var string
     */
    protected $primaryKey = 'taxonomyID';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'taxonomies';


    protected $fillable = [
        'termID',
        'taxonomy',
        'parent',
    ];


    public function terms()
    {
        return $this->hasMany('App\Term','termID');
    }


}
