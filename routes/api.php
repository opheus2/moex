<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Offers
Route::group(['namespace' => 'Resources', 'middleware' => 'authorize.public_ip'], function () {

});

Route::group(['namespace' => 'Resources'], function () {
    //Offers
    Route::group(['prefix' => 'offers'], function (){
        // Buy
        Route::get('buy', 'OffersController@buy')->name('buy');

        // Sell
        Route::get('sell','OffersController@sell')->name('sell');

        Route::get('payment-methods', 'OffersController@getPaymentMethods')->name('payment-methods');

        Route::get('test-sell', 'OffersController@sellTest');

        Route::get('test-buy', 'OffersController@buyTest');

        // Get
        Route::get('{id}', 'OffersController@get')->name('get');

    });

    // Rating
    Route::group(['prefix' => 'rating'], function () {
        Route::get('user/{id}', 'RatingController@getAvgRating');
    });
    
    Route::get('rate/{coin}/{currency}', function ($coin, $currency) {
        return 1 / get_convert (1, $coin, $currency);
    });
});

