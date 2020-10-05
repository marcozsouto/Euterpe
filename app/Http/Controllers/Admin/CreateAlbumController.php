<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AlbumCreateRequest;
use App\Http\Requests\AlbumUpdateRequest;
use App\Models\Album;
use App\Models\Music;
use App\Repositories\AlbumRepository;
use App\Validators\AlbumValidator;
use App\Validators\MusicValidator;
use App\Validators\ValidationException;
use Illuminate\Validation\Validator;
use \Prettus\Validator\LaravelValidator;

/**
 * Class AlbumsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CreateAlbumController extends Controller
{
    

    public function create(Request $request){
        try{
        $this->authorize("create", User::class);
        //seting data
        $data = $request->all();
        
        //validating album data
        AlbumValidator::validate($data);
                
        

        $num_music = $data['numberOfTracks'];
        $album["name"] = $data['name'];
        $album["description"] = $data['description'];
        $album["numberOfTracks"] = $data['numberOfTracks'];
        $album["gender"]= $data['gender'];
        $album["releaseDate"]= $data['releaseDate'];
        $album["artist_id"]= $data['artist_id'];
        $album["icon"]  = $data['icon'];
        
        $musics["music_name"] = $data["music_name"];
        $musics["music_time"] = $data["music_time"];
        $musics["music_music"] = $data["music_music"];
        $musics["music_description"] = $data["music_description"];
       
        
        
        //creating album
        $album = Album::create($album);
        
        
        //creating music
        for($i=0; $i< $num_music; $i++){
            $music = array();
            $music["name"] = $musics["music_name"][$i];
            $music["time"] = $musics["music_time"][$i]; 
            $music["music"] = $musics["music_music"][$i]; 
            $music["description"] = $musics["music_description"][$i]; 
            $music["trackNumber"] = $i +1;
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
