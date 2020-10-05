<?php

namespace App\Http\Controllers\Admin;
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

/**
 * Class ArtistsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CreateArtistController extends Controller
{


    public function create(Request $request){
        try{    
            $this->authorize("create", User::class);
            //seting data
            $artist = $request->all();

            //validating artist data
            ArtistValidator::validate($artist);
            
            
            
            //creating artist
            $artist = Artist::create($artist);

        }catch(ValidationException $exception){
            return redirect('artist/new')->withErrors($exception->getValidator())->withInput();
        }

    }
}