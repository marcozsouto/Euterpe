<?php

namespace App\Validators;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use \Prettus\Validator\LaravelValidator;
use Illuminate\Support\Facades\Validator;
/**
 * Class PlaylistValidator.
 *
 * @package namespace App\Validators;
 */
class PlaylistValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */

    public static function validate($data){   
       
        //basic validation
        $validator = Validator::make($data, Playlist::$rules, Playlist::$messages);

        //validates a real user for the playlist 
        if(!User::where('id',$data['user_id'])->exists())
            $validator->errors()->add('user_id', "This user doesn't exist."); 

        //image validation
        if(array_key_exists('icon', $data)){     
          
            $file =$data['icon'];    
            $fileArray = array('icon' => $file);
            
            $rules = array(
                'icon'=>'image|max:4000|mimes:jpeg|dimensions:ratio=1/1,min_width=300,min_height=300' 
            );
            $messages = array(
                'icon.max' =>'Your image exceeds the maximum size of 4MB',
                'icon.mimes' =>'Your image must be a jpeg file',
                'icon.ratio => Your image must be a square',
                'icon.min_width => Your image must have a minimun width of 300',
                'icon.min_height => Your image must have a minimun height of 300',
                'icon.image' =>'Your file must be a image', 
            );

            $validator_image = Validator::make($fileArray, $rules);
            
            if($validator_image->fails()){
                $validator->errors()->add('icon', "Your image must be a jpeg/jpg file with radio 1/1 and minimum dimension of 300 x 300");
            }
        }else{
            $validator->errors()->add('icon', "Your icon must exist.");
        }

        
        if(!$validator->errors()->isEmpty())
            throw new ValidationException($validator, "Error on playlist validation");
        return $validator;
    
    }
}
