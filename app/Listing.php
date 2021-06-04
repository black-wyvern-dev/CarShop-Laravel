<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
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
    protected $primaryKey = 'listingID';
    protected $table = 'listing';

    protected $fillable = [
        'userID',
        'type',
        'status',
        'name',
        'make',
        'model',
        'year',
        'modelType',
        'bodyType',
        'odometer','odometerType','customlabel',
        'fuelType',
        'engine',
        'transmission',
        'upholstery',
        'interiorColor',
        'exteriorColor',
        'steering',
        'vin',
        'price',
        'description',
        'photos',
        'video',
        'userCountry',
        'move_up',
        'views',
        'list_order_at',
    ];

    /**
     * Relations
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'userID');
    }

    public function listingPhotos()
    {
        return $this->hasMany('App\ListingPhoto', 'listingID');
    }

    /**
     * Item filter method
     *
     * @param $request
     * @return mixed
     */
    public static function searchForListings($query = [])
    {
        $listings =  Listing::where(function ($q) use ($query) {
                if(isset($query['country']) && $query['country'] != 'All') {
                    $q->where('userCountry', '=', $query['country']);
                }
                if(isset($query['make']) && $query['make'] != 'All') {
                    $q->where('make', '=', $query['make']);
                }
                if(isset($query['model']) && $query['model'] != 'All') {
                    $q->where('model', '=', $query['model']);
                }
                if(isset($query['yearFrom']) && $query['yearFrom'] != 'All') {
                    $q->where('year', '>=', $query['yearFrom']);
                }
                if(isset($query['yearTo']) && $query['yearTo'] != 'All') {
                    $q->where('year', '<=', $query['yearTo']);
                }
                if(isset($query['body']) && $query['body'] != 'All') {
                    $q->where('bodyType','=', $query['body']);
                }
                if(isset($query['userId']) && $query['userId'] > 0) {
                    $q->where('userID','=', $query['userId']);
                }
            })
            ->where(function ($q) use ($query){
                if(isset($query['search']) && !empty($query['search'])){
                    $q->where('name', 'like', '%'.$query['search'].'%');
                    $q->orWhere('description', 'like', '%' . $query['search'] . '%');
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(18);
            // Logging the search term statistic

            ListingSearchStatistic::create([
                'terms'=>$query['search'],
                'make'=>$query['make'],
                'model'=>$query['model'],
                'body'=>$query['body'],
            ]);


        return $listings;

    }


}
