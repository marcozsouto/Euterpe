<?php

namespace App\Validators;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Music;
use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\Console\Input\Input;
use File;
use Illuminate\Auth\Events\Validated;

/**
 * Class AlbumValidator.
 *
 * @package namespace App\Validators;
 */
class AlbumValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    public static function validate($data){

        
        //basic validation
        $validator = Validator::make($data, Album::$rules, Album::$messages);
        
        //validates a real artist for the album 
        if(!Artist::where('id',$data['artist_id'])->exists()){
            $validator->errors()->add('artist_id', "This artist doesn't exist.");
        }

        //validates image characteristics
        if(array_key_exists('icon', $data)){     
            $file =$data['icon'];    
            $fileArray = array('icon' => $file);
            $rules = array(
                'icon' =>'image|required|max:30000|mimes:jpg,jpeg|dimensions:max_width=640,max_height=640,ratio=1/1'  
            );
            $messages = array(
                'icon.max' =>'Your image exceeds the maximum size of 4MB',
                'icon.mimes' =>'Your image must be a jpeg/jpg file',
                'icon.ratio => Your image must be a square',
                'icon.min_width => Your image must have a minimun width of 300',
                'icon.min_height => Your image must have a minimun height of 300',
                'icon.image' =>'Your file must be a image', 
            );

            $validator_image = Validator::make($fileArray, $rules, $messages);
            
            if($validator_image->fails()){
                $validator->errors()->add('icon', "Your icon doesn't attempt the dimension required.");
            }
        }else{
            $validator->errors()->add('icon', "Your icon must exist.");
        }
       
        //end
        if(!$validator->errors()->isEmpty())
            throw new ValidationException($validator, $validator->getMessageBag());

        return $validator;
    }

}
