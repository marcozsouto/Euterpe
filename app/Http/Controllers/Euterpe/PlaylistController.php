<?php

namespace App\Http\Controllers\Euterpe;
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
use Illuminate\Validation\Validator;
use \Prettus\Validator\LaravelValidator;
use Image;
/**
 * Class AlbumsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PlaylistController extends Controller
{
    function form_euterpe_playlist(){
        $this->authorize("create", User::class);
        $playlists = Playlist::where('user_id',Auth::user()->id)->get();
        return view('euterpe.playlist',['playlists' => $playlists]);
    }

    function form_playlist_edit($id){
        $this->authorize("create", User::class);
        $playlist = Playlist::find($id);
        return view('euterpe.editPlaylist',['playlist' => $playlist]);
        
    }

    public function edit(Request $request){
        $this->authorize("create", User::class);
        return dd($request);
        $playlist = Playlist::find($request->id);
        
                 
    }

    function form_euterpe_playlist_new(){
        $this->authorize("create", User::class);
        return view('euterpe.createPlaylist');
        
    }

    public function create(Request $request){
        try{    
            $this->authorize("create", User::class);
            
            //seting data
            $playlist = $request->all();
            $playlist['view'] = 0;
            $playlist['user_id'] = Auth::user()->id;

            //validating playlist data
            PlaylistValidator::validate($playlist);
            
            //creating image
            $icon = Image::make($playlist['icon']);
            Response::make($icon->encode('jpeg'));
            $playlist["icon"]  = $icon;
            
            //creating playlist
            Playlist::create($playlist);

        }catch(ValidationException $exception){
            return redirect('euterpe/playlist/new')->withErrors($exception->getValidator())->withInput();
        }

    }
 
}