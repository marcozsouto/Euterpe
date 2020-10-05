<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * Class Playlist.
 *
 * @package namespace App\Models;
 */
class Playlist extends Model implements Transformable
{
    use TransformableTrait;
    use hasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description','icon','view','user_id'];
    
    public static $rules = [
        'name'=>'required|min:1|max:256', 
        'description'=>'max:256',
        'view'=>'required',
        'user_id'=>'required'
    ];
    
    public static $messages=[
        'name.required'=>"Enter a name for your playlist.",
        'name.min'=>"Enter a name for your playlist.",
        'name.max'=>"Your playlist's name is too long.", 
        'description.*'=>"Your playlist's description is too long.", 
        'view.*'=>"Unexpected Error PS02: Please contact our support.",
        'user_id.*'=>"Unexpected Error PS03: Please contact our support."
    ];
    public $timestamps = true;


    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function music(){
        return $this->belongsToMany(Music::class);
    }
}
