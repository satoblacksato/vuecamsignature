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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware('auth')->post('/upload-data','HomeController@saveData');
Route::get('user-avatar/{id}', function ($id) {
    $user=\App\User::findOrFail($id);
     return response()->make($user->avatar, 200, array( 'Content-Type' => (new finfo(FILEINFO_MIME))->buffer($user->avatar) ));
});
Route::get('user-signature/{id}', function ($id) {
    $user=\App\User::findOrFail($id);
    return response()->make($user->signature, 200, array( 'Content-Type' => (new finfo(FILEINFO_MIME))->buffer($user->signature) ));
});
