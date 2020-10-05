<?php

namespace App\Validators;

use App\Models\Artist;
use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;
use Illuminate\Support\Facades\Validator;
/**
 * Class ArtistValidator.
 *
 * @package namespace App\Validators;
 */
class ArtistValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    public static function validate($data){
        

        //basic validation
        $validator = Validator::make($data, Artist::$rules, Artist::$messages);
        
        //image validation
        if(array_key_exists('icon', $data) and array_key_exists('cover', $data)){     
    
          
            $file_icon = $data['icon'];
        
            $file_cover = $data['cover'];
    
            $fileArray = array('icon' => $file_icon,'cover' => $file_cover );

            $rules = array(
                'icon'=>'image|max:4000|mimes:jpeg,jpg|dimensions:ratio=1/1,min_width=640,min_height=640,max_width=640,max_height=640',
                'cover'=>'image|max:6000|mimes:jpeg,jpg|dimensions:ratio=16/9,min_width=1280,min_height=720'
            );

            $messages = array(
                'icon.max' =>'Your image exceeds the maximum size of 4MB',
                'icon.mimes' =>'Your image must be a jpeg file',
                'icon.ratio => Your image must be a square',
                'icon.min_width => Your image must have a minimun width of 300',
                'icon.min_height => Your image must have a minimun height of 300',
                'icon.max_width => Your image must have a maximun width of 300',
                'icon.max_height => Your image must have a maximun height of 300',
                'icon.image' =>'Your file must be a image',  
                'cover.max' =>'Your image exceeds the maximum size of 6MB',
                'cover.mimes' =>'Your image must be a jpeg file',
                'cover.ratio => Your image must be a square',
                'cover.min_width => Your image must have a minimun width of 640',
                'cover.min_height => Your image must have a minimun height of 640',
                'cover.image' =>'Your file must be a image');

            $validator_image = Validator::make($fileArray, $rules);  
            if(!$validator_image->errors()->isEmpty()){
                $validator->errors()->add('icon', "Your images must be a jpeg/jpg file with radio 1/1 and dimension of 640 x 640(icon) and minimum of 1280 x 720(cover)");
            }
        }else{
            if(array_key_exists('icon', $data))
                $validator->errors()->add('cover', "Your cover must exist");
            if(array_key_exists('cover', $data))
                $validator->errors()->add('icon', "Your icon must exist");
            else{
                $validator->errors()->add('icon', "Your icon must exist");
                $validator->errors()->add('cover', "Your cover must exist");
            }    
        }
           
        if(!$validator->errors()->isEmpty())
            throw new ValidationException($validator, "Error on artist validation");
        return $validator;
    
    }
}
