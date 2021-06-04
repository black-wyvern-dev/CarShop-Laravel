<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Admin routes
 */
Route::group(['prefix' => 'admin'], function () {
    Route::get('login', ['as' => 'adminLogin', 'uses' => 'AdminController@loginPage'] );
    Route::post('login', 'AdminController@postLogin');
    Route::group(['middleware' => 'admin'], function () {
        Route::get('exit', 'AdminController@logOut');
        Route::get('users', 'AdminController@users');
        Route::get('users/edit/{userID}','AdminController@editUsers');
        Route::post('users/edit/editUser', 'AdminController@updateUsers');
        Route::get('users/deleteUsers/{userID}', 'AdminController@deleteUsers');

        //change user type function
        Route::post('users/changeusertype', 'AdminController@changeUserType')->name('admin-change-user-type');


        Route::get('loginAs/{userID}','AdminController@loginAs');

        Route::get('makes', 'AdminController@makes');
        Route::post('makes/addMake', 'AdminController@addMake');
        Route::get('makes/delete/{type}/{termID}/',[
            'uses' => 'AdminController@deleteMakeModel',
            'as'   => 'deleteMakeModel'
        ]);
        Route::get('makes/edit/{termID}', 'AdminController@editMake');
        Route::post('makes/edit/editMake', 'AdminController@updateMake');
        Route::post('makes/edit/addModel', 'AdminController@addModel');
        Route::post('makes/edit/deleteModel', 'AdminController@deleteMakeModel');
        Route::get('makes/edit/{makeID}/delete/{type}/{termID}/',[
            'uses' => 'AdminController@deleteMakeModel',
            'as'   => 'deleteMakeModel'
        ]);

        Route::get('pages',                'AdminController@pages'      )->name('admin.pages');
        Route::get('pages/edit/{pageID}',  'AdminController@editPage'   )->name('admin.pages.edit');
        Route::post('pages/edit/editPage', 'AdminController@updatePages')->name('admin.pages.edit.post');;
        Route::post('pages/edit/upload',   'AdminController@uploadPages')->name('admin.pages.upload');;

        Route::get('banners', 'AdminController@banners');
        Route::get('banners/add', 'AdminController@addBanner');
        Route::get('banners/edit/{bannerID}', 'AdminController@editBanner');
        Route::post('banners/edit/editBanner', 'AdminController@updateBanner');
        Route::post('banners/addBanner', 'AdminController@postBanner');
        Route::post('banners/bannerUpload', 'AdminController@bannerUpload');
        Route::get('banners/deleteBanners/{bannerID}', 'AdminController@deleteBanners');


        /**
         * intervals 
         */
        Route::get('interval', 'AdminController@interval');
        Route::post('interval', 'AdminController@setInterval')->name('admin-set-interval');

        Route::get('listings', 'AdminController@listings');
        Route::get('listings/edit/{listingID}', 'AdminController@editListings');
        Route::post('listings/photoUpload', 'AdminController@photoUpload');
        Route::post('listings/getMakeModels', 'AdminController@getMakeModels');
        Route::post('listings/editListing', 'AdminController@editListing');
        Route::get('listings/deleteListing/{listingID}', 'AdminController@deleteListing');
        Route::get('home', ['uses' => 'AdminController@homePage']);
    });
});


Route::get('/search/{category}/{country?}/{make?}/{model?}/{yearFrom?}/{yearTo?}/{body?}/{search?}', 'CategoryController@getSearch');
Route::get('/', 'HomeController@index');
Route::post('/getMakeModels', 'HomeController@getMakeModels');
Route::post('/setPumpUp', 'ListingsController@setPumpUp');
Route::post('/getCountryMakesModels', 'HomeController@getCountryMakesModels');

Route::post('/search/getMakeModels', 'CategoryController@getMakeModels');
Route::post('/search/getCountryMakesModels', 'CategoryController@getCountryMakesModels');

Route::get('/boats', 'HomeController@getBoats');
Route::get('/motorbikes', 'HomeController@getMotorbikes');
Route::get('/mopeds', 'HomeController@getMopeds');
Route::get('/automobilia', 'HomeController@getAutomobila');
Route::get('/parts', 'HomeController@getParts');

Route::get('page/{name}','PageController@index')->name('pages');

