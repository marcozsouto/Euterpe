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
use App\Models\User;
use App\Repositories\AlbumRepository;
use App\Validators\AlbumValidator;
use App\Validators\MusicValidator;
use App\Validators\ValidationException;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use \Prettus\Validator\LaravelValidator;
use Image;
/**
 * Class AlbumsController.
 *
 * @package namespace App\Http\Controllers;
 */
class AlbumController extends Controller
{

    public function remove_album($album_id){  
        $this->authorize("isUserLogged", User::class);
        $album = Album::find($album_id);
    
        
        Auth::user()->album = $album;
        Auth::user()->album()->detach($album->id);
   
    }

    function add_album($id){
        try{
            $this->authorize("isUserLogged", User::class);
            $album = Album::find($id);

            foreach(Auth::user()->album as $p_album){
                if($p_album->id == $album->id)
                    throw new Exception("Error on playlist validation");
            }

            Auth::user()->album = $album;
            Auth::user()->album()->attach($album->id);
           
            Redirect::back();
        }catch(Exception $exception){
            return  Redirect::back();
        }   
    }



    function show_album($id){
        $this->authorize("isUserLogged", User::class);
        $album = Album::find($id);
        $playlist = Auth::user()->playlist;
        return view('user.showAlbum',['album' => $album,'playlists' => $playlist]);
    }

    function action(Request $request){
     
        if($request->ajax()){
            $output = '';
            $query = $request->get('query');

        if($query != ''){
            $data = User::whereHas('album', function($q) use ($query){
                $q->where('name', 'like', '%'.$query.'%')->get();
            });
            
        }else{

            $data = Auth::user()->album;
        }
        
        $total = $data->count();
        if($total > 0){

            foreach($data as $row){
                $output .= '<div class="slide">
                <div class="overlay">
                <a href="/home/album/remove/'.$row->id.'" class="button"></a>
                </div>
                <img class="albums" src="http://127.0.0.1:8000/storage/album/icon/'.$row->icon.'")}}">
                <a href="/home/album/'.$row->id.'"class="album-name">'.$row->name.'</a>
                </div>';
            }

        }else{
            $output = '<h2 class = "error">Sorry, nothing found :(</h2>';
        }
        $data = array(
            'value'  => $output
        );
        echo json_encode($data);
     }
    }

    function form_album(){
        $this->authorize("isUserLogged", User::class);
        $albums  = Album::all();
        return view('user.album',['albums' => $albums]);
    }


}