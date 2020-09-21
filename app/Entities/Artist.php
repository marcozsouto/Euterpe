<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Artist.
 *
 * @package namespace App\Entities;
 */
class Artist extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','musicGender','icon','cover','followers'];
    public $timestamps = true;

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function album(){
        return $this->belongsToMany(Album::class);
    }

    public function music(){
        return $this->belongsToMany(Music::class);
    }
}
