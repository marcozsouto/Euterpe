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
use App\Validators\ArtistValidator;
use App\Validators\MusicValidator;
use App\Validators\ValidationException;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Validator;
use \Prettus\Validator\LaravelValidator;
use Image;
/**
 * Class AlbumsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ArtistController extends Controller
{
    function form_artist(){
        $this->authorize("isUserLogged", User::class);
        $artists  = Auth::user()->artist;
        return view('user.artist',['artists' => $artists]);
    }

    public function remove_artist($artist_id){  
        $this->authorize("isUserLogged", User::class);
        $artist = Artist::find($artist_id);
    
        
        Auth::user()->artist = $artist;
        Auth::user()->artist()->detach($artist->id);
        return Redirect::back();
    }

    function add_artist($id){
        try{
            $this->authorize("isUserLogged", User::class);
            $artist = Artist::find($id);

            foreach(Auth::user()->artist as $p_artist){
                if($p_artist->id == $artist->id)
                    throw new Exception("Error on playlist validation");
            }

            Auth::user()->artist = $artist;
            Auth::user()->artist()->attach($artist->id);
            return Redirect::back();
        
        }catch(Exception $exception){
            return  Redirect::back();
        }   
    }

    function action(Request $request){
     
        if($request->ajax()){
            $output = '';
            $query = $request->get('query');

        if($query != ''){
            $data = User::whereHas('artist', function($q) use ($query){
                $q->where('name', 'like', '%'.$query.'%')->get();
            });

        }else{

            $data = Auth::user()->artist;
        }
        
        $total = $data->count();
        if($total > 0){

            foreach($data as $row){
                $output .= '<div class="slide">
                <div class="overlay">
                <a href="/home/artist/remove/'.$row->id.'" class="button"></a>
                </div>
                <img class="artists" src="http://127.0.0.1:8000/storage/artist/icon/'.$row->icon.'")}}"> 
                <a href="/home/artist/'.$row->id.'"class="artist-name">'.$row->name.'</a>
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

    public function show_artist($id){
        $this->authorize("isUserLogged", User::class);
        $artist = Artist::find($id);
        return view('user.showArtist',['artist' => $artist]); 
    }

}