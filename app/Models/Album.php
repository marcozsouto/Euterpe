<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Album.
 *
 * @package namespace App\Models;
 */
class Album extends Model implements Transformable
{
    use TransformableTrait;
    use hasFactory; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','numberOfTracks','gender','releaseDate','artist_id','icon'];
    
    public static $rules = [
        'name' =>'required|min:1|max:100',
        'description'=>'max:256',
        'numberOfTracks'=>'required',
        'gender'=>'required',
        'releaseDate'=>'required'
    ];

    public static $messages =[
        'name.required'=>"Unexpected Error AB01: Please contact our support.",
        'name.min'=>"Unexpected Error AB02: Please contact our support.",
        'name.max'=>"Unexpected Error AB03: Please contact our support.", 
        'description.*'=>"Unexpected Error AB04: Please contact our support.",
        'numberOfTracks.*'=>"Unexpected Error AB05: Please contact our support.",
        'gender.*'=>"Unexpected Error AB06: Please contact our support.",
        'releaseDate.*'=>"Unexpected Error AB07: Please contact our support.",
    ];
    
    public $timestamps = true;

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function artist(){
        return $this->belongsTo(Artist::class);
    }
    
    public function music(){
        return $this->hasMany(Music::class);
    }

}
