<?php

namespace App\Validators;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use \Prettus\Validator\LaravelValidator;


/**
 * Class UserValidator.
 *
 * @package namespace App\Validators;
 */
class UserValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
    */

    public static function validate($request){
        $data = $request->all();
        //basic validation
        $validator = Validator::make($data, User::$rules, User::$messages);


        //image validation
        if(array_key_exists('icon', $data)){     
            $postData = $request->only('icon');
            $file =$postData['icon'];    
            $fileArray = array('icon' => $file);
            
            $rules = array(
                'icon' => 'image|max:4000|mimes:jpeg,jpg|dimensions:ratio=1/1,min_width=300,min_height=300'  
            );
            $messages = array(
                'icon.max' =>'Your image exceeds the maximum size of 4MB',
                'icon.mimes' =>'Your image must be a jpeg file',
                'icon.ratio' => 'Your image must be a square',
                'icon.min_width' => 'Your image must have a minimun width of 300',
                'icon.min_height' => 'Your image must have a minimun height of 300', 
                'icon.image' =>'Your file must be a image'
            );

            $validator_image = Validator::make($fileArray, $rules, $messages);
            if($validator_image->fails()){
                $validator->errors()->add('icon', "Your image must be a jpeg/jpg file with radio 1/1 and minimum dimension of 300 x 300");
            }
        }else{
            $validator->errors()->add('icon', "Your icon must exist.");
        }

        if(!$validator->errors()->isEmpty())
            throw new ValidationException($validator, "Error on user validation");
        return $validator;
    }
}
