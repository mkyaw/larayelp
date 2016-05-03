<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;


use App\Http\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class PlaceController extends Controller
{
    
    public function index(Request $request)
    {
        // YELP API STUFF
        $stack = HandlerStack::create();

        $middleware = new Oauth1([
            'consumer_key'    => env('YELP_CONS_KEY'),
            'consumer_secret' => env('YELP_CONS_SEC'),
            'token'           => env('YELP_TOKEN'),
            'token_secret'    => env('YELP_TOKEN_SEC')
        ]);

        $stack->push($middleware);

        $client = new Client([
            'base_uri' => 'https://api.yelp.com',
            'handler' => $stack
        ]);

        $cuisine = Request::get('cuisine');
        $zip = Request::get('zip');

        
        // echo $cuisine . " <= Cuisine | Zip => " . $zip;

        $cuisine == '' ? $cuisine = 'American' : $cuisine;
        $zip == '' ? $zip = '90034' : $zip;

        $inputs = array($cuisine => $zip);
        
        $res_string = '/v2/search/?term='.$cuisine.'&location='.$zip.'&limit=5';
        // echo $res_string;
        $res = $client->get($res_string, ['auth' => 'oauth']);
        $places = json_decode($res->getBody(), true)['businesses'];
        return view('places.index', compact('places', 'inputs'));
    }
}
