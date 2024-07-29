<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//users
Route::prefix('/driver')->group( function() {
    Route::post('/login', 'api\v1\LoginController@login');
    Route::middleware('auth:api')->get('/all', 'api\v1\driver\DriverController@index');
    Route::middleware('auth:api')->get('/driverById/{id}', 'api\v1\driver\DriverController@driverById');
    Route::middleware('auth:api')->get('/loriById/{id}/{driver_id}', 'api\v1\driver\DriverController@loriById');
    Route::middleware('auth:api')->post('/add', 'api\v1\driver\DriverController@store');
    Route::middleware('auth:api')->post('/addLori/{driver_id}', 'api\v1\driver\DriverController@storeLori'); //add lori
    Route::middleware('auth:api')->put('/update/{id}', 'api\v1\driver\DriverController@update'); //update driver
    Route::middleware('auth:api')->put('/updatelori/{driver_id}/{lori_id}', 'api\v1\driver\DriverController@updateLori'); //update lori
    Route::middleware('auth:api')->delete('/deleteDriver/{id}', 'api\v1\driver\DriverController@destroyDriver'); //delete by id
    Route::middleware('auth:api')->delete('/deleteLori/{id}/{driver_id}', 'api\v1\driver\DriverController@destroyLori');//delete by id
    
});
