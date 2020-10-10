<?php

namespace App\Http\Controllers\Euterpe;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\playlistCreateRequest;
use App\Http\Requests\playlistUpdateRequest;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Playlist;
use App\Models\Music;
use App\Repositories\playlistRepository;
use App\Validators\playlistValidator;
use App\Validators\MusicValidator;
use App\Validators\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Validator;
use \Prettus\Validator\LaravelValidator;
use Image;
/**
 * Class playlistsController.
 *
 * @package namespace App\Http\Controllers;
 */
class EuterpeController extends Controller
{
    function home(){
        $this->authorize("create", User::class);
        $albums  = Album::all();
        $artists = Artist::all();
        $playlists = Playlist::where('user_id',Auth::user()->id)->get();
        return view('euterpe.home',['albums' => $albums, 'artists'=> $artists, 'playlists' => $playlists]);
    }

    function playlist_image($id){
        $this->authorize("create", User::class);
        $data = Playlist::find($id);
        $image = Image::make($data->icon);
        $response = Response::make($image->encode('jpeg'));
        $response->header('Content-Type', 'image/jpeg');
        return $response;
    }

    function album_image($id){
        $this->authorize("create", User::class);
        $data = Album::find($id);
        $image = Image::make($data->icon);
        $response = Response::make($image->encode('jpeg'));
        $response->header('Content-Type', 'image/jpeg');
        return $response;
    }

    function artist_image($id){
        $this->authorize("create", User::class);
        $data = Artist::find($id);
        $image = Image::make($data->icon);
        $response = Response::make($image->encode('jpeg'));
        $response->header('Content-Type', 'image/jpeg');
        return $response;
    }

}