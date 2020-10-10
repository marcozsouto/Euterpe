<?php

namespace App\Http\Controllers\Euterpe;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ArtistCreateRequest;
use App\Http\Requests\ArtistUpdateRequest;
use App\Models\Artist;
use App\Models\Music;
use App\Repositories\ArtistRepository;
use App\Validators\ArtistValidator;
use App\Validators\MusicValidator;
use App\Validators\ValidationException;
use Illuminate\Validation\Validator;
use \Prettus\Validator\LaravelValidator;
use Image;
use Illuminate\Support\Facades\Response;
/**
 * Class ArtistsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CreateArtistController extends Controller
{

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
            $icon = Image::make($artist['icon']);
            $cover = Image::make($artist['cover']);
            Response::make($icon->encode('jpeg'));
            Response::make($cover->encode('jpeg'));
            $artist["icon"]  = $icon;
            $artist["icon"]  = $cover;
            
            //creating artist
            $artist = Artist::create($artist);

        }catch(ValidationException $exception){
            return redirect('euterpe/artist/new')->withErrors($exception->getValidator())->withInput();
        }

    }
}