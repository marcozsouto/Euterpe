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
 * Class MusicController.
 *
 * @package namespace App\Http\Controllers;
 */
class MusicController extends Controller
{
    
    function action(Request $request){
     
        if($request->ajax()){
            $output = '';
            $query = $request->get('query');

        if($query != ''){
            $musics = Music::where('name', 'like', '%'.$query.'%')->get();

        }else{

            $musics = Music::all();
        }
        
        $total = $musics->count();
        $output .= ' 
                <p class ="s">Search</p>';
        $output .= ' 
                <p class ="songs">Songs</p>';
        if($total > 0){

            foreach($musics as $music){
                $output .= ' 
                <div class="slides">
                <div class= line></div>
                <h2 class= "name">'.$music->name.'</h2>
                <img class = "icon-music"src="http://127.0.0.1:8000/storage/album/icon/'.$music->album->icon.'">
                <h3 class = "album">'.$music->album->artist->name.' - '.$music->album->name.'</h2>;
                </div>';
            }

        }else{
            $output = '<h2 class = "error">Sorry, nothing found :(</h2>';
        }
        $musics = array(
            'value'  => $output
        );
        echo json_encode($musics);
     }
    }
}