<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * Class Music.
 *
 * @package namespace App\Models;
 */
class Music extends Model implements Transformable
{
    use TransformableTrait;
    use hasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'time','music','description','trackNumber','streams','album_id'];
    
    public static $rules = [
        'name'=>'required|min:1|max:256', 
        'time'=>'required',
        'music'=>'required',
        'description'=>'max:256',
        'trackNumber'=>'required',
        'streams'=>'required',
        'album_id'=>'required'
    ];
    
    public static $messages =[
        'name.required'=>"Unexpected Error MS01: Please contact our support.",
        'name.min'=>"Unexpected Error MS02: Please contact our support.",
        'name.max'=>"Unexpected Error MS03: Please contact our support.", 
        'time.*'=>"Unexpected Error MS04: Please contact our support.",
        'music.*'=>"Unexpected Error MS05: Please contact our support.",
        'description.*'=>"Unexpected Error MS06: Please contact our support.",
        'trackNumber.*'=>"Unexpected Error MS07: Please contact our support.",
        'streams.*'=>"Unexpected Error MS08: Please contact our support.",
        'album_id.*'=>"Unexpected Error MS09: Please contact our support."
    ];
    public $timestamMS = true;

    public function owner(){
        return $this->belongsTo(Album::class);
    }

    public function artist(){
        return $this->belongsToMany(Artist::class);
    }

    public function playlist(){
        return $this->belongsToMany(Playlist::class);
    }
}
