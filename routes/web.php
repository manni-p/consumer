<?php

use Illuminate\Http\Request;

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

Route::get('/', function () {
    $query = http_build_query([
        'client_id' => '1',
        'redirect_uri' => 'http://consumer.nhs/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('http://laravel-passport.nhs/oauth/authorize?'.$query);
});

Route::get('/callback', function (Request $request) {

    $http = new GuzzleHttp\Client;

    $response = $http->post('http://laravel-passport.nhs/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '1',
            'client_secret' => 'OXm4jwrBtLSolOpr0RXCR3Coymjm8F5FTKqevf6s',
            'redirect_uri' => 'http://consumer.nhs/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});