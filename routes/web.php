<?php

use App\Http\Controllers\AlbumController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//Route::resource('/albums', AlbumController::class);
Route::prefix('albums')->middleware('auth')->namespace('App\Http\Controllers')->group(function (){
    Route::get('','AlbumController@index')->name('albums.index');
    Route::get('/create','AlbumController@create')->name('albums.create');
    Route::post('/store','AlbumController@store')->name('albums.store');
    Route::get('/edit/{id}','AlbumController@edit')->name('albums.edit');
    Route::post('/update/{id}','AlbumController@update')->name('albums.update');
    Route::post('/delete/{id}','AlbumController@destroy')->name('albums.destroy');
    Route::get('/show/{id}','AlbumController@show')->name('albums.show');
    Route::post('/remove/{id}','AlbumController@removeImages')->name('albums.remove');

});

Route::post('albums/{album}/upload', [AlbumController::class, 'upload'])->name('album.upload')->middleware('auth');

Route::get('/albums/{album}/image/{image}', [AlbumController::class, 'showImage'])->name('album.image.show');

Route::delete('/albums/{album}/image/{image}', [AlbumController::class, 'destroyImage'])->name('album.image.destroy');
