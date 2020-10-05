<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/',['uses' => 'Controller@homepage'])->name("home");

Route::get('/login', ['uses' => 'Controller@form_login'])->name("login");
Route::post('/login', ['uses' => 'AuthController@login'])->name("login.do");

Route::get('/signup', ['uses' => 'Controller@form_signup'])->name("signup");
Route::post('/signup', ['uses' => 'AuthController@signup'])->name("signup.do");

Route::get('/logout', ['uses' => 'AuthController@logout'])->name("logout");

//admin routes
Route::get('/euterpe', ['uses' => 'Controller@euterpe_dashboard'])->name("euterpe");


Route::get('euterpe/album/new',['uses' => 'Controller@form_album'])->name("euterpe.album.new");
Route::post('euterpe/album/new',['uses' => 'Admin\CreateAlbumController@create'])->name("euterpe.album.new.do");

Route::get('euterpe/artist/new',['uses' => 'Controller@form_artist'])->name("euterpe.artist.new");
Route::post('euterpe/artist/new',['uses' => 'Admin\CreateArtistController@create'])->name("euterpe.artist.new.do");

Route::get('euterpe/playlist/new',['uses' => 'Controller@form_euterpe_playlist'])->name("euterpe.playlist.new");
Route::post('euterpe/playlist/new',['uses' => 'Admin\CreatePlaylistController@create_euterpe'])->name("euterpe.playlist.new.do");

