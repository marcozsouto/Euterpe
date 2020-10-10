<?php

namespace App\Http\Controllers\Euterpe;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\playlistCreateRequest;
use App\Http\Requests\playlistUpdateRequest;
use App\Models\playlist;
use App\Models\Music;
use App\Repositories\playlistRepository;
use App\Validators\playlistValidator;
use App\Validators\MusicValidator;
use App\Validators\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use \Prettus\Validator\LaravelValidator;
use Image;
use Illuminate\Support\Facades\Response;

/**
 * Class playlistsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CreatePlaylistController extends Controller
{
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