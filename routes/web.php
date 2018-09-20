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
        'redirect_uri' => 'http://www.topcatclients.com/consumer/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('http://www.topcatclients.com/technical-task/oauth/authorize?'.$query);
});

Route::get('/callback', function (Request $request) {

    $http = new GuzzleHttp\Client;

    $response = $http->post('http://www.topcatclients.com/technical-task/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '1',
            'client_secret' => '5q968WcpFvBMPzYHv0WOk50xnlfcEUEFgntlNURg	',
            'redirect_uri' => 'http://www.topcatclients.com/consumer/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});