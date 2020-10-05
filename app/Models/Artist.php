<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * Class Artist.
 *
 * @package namespace App\Models;
 */
class Artist extends Model implements Transformable
{
    use TransformableTrait;
    use hasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','musicGender','icon','cover','followers'];

    public static $rules = [
        'name' =>'required|min:1|max:45',
        'description'=>'max:256',
        'musicGender'=>'required|min:1|max:25',
        'followers'=>'required'
    ];

    public static $messages =[
        'name.required'=>"Unexpected Error AT01: Please contact our support.",
        'name.min'=>"Unexpected Error AT02: Please contact our support.",
        'name.max'=>"Unexpected Error AT03: Please contact our support.", 
        'description.*'=>"Unexpected Error AT04: Please contact our support.",
        'musicGender.required'=>"Unexpected Error AT05: Please contact our support.",
        'musicGender.min'=>"Unexpected Error AT06: Please contact our support.",
        'musicGender.max'=>"Unexpected Error AT07: Please contact our support.", 
        'followers.*'=>"Unexpected Error AT10: Please contact our support."  
    ];
    
    public $timestamps = true;

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function album(){
        return $this->hasMany(Album::class);
    }

    public function music(){
        return $this->belongsToMany(Music::class);
    }
}
