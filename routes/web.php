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
    //show album
Route::get('euterpe/album/{id}', ['uses' => 'Euterpe\AlbumController@show_album'])->name("euterpe.album.show");


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
    //show playlist
Route::get('euterpe/artist/{id}', ['uses' => 'Euterpe\ArtistController@show_artist'])->name("euterpe.artist.show"); 


//admin playlist crud
Route::get('euterpe/playlist',['uses' => 'Euterpe\PlaylistController@form_euterpe_playlist'])->name("euterpe.playlist");
    //create
Route::get('euterpe/playlist/new',['uses' => 'Euterpe\PlaylistController@form_euterpe_playlist_new'])->name("euterpe.playlist.new");
Route::post('euterpe/playlist/new',['uses' => 'Euterpe\PlaylistController@create'])->name("euterpe.playlist.new.do");
    //edit
Route::get('euterpe/playlist/edit/{id}',['uses' => 'Euterpe\PlaylistController@form_playlist_edit'])->name("euterpe.playlist.edit");
Route::post('euterpe/playlist/edit',['uses' => 'Euterpe\PlaylistController@edit'])->name("euterpe.playlist.edit.do");
    //search
Route::get('euterpe/playlist/search', 'Euterpe\PlaylistController@action')->name('euterpe.playlist.search.do');
    //delete
Route::get('euterpe/playlist/delete/{id}',['uses' => 'Euterpe\PlaylistController@delete'])->name("euterpe.playlist.delete");
    //ad_music_playlist
Route::get('euterpe/playlist/add/{playlist_id}/{song_id}',['uses' => 'Euterpe\PlaylistController@add_music'])->name("euterpe.playlist.add"); 
    //show playlist
Route::get('euterpe/playlist/{id}', ['uses' => 'Euterpe\PlaylistController@show_playlist'])->name("euterpe.playlist.show"); 
    //delete music from playlist
Route::get('euterpe/playlist/remove/{playlist_id}/{song_id}',['uses' => 'Euterpe\PlaylistController@remove_music'])->name("euterpe.playlist.remove");    
//admin search 
Route::get('euterpe/search', 'Euterpe\SearchController@action')->name('euterpe.search.do');


//USER ROUTES

    //home and side bar
Route::get('home', ['uses' => 'User\UserController@home'])->name("home");
Route::get('home/search', 'User\SearchController@action')->name('user.search.do');

    //user playlist
Route::get('home/playlist',['uses' => 'User\PlaylistController@form_user_playlist'])->name("user.playlist");
Route::get('home/playlist/new',['uses' => 'User\PlaylistController@form_user_playlist_new'])->name("user.playlist.new");
Route::post('home/playlist/new',['uses' => 'User\PlaylistController@create'])->name("user.playlist.new.do");
Route::get('home/playlist/edit/{id}',['uses' => 'User\PlaylistController@form_playlist_edit'])->name("user.playlist.edit");
Route::post('home/playlist/edit',['uses' => 'User\PlaylistController@edit'])->name("user.playlist.edit.do");
Route::get('home/playlist/search', 'User\PlaylistController@action')->name('user.playlist.search.do');
Route::get('home/playlist/delete/{id}',['uses' => 'User\PlaylistController@delete'])->name("user.playlist.delete");
Route::get('home/playlist/add/{playlist_id}/{song_id}',['uses' => 'User\PlaylistController@add_music'])->name("user.playlist.add"); 
Route::get('home/playlist/{id}', ['uses' => 'User\PlaylistController@show_playlist'])->name("user.playlist.show"); 
Route::get('home/playlist/remove/{playlist_id}/{song_id}',['uses' => 'User\PlaylistController@remove_music'])->name("user.playlist.remove");    
    //user artist
Route::get('home/artist',['uses' => 'User\ArtistController@form_artist'])->name("user.artist");
Route::get('home/artist/search', 'User\ArtistController@action')->name('user.artist.search.do');
Route::get('home/artist/{id}', ['uses' => 'User\ArtistController@show_artist'])->name("user.artist.show");
Route::get('home/artist/remove/{artist_id}',['uses' => 'User\ArtistController@remove_artist'])->name("user.artist.remove"); 
Route::get('home/artist/add/{artist_id}',['uses' => 'User\ArtistController@add_artist'])->name("user.artist.add"); 
    //user album
Route::get('home/album',['uses' => 'User\AlbumController@form_album'])->name("user.album");
Route::get('home/album/search', 'User\AlbumController@action')->name('user.album.search.do');
Route::get('home/album/{id}', ['uses' => 'User\AlbumController@show_album'])->name("user.album.show");
Route::get('home/album/remove/{album_id}',['uses' => 'User\AlbumController@remove_album'])->name("user.album.remove"); 
Route::get('home/album/add/{album_id}',['uses' => 'User\AlbumController@add_album'])->name("user.album.add"); 