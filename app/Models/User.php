<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
/**
 * Class User.
 *
 * @package namespace App\Models;
 */
class User extends Authenticatable
{
    use TransformableTrait;
    use hasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $fillable = ['name', 'username','email','password','gender','birth','icon'];
    
    public static $rules = [
        'name'=>'required|min:1|max:50', 
        'username'=>'required|min:1|max:45',
        'email'=>'required|min:3|max:320|unique:users|regex:/^.+@.+$/i',
        'password'=>'required|min:3|max:254',
        'gender'=>'required|min:1|max:1',
        'birth'=>'required|date|before:-18 years',
        
        ];

    public static $messages=[
        'name.required'=>"Enter a name for your profile.",
        'name.min'=>"Enter a name for your profile.",
        'name.max'=>"Your name is too long.", 
        'username.min'=>"Enter a username for your profile.",
        'username.max'=>"Your username is too long.",
        'username.required'=>"Enter a username for your profile.",
        'email.min'=>"This email is invalid. Make sure it's written like example@email.com",
        'email.max'=>"This email is invalid. Make sure it's written like example@email.com",
        'email.required'=>"You need to enter your email.",
        'email.uniuqe'=>"This email is already in use.",
        'email.regex'=>"This email is invalid. Make sure it's written like example@email.com",
        'password.required'=>"You need to enter a password.",
        'password.min'=>"Your password is too short.",
        'password.max'=>"Your name is too long.",
        'password.confirmed'=>"You have to confirm your password.",
        'gender.*'=>"You need to choose a gender.",
        'birth.required'=>"Enter a valid date",
        'birth.date'=>"Enter a valid date",
        'birth.before'=>"You are too young",
     
    ];
    
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

    public function firstName(){
        $firstname = explode(' ',trim($this->name));        
        return $firstname[0];
    }
}
