<?php

namespace App\Validators;

use App\Models\Album;
use App\Models\Music;
use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;
use Illuminate\Support\Facades\Validator;
/**
 * Class MusicValidator.
 *
 * @package namespace App\Validators;
 */
class MusicValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    public static function validate($data){
        
        //basic validation
        $validator = Validator::make($data, Music::$rules, Music::$messages);

        //validates a real album for the music
        if(!Album::where('id',$data['album_id'])->exists())
            $validator->errors()->add('album_id', "This album doesn't exist.");

        //validades if the music's track number is equal or less than album's number of tracks
        if(Album::where( [ ['id', $data['album_id'] ], ['numberOfTracks', '<', $data['trackNumber'] ]] )->exists())
            $validator->errors()->add('trackNumber', "There's too many tracks for the album.");
        
        
        if(!$validator->errors()->isEmpty())
            throw new ValidationException($validator, "Error on music validation");
        return $validator;
    
    }
}
