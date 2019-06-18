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

        

        // Get
        Route::get('{id}', 'OffersController@get')->name('get');

    });

    // Rating
    Route::group(['prefix' => 'rating'], function () {
        Route::get('user/{id}/avg', 'RatingController@getAvgRating');
    });

    Route::get('rate/{coin}/{currency}', function ($coin, $currency) {
        return 1 / get_convert (1, $coin, $currency);
    });

    Route::get('rate/all', function() {
        return [
            'btcUSD' => 1 / get_convert(1, 'btc', 'usd'),
            'btcNGN' => 1 / get_convert(1, 'btc', 'ngn'),
            'ltcNGN' => 1 / get_convert(1, 'ltc', 'ngn'),
            'ltcUSD' => 1 / get_convert(1, 'ltc', 'usd'),
            'dashNGN' => 1 / get_convert(1, 'dash', 'ngn'),
            'dashUSD' => 1 / get_convert(1, 'dash', 'usd'),
        ];
    });
});

Route::get('/docs', function () {
    return view('api');
});
