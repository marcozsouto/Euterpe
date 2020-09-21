<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class User.
 *
 * @package namespace App\Entities;
 */
class User extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cpf', 'name', 'username','email','password','gender','birth','icon'];
    public $timestamps = true;

    public function artist(){
        return $this->belongsToMany(Artist::class);
    }

    public function album(){
        return $this->belongsToMany(Album::class);
    }

    public function playlist(){
        return $this->hasMany(Playlist::class);
    }
}
