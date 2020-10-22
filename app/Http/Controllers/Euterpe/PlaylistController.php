<?php

namespace App\Http\Controllers\Euterpe;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Music;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

use App\Models\Playlist;
use App\Repositories\AlbumRepository;
use App\Validators\AlbumValidator;
use App\Validators\MusicValidator;
use App\Validators\PlaylistValidator;
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
        try{
            $this->authorize("create", User::class);
            $playlist = Playlist::find($request->id);
            $input = $request->all();
            $input['user_id'] = $playlist->user_id;
            $input['view'] = $playlist->view;

            
            if($request->has('icon') == true){
                PlaylistValidator::validate($input);
                $icon = $request->file('icon');
                $icon_name = time() . '.' . $icon->extension();
                $request->icon->storeAs('playlist/icon',$icon_name);
                $input["icon"]  = $icon_name;
            }
    
            PlaylistValidator::edit_validate($input);

            $playlist->fill($input);
            $playlist->save();
    
            return Redirect::back();
    
            }catch(ValidationException $exception){
                return redirect("euterpe/playlist/edit/".$request->id)->withErrors($exception->getValidator())->withInput();
            }
                 
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
            $icon = $request->file('icon');
            $icon_name = time() . '.' . $icon->extension();
            $request->icon->storeAs('playlist/icon',$icon_name);
            $playlist["icon"]  = $icon_name;
            
            //creating playlist
            Playlist::create($playlist);
            return redirect('euterpe/playlist');
        }catch(ValidationException $exception){
            return redirect('euterpe/playlist/new')->withErrors($exception->getValidator())->withInput();
        }

    }

    function action(Request $request){
     
        if($request->ajax()){
            $output = '';
            $query = $request->get('query');

        if($query != ''){
            $data = Playlist::where('name', 'like', '%'.$query.'%')->get();

        }else{

            $data = Playlist::all();
        }
        
        $total = $data->count();
        if($total > 0){

            foreach($data as $row){
                $output .= '<div class="slide">
                <div class="overlay">
                </div>
                <img class="playlists" src="http://127.0.0.1:8000/storage/playlist/icon/'.$row->icon.'")}}">
                <a href="playlist/'.$row->id.'"class="playlist-name">'.$row->name.'</a>
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

    public function delete(Request $request){
        $this->authorize("create", User::class);
        $playlist = Playlist::find($request->id);

        foreach($playlist->music as $music){
            $playlist->music()->detach($music->id);
        }
        
        $playlist->delete();
        return redirect('euterpe/playlist');
    }
 
    public function add_music($playlist_id,$music_id){
        try{
            $this->authorize("create", User::class);


            $playlist = Playlist::find($playlist_id);
            $music = Music::find($music_id);

            foreach($playlist->music as $p_music){
                if($p_music->id == $music->id)
                    throw new Exception("Error on playlist validation");
            }
            
            $playlist->music = $music;
            $playlist->music()->attach($music->id);
    
            return Redirect::back();
        }catch(Exception $exception){
            return  Redirect::back();
        }
    }

    public function show_playlist($id){
        $this->authorize("create", User::class);
        $playlist = Playlist::find($id);
        return view('euterpe.showPlaylist',['playlist' => $playlist]);
        
    }

    public function remove_music($playlist_id,$music_id){  
            $this->authorize("create", User::class);


            $playlist = Playlist::find($playlist_id);
            $music = Music::find($music_id);


            
            $playlist->music = $music;
            $playlist->music()->detach($music->id);
    
            return Redirect::back();
    }



}