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
route::view('/', 'home'); // Get is functie, view is static

Route::get('shop', 'ShopController@index');
Route::get('shop/{id}', 'ShopController@show');
Route::get('itunes', 'ItunesController@index');
Route::get('contact-us', 'ContactUsController@show');
Route::post('contact-us', 'ContactUsController@sendEmail'); // post voor form!

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::redirect('/', '/admin/records');
    Route::resource('genres', 'Admin\GenreController');
    Route::resource('genres2', 'Admin\Genre2Controller', ['parameters' => ['genres2' => 'genre']]);
    Route::get('records', 'Admin\RecordController@index');
});
//ter illustartie
Route::prefix('api')->group(function () {
    Route::get('users', function () {
        return User::get();
    });
    Route::get('records', function () {
        return Record::with('genre')->get();
    });
    Route::get('genres', function () {
        return Genre::with('records')->get();
    });
});

Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::redirect('/', '/user/profile');
    Route::get('profile', 'User\ProfileController@edit');
    Route::post('profile', 'User\ProfileController@update');
    Route::get('password', 'User\PasswordController@edit');
    Route::post('password', 'User\PasswordController@update');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

