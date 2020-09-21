<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Playlist.
 *
 * @package namespace App\Entities;
 */
class Playlist extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description','cover','view','user_id'];
    public $timestamps = true;


    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function music(){
        return $this->belongsToMany(Music::class);
    }
}
