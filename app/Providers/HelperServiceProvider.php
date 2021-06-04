<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Pages;
use App\Listing;
use App\User;
use Illuminate\Support\Facades\DB;


class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public static function getFooterContent($var=''){
        return $pages = Pages::where(['enabled' => true])
            ->orderBy('sequence', 'asc')
            ->get();
    }

    public static function getTotalAdvertisements(){
        $getTotalAdvertisements = DB::table('listing')->count();
        return $getTotalAdvertisements;
    }
    public static function getTotalRegisteredUsers(){
        $getTotalRegisteredUsers = DB::table('users')->count();
        return $getTotalRegisteredUsers;
    }
    public static function getListingMainImage($images){
        if(count($images)){
            return asset('uploads/listings/photos/'.$images[0]['name']);
        }
        return "https://i.ibb.co/mBN3H5c/alt-Image-For-Advert.jpg";
        //return 'https://dummyimage.com/600x400/000/fff';
    }
    public static function formatItemName($var){
        return ucfirst(str_replace('-',' ',$var));
    }
    public static function lowerLetter($var)
    {
        return strtolower(str_replace('-',' ',$var));
    }
    public static function getCountryFlag($var)
    {
      $country = strtolower($var);

        if($var=='Australia')
          $setFlag = asset('img/country/australia.png');
        else if(strpos($var, 'Switzerland') !== false)
          $setFlag = asset('img/country/switzerland.png');
        else if(strpos($var, 'Emirates') !== false)
          $setFlag = asset('img/country/united_arab_emirates.png');
        else if(strpos($var, 'Austria') !== false)
          $setFlag = asset('img/country/austria.png');
        else if(strpos($var, 'Portugal') !== false)
          $setFlag = asset('img/country/portugal.png');
        else if(strpos($var, 'United States') !== false)
          $setFlag = asset('img/country/united_states.png');
        else if(strpos($var,'Netherlands') !== false)
          $setFlag = asset('img/country/netherlands.png');
        else if(strpos($var,'Sweden') !== false)
          $setFlag = asset('img/country/sweden.png');
        else if(strpos($var, 'Spain') !== false)
          $setFlag = asset('img/country/spain.png');
        else if(strpos($var, 'France') !== false)
          $setFlag = asset('img/country/france.png');
        else if(strpos($var, 'Belgium') !== false)
          $setFlag = asset('img/country/belgium.png');
        else if(strpos($var, 'New Zealand') !== false)
          $setFlag = asset('img/country/newzealand.png');
        else if(strpos($var, 'Italy') !== false)
          $setFlag = asset('img/country/italy.png');
        else if(strpos($var, 'Germany') !== false)
          $setFlag = asset('img/country/germany.png');
        else if(strpos($var, 'United Kingdom') !== false)
          $setFlag = asset('img/country/united_kingdom.png');

        else if(strpos($country, 'india') !== false){
          $setFlag = asset('img/country/india.png');
        }
        else if(strpos($country, 'brazil') !== false)
          $setFlag = asset('img/country/brazil.png');
        else if(strpos($country, 'canada') !== false)
          $setFlag = asset('img/country/canada.png');
        else if(strpos($country, 'finland') !== false)
          $setFlag = asset('img/country/finland.png');
        else if(strpos($country, 'denmark') !== false)
          $setFlag = asset('img/country/denmark.png');
        else if(strpos($country, 'hong') !== false)
          $setFlag = asset('img/country/hong.png');

        else if(strpos($country, 'japan') !== false)
          $setFlag = asset('img/country/japan.png');
        else if(strpos($country, 'monaco') !== false)
          $setFlag = asset('img/country/monaco.png');
        else if(strpos($country, 'ukraine') !== false)
          $setFlag = asset('img/country/ukraine.png');
        else if(strpos($country, 'emirates') !== false)
          $setFlag = asset('img/country/unitedarabemirates.png');
        else if(strpos($country, 'czech') !== false)
          $setFlag = asset('img/country/czech.png');
        else if(strpos($country, 'luxembourg') !== false)
          $setFlag = asset('img/country/luxembourg.png');

        else {
          $url = 'img/country/flag.png';
          $setFlag = asset($url);
        }

        return $setFlag;
    }

}
