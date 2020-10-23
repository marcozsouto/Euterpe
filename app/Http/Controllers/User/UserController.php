<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AlbumCreateRequest;
use App\Http\Requests\AlbumUpdateRequest;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Music;
use App\Models\Playlist;
use App\Repositories\AlbumRepository;
use App\Validators\AlbumValidator;
use App\Validators\MusicValidator;
use App\Validators\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use \Prettus\Validator\LaravelValidator;
use Image;
/**
 * Class UserController.
 *
 * @package namespace App\Http\Controllers;
 */
class UserController extends Controller
{

    function home(){
        $this->authorize("isUserLogged", User::class);
        $albums  = Auth::user()->album;
        $artists = Auth::user()->artist;
        $playlists = Playlist::where('user_id','1')->get();
        return view('user.home',['albums' => $albums, 'artists'=> $artists, 'playlists' => $playlists]);
    }

}