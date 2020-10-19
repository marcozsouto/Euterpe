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

Route::get('/',['uses' => 'Controller@welcomepage'])->name("welcome");

//auth routes
Route::get('/login', ['uses' => 'Controller@form_login'])->name("login");
Route::post('/login', ['uses' => 'AuthController@login'])->name("login.do");

Route::get('/signup', ['uses' => 'Controller@form_signup'])->name("signup");
Route::post('/signup', ['uses' => 'AuthController@signup'])->name("signup.do");

Route::get('/logout', ['uses' => 'AuthController@logout'])->name("logout");

//admin routes
Route::get('/euterpe', ['uses' => 'Euterpe\EuterpeController@home'])->name("euterpe");
Route::get('euterpe/playlist_image/{id}', ['uses' => 'Euterpe\EuterpeController@playlist_image']);
Route::get('euterpe/album_image/{id}', ['uses' => 'Euterpe\EuterpeController@album_image']);
Route::get('euterpe/artist_icon/{id}', ['uses' => 'Euterpe\EuterpeController@artist_icon']);
Route::get('euterpe/artist_cover/{id}', ['uses' => 'Euterpe\EuterpeController@artist_cover']);


//admin album crud
Route::get('euterpe/album',['uses' => 'Euterpe\AlbumController@form_album'])->name("euterpe.album");
    //create
Route::get('euterpe/album/new',['uses' => 'Euterpe\AlbumController@form_album_new'])->name("euterpe.album.new");
Route::post('euterpe/album/new',['uses' => 'Euterpe\AlbumController@create'])->name("euterpe.album.new.do");
    //edit
Route::get('euterpe/album/edit/{id}',['uses' => 'Euterpe\AlbumController@form_album_edit'])->name("euterpe.album.edit");
Route::post('euterpe/album/edit',['uses' => 'Euterpe\AlbumController@edit'])->name("euterpe.album.edit.do");
    //search
Route::get('euterpe/album/search', 'Euterpe\AlbumController@action')->name('euterpe.album.search.do');
    //delete
Route::get('euterpe/album/delete/{id}',['uses' => 'Euterpe\AlbumController@delete'])->name("euterpe.album.delete");


//admin artist crud
Route::get('euterpe/artist',['uses' => 'Euterpe\ArtistController@form_artist'])->name("euterpe.artist");
    //create
Route::get('euterpe/artist/new',['uses' => 'Euterpe\ArtistController@form_artist_new'])->name("euterpe.artist.new");
Route::post('euterpe/artist/new',['uses' => 'Euterpe\ArtistController@create'])->name("euterpe.artist.new.do");
    //edit
Route::get('euterpe/artist/edit/{id}',['uses' => 'Euterpe\ArtistController@form_artist_edit'])->name("euterpe.artist.edit");
Route::post('euterpe/artist/edit',['uses' => 'Euterpe\ArtistController@edit'])->name("euterpe.artist.edit.do");
    //search
Route::get('euterpe/artist/search', 'Euterpe\ArtistController@action')->name('euterpe.artist.search.do');
    //delete
Route::get('euterpe/artist/delete/{id}',['uses' => 'Euterpe\ArtistController@delete'])->name("euterpe.artist.delete");

//admin playlist crud
Route::get('euterpe/playlist',['uses' => 'Euterpe\PlaylistController@form_euterpe_playlist'])->name("euterpe.playlist");
    //create
Route::get('euterpe/playlist/new',['uses' => 'Euterpe\PlaylistController@form_euterpe_playlist_new'])->name("euterpe.playlist.new");
Route::post('euterpe/playlist/new',['uses' => 'Euterpe\PlaylistController@create'])->name("euterpe.playlist.new.do");
    //edit
Route::get('euterpe/playlist/edit/{id}',['uses' => 'Euterpe\PlaylistController@form_playlist_edit'])->name("euterpe.playlist.edit");
Route::post('euterpe/playlist/edit',['uses' => 'Euterpe\PLaylistController@edit'])->name("euterpe.playlist.edit.do");

//admin search music
Route::get('euterpe/music/search', 'Euterpe\MusicController@action')->name('euterpe.music.search.do');