/** @TODO cleanup after 2020-Jul-31 */
Route::redirect('/content/1',       '/page/advertisement-rates',  301);
Route::redirect('/content/2',       '/page/about-us',             301);
Route::redirect('/content/3',       '/page/contact-us',           301);
Route::redirect('/content/4',       '/page/car-restoration',      301);
Route::redirect('/content/6',       '/page/working-with-us',      301);
Route::redirect('/content/7',       '/page/terms-and-conditions', 301);
Route::redirect('/content/8',       '/page/insurance',            301);
Route::redirect('/rates',           '/page/advertisement-rates',  301);
Route::redirect('/about-us',        '/page/about-us',             301);
Route::redirect('/contact',         '/page/contact-us',           301);
Route::redirect('/car-restoration', '/page/car-restoration',      301);
Route::redirect('/working-with-us', '/page/working-with-us',      301);
Route::redirect('/conditions',      '/page/terms-and-conditions', 301);
Route::redirect('/insurance',       '/page/insurance',            301);

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/specialist/{userId}/{name?}', 'SpecialistsController@specialist')->name('specialist');
Route::get('/specialists', 'SpecialistsController@index')->name('specialists');
Route::post('/specialists/showNumber', 'SpecialistsController@showNumber')->name('showNumber');
Route::post('/register/private', 'Auth\RegisterController@createPrivate');
Route::post('/register/company', 'Auth\RegisterController@createCompany');
//Route::get('/listings/{category}/{id}/{make?}/{model?}', 'ListingsController@listing');
//Route::get('/listings/{category}/{id}/{model?}-{make?}-{year?}', 'ListingsController@listing');
Route::get('/listings/{category}/{id}/{make?}-{model?}-{modelType?}-{year?}', 'ListingsController@listing');

// Send Email to the Car Owner. 
Route::post('/sendEmailToSeller', 'HelpController@sendEmailToSeller')->name('send-email-to-seller');


Route::group(['middleware' => 'auth'], function () {
    //Email validation
    Route::get('/validate/email/{token?}','UserController@emailConfirmation')->name('user.email.validate');

    Route::get('/please-confirm-your-email','HelpController@emailConfirmation')->name('please-confirm-your-email');
    Route::post('/sendEmailConfirmation','HelpController@sendEmailConfirmation');

    //User routes
    Route::group(['prefix' => 'user'], function () {
        Route::post('/logo',         'UserController@logo'         )->name('user.logo.upload');
        Route::get ('/user-profile', 'UserController@userProfile'  )->name('user.profile');
        Route::post('/editProfile',  'UserController@updateProfile')->name('user.profile.edit');
        Route::post('/removeUser', 'UserController@removeUser')->name('user.profile.remove');

        Route::group(['middleware' => 'email'], function () {
            Route::get('advertise', 'AdvertiseController@index')->name('advertise');
            Route::get('create/{type}', 'AdvertiseController@create')->name('advertise.create');
            Route::get('create/{type}', 'AdvertiseController@create')->name('advertise.create');
            Route::post('create/saveAdvertise', 'AdvertiseController@saveAdvertise');
            Route::post('create/getMakeModels', 'AdvertiseController@getMakeModels');
            Route::post('create/photoUpload', 'AdvertiseController@photoUpload');
            Route::post('create/deletePhoto', 'AdvertiseController@deletePhoto');

            Route::get('listings', 'ListingsController@userListings')->name('listings');
            Route::get('listing/edit/{id}', 'ListingsController@editListing')->name('editListing');
            Route::post('listing/edit/getMakeModels', 'AdvertiseController@getMakeModels');
            Route::post('listing/edit/editListing', 'ListingsController@saveListing');
            Route::post('listing/edit/photoUpload', 'ListingsController@photoUpload');
            Route::post('listing/edit/deletePhoto', 'ListingsController@deletePhoto');
            Route::get('listings/deleteListing/{listingID}', 'ListingsController@deleteListing');


        });

        Route::get('packages', 'PaymentsController@index')->name('packages');
        Route::get('package-confirm/{type}/{packID}', 'PaymentsController@packageConfirm')->name('package-confirm');

        Route::post('payment/stripeDeposit/confirm', array(
            'as'=>'payment.stripeDeposit',
            'uses' => 'PaymentsController@stripeDepositCompleteCharge'));



        //Settings routes
        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', 'SettingsController@index')->name('settings');
            Route::post('/saveSettings', 'SettingsController@saveSettings');
            Route::post('/logoUpload', 'SettingsController@logoUpload');
            Route::post('/photoUpload', 'SettingsController@photoUpload');
            Route::post('/deletePhoto', 'SettingsController@deletePhoto');
        });
    });
});


