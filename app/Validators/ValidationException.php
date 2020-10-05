<?php 

namespace App\Validators;

use Exception;

class ValidationException extends Exception{
    protected $validator;


    public function __construct($validator, $text = "Error")
    {
        parent::__construct($text);
        $this->validator = $validator;
    }

    public function getValidator(){
        return $this->validator; 
    }

}