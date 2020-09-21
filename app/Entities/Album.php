<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Album.
 *
 * @package namespace App\Entities;
 */
class Album extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','cover','numberOfTracks','gender','releaseDate'];
    public $timestamps = true;

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function artist(){
        return $this->belongsToMany(Artist::class);
    }
    
    public function music(){
        return $this->hasMany(Music::class);
    }

}
