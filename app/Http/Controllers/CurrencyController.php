<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{


    public function index()
    {
        $url            = "http://apilayer.net/api/live?access_key=" . env('CURRENCY_LAYER');
        $client         = new Client();
        $response       = $client->get($url);

        $response       = json_decode($client->get($url)->getBody(), true);
        $data           = [];

        foreach ($response['quotes'] as $key => $value){
            $currency            = Currency::updateOrCreate([
                'name'  => ltrim($key, 'USD'),
                'rate'  => $value,
            ]);
        }
    }
}
