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
use App\Validators\ArtistValidator;
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
class ArtistController extends Controller
{
    function form_artist(){
        $this->authorize("create", User::class);
        $artists  = Artist::all();
        return view('euterpe.artist',['artists' => $artists]);
    }

    function action(Request $request){
     
        if($request->ajax()){
            $output = '';
            $query = $request->get('query');

        if($query != ''){
            $data = Artist::where('name', 'like', '%'.$query.'%')->get();

        }else{

            $data = Artist::all();
        }
        
        $total = $data->count();
        if($total > 0){

            foreach($data as $row){
                $output .= '<div class="slide">
                <div class="overlay">
                <a href="artist/edit/'.$row->id.'" class="button"></a>
                </div>
                <img class="artists" src="http://127.0.0.1:8000/storage/artist/icon/'.$row->icon.'")}}"> 
                <a href="artist/'.$row->id.'"class="artist-name">'.$row->name.'</a>
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

    function form_artist_new(){
        $this->authorize("create", User::class);
        return view('euterpe.createArtist');
       
    }

    public function create(Request $request){
        try{    
            $this->authorize("create", User::class);
            
            //seting data
            $artist = $request->all();
            $artist['followers'] = 0;
            //validating artist data
            ArtistValidator::validate($artist);

            //creating image
            $cover = $request->file('cover');
            $cover_name = time() . '.' . $cover->extension();
            $request->cover->storeAs('artist/cover',$cover_name);
            $artist["cover"]  = $cover_name;

            $icon = $request->file('icon');
            $icon_name = time() . '.' . $icon->extension();
            $request->icon->storeAs('artist/icon',$icon_name);
            $artist["icon"]  = $icon_name;
            
    
            //creating artist
            $artist = Artist::create($artist);

            return redirect('euterpe/artist');

        }catch(ValidationException $exception){
            return redirect('euterpe/artist/new')->withErrors($exception->getValidator())->withInput();
        }

    }

    public function delete(Request $request){
        $artist = Artist::find($request->id);
        $albums = Album::where('artist_id', $request->id)->get();
        
        if($albums != null){
            foreach($albums as $album){
                $musics = Music::where('album_id', $album->id)->get();
                if($musics != null){
                    foreach($musics as $m){
                        $m->delete();
                    }
                }
                $album->delete();
            }
        }
       
        $artist->delete();
        return redirect('euterpe/artist');
    }

    function form_artist_edit($id){
        $this->authorize("create", User::class);
        $artist = Artist::find($id);
        return view('euterpe.editArtist',['artist' => $artist]);    
    }

    public function edit(Request $request){
        try{
        $this->authorize("create", User::class);
        
        $artist = Artist::find($request->id);
        $input = $request->all();

        if($request->has('icon') == true and $request->has('cover') == true){
            ArtistValidator::validate($input);
        }
        
        if($request->has('icon') == true){
            $icon = $request->file('icon');
            $icon_name = time() . '.' . $icon->extension();
            $request->icon->storeAs('artist/icon',$icon_name);
            $input["icon"]  = $icon_name;
        }

        if($request->has('cover') == true){
            $cover = $request->file('cover');
            $cover_name = time() . '.' . $cover->extension();
            $request->cover->storeAs('artist/cover',$cover_name);
            $input["cover"]  = $cover_name;
        }
       


        ArtistValidator::edit_validate($input);
        
        $artist->fill($input);
        $artist->save();

        return redirect('euterpe/artist');

        }catch(ValidationException $exception){
            return redirect("euterpe/artist/edit/".$request->id)->withErrors($exception->getValidator())->withInput();
        }
    }

    public function show_artist($id){
        $this->authorize("create", User::class);
        $artist = Artist::find($id);
        return view('euterpe.showArtist',['artist' => $artist]);
        
    }

 
}