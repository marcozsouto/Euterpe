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
use App\Repositories\AlbumRepository;
use App\Validators\AlbumValidator;
use App\Validators\MusicValidator;
use App\Validators\ValidationException;
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
    function form_album(){
        $this->authorize("create", User::class);
        $albums  = Album::all();
        return view('euterpe.album',['albums' => $albums]);
    }

    function action(Request $request){
     
        if($request->ajax()){
            $output = '';
            $query = $request->get('query');

        if($query != ''){
            $data = Album::where('name', 'like', '%'.$query.'%')->get();

        }else{

            $data = Album::all();
        }
        
        $total = $data->count();
        if($total > 0){

            foreach($data as $row){
                $output .= '<div class="slide">
                <div class="overlay">
                <a href="album/edit/'.$row->id.'" class="button"></a>
                </div>
                <img class="albums" src="http://127.0.0.1:8000/storage/album/icon/'.$row->icon.'")}}">
                <h2>'.$row->name.'</h2>
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

    function form_album_new(){
        $this->authorize("create", User::class);
        $artists = Artist::all(['id', 'name']);
        return view('euterpe.createAlbum', ['artists' => $artists]);
        
    }

    public function create(Request $request){
        try{
        $this->authorize("create", User::class);

        //seting data
        $data = $request->all();
        $data['numberOfTracks'] = sizeof($data["music_name"]);
        //validating album data
        AlbumValidator::validate($data);
                
        $num_music = $data['numberOfTracks'];
        $album["name"] = $data['name'];
        $album["description"] = $data['description'];
        $album["numberOfTracks"] = $num_music;
        $album["gender"]= $data['gender'];
        $album["releaseDate"]= $data['releaseDate'];
        $album["artist_id"]= $data['artist_id'];
        
        //creating image
        $icon = $request->file('icon');
        $icon_name = time() . '.' . $icon->extension();
        $request->icon->storeAs('album/icon',$icon_name);
        $album["icon"]  = $icon_name;
        
        $musics["music_name"] = $data["music_name"];
        $musics["music_time"] = $data["music_time"];
        $musics["music_file"] = $data["music_file"];
        $musics["music_description"] = $data["music_description"];
       
    
        //creating album
        $album = Album::create($album);
        
        
        //creating music
        for($i=1; $i<= $num_music; $i++){
            $music = array();
            $music["name"] = $musics["music_name"][$i];
            $music["time"] = $musics["music_time"][$i]; 
            
            $music_file = $request->file()['music_file'][$i];
            $music_name = time() . '.' . $music_file->extension();
            $music_file->storeAs('album/music',$music_name);
            $music["music"]  = $music_name;

            $music["description"] = $musics["music_description"][$i]; 
            $music["trackNumber"] = $i;
            $music["streams"] = 0; 
            $music["album_id"] = $album->id;

            //validating music data
            MusicValidator:: validate($music);
            Music::create($music);
        }

        return redirect('euterpe/album');
        
        }catch(ValidationException $exception){
            return redirect('euterpe/album/new')->withErrors($exception->getValidator())->withInput();
        }
                 
    }

    function form_album_edit($id){
        $this->authorize("create", User::class);
        $album = Album::find($id);
        $artists = Artist::all(['id', 'name']);
        $musics = Music::select('id','name','time','description','trackNumber','streams')->where('album_id', $album->id)->orderBy('trackNumber', 'asc')->get();
        return view('euterpe.editAlbum',['album' => $album,'artists' => $artists, 'musics' => $musics]);
        
    }

    public function edit(Request $request){
        $this->authorize("create", User::class);
        return dd($request);
        $album = Album::find($request->id);
    }

    public function delete(Request $request){
        $album = Album::find($request->id);
        $musics = Music::where('album_id', $request->id)->get();
        
        if($musics != null){
            foreach($musics as $music){
                $music->delete();
            }
        }
       
        $album->delete();
        return redirect('euterpe/album');
    }
 
}