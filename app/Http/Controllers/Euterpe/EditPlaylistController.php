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
use App\Models\Music;
use App\Models\Playlist;
use App\Repositories\AlbumRepository;
use App\Validators\AlbumValidator;
use App\Validators\MusicValidator;
use App\Validators\ValidationException;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Validator;
use \Prettus\Validator\LaravelValidator;
use Image;
/**
 * Class AlbumsController.
 *
 * @package namespace App\Http\Controllers;
 */
class EditPlaylistController extends Controller
{
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
 
}