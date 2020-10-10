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
use Illuminate\Validation\Validator;
use \Prettus\Validator\LaravelValidator;
use Image;
/**
 * Class AlbumsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CreateAlbumController extends Controller
{
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
        $icon = Image::make($data['icon']);
        Response::make($icon->encode('jpeg'));
        $album["icon"]  = $icon;
        
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
            $music["music"] = $musics["music_file"][$i]; 
            $music["description"] = $musics["music_description"][$i]; 
            $music["trackNumber"] = $i;
            $music["streams"] = 0; 
            $music["album_id"] = $album->id;

            //validating music data
            MusicValidator:: validate($music);
            Music::create($music);
        }
        
        }catch(ValidationException $exception){
            return redirect('euterpe/album/new')->withErrors($exception->getValidator())->withInput();
        }
                 
    }
 
}
