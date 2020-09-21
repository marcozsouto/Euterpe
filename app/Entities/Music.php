<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Music.
 *
 * @package namespace App\Entities;
 */
class Music extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'time','music','description','trackNumber','streams','album_id'];
    public $timestamps = true;

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
