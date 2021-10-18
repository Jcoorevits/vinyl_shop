<?php

use App\Genre;
use App\Record;
use App\User;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});
route::view('/', 'home');

Route::view('contact-us', 'contact'); // Get is functie, view is static?
Route::prefix('admin')->group(function () {
    route::redirect('/', '/admin/records');
    Route::get('records', 'Admin\RecordController@index');
});

//ter illustartie
Route::prefix('api')->group(function () {
    Route::get('users', function (){
        return User::get();
    });
    Route::get('records', function (){
        return Record::with('genre')->get();
    });
    Route::get('genres', function (){
        return Genre::with('records')->get();
    });
});
