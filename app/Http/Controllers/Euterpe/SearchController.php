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
 * Class SearchController.
 *
 * @package namespace App\Http\Controllers;
 */
class SearchController extends Controller
{
    
    function action(Request $request){
     
        if($request->ajax()){
            $output = '';
            $query = $request->get('query');

        if($query != ''){
            $musics = Music::where('name', 'like', '%'.$query.'%')->get();
            $albums = Album::where('name', 'like', '%'.$query.'%')->get();
            $artists = Artist::where('name', 'like', '%'.$query.'%')->get();

        }else{

            $musics = Music::all();
            $albums = Music::all();
            $artists = Music::all();
        }
        
        $total_musics = $musics->count();
        $total_albums = $albums->count();
        $total_artists = $artists->count();
        $output .= ' 
                <p class ="artists">Artists</p>';
        $output .= ' 
                <div class= artists-line></div>';
        $output .= ' 
                <p class ="albums">Albums</p>';
        $output .= ' 
                <div class= albums-line></div>';
        $output .= ' 
                <p class ="musics">Musics</p>';
        $output .= ' 
                <div class= musics-line></div>';
  
        
        if($total_artists > 0){
            $output .= ' 
            <div class= "search-artists">';

            foreach($artists as $artist){
                $output .= '<div class = "search-artist">
                <img class="search-artist-img" src="http://127.0.0.1:8000/storage/artist/icon/'.$artist->icon.'")}}"> 
                <a href="artist/'.$artist->id.'"class="search-artist-name">'.$artist->name.'</a>
                </div>';
            }

            $output .= ' 
            </div>';
        }
        if($total_albums > 0){
            $output .= ' 
            <div class = "search-albums">';

            foreach($albums as $album){
                $output .= '<div class = "search-album">
                <img class="search-album-img" src="http://127.0.0.1:8000/storage/album/icon/'.$album->icon.'")}}"> 
                <a href="album/'.$album->id.'"class="search-album-name">'.$album->name.'</a>
                <a href="artist/'.$album->artist->id.'"class="search-album-artist-name">'.$album->artist->name.'</a>
                </div>';
            }

            $output .= ' 
            </div>';
        }
        if($total_musics > 0){
            $output .= ' 
            <div class= "search-musics">';

            foreach($musics as $music){
                $output .= '<div class = "search-music">
                <div class = "search-music-line" ></div>
                <img class="search-music-img" src="http://127.0.0.1:8000/storage/album/icon/'.$music->album->icon.'")}}"> 
                <a href="album/'.$music->album->id.'"class="search-music-name">'.$music->name.'</a>
                <a href="artist/'.$music->album->artist->id.'"class="search-music-artist-name">'.$music->album->artist->name.'</a>
                </div>';
            }

            $output .= ' 
            </div>';
            
        }else{
            $output = '<h2 class = "error">Sorry, nothing found :(</h2>';
        }

        $search = array(
            'value'  => $output
        );
        echo json_encode($search);
     }
    }
}