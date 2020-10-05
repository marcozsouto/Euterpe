<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function homepage(){
       return view('welcome');
    }

    function form_login(){
        return view('login');
    }

    function form_signup(){
        return view('signup');
    }

    function euterpe_dashboard(){
        return view('euterpe.dashboard');
    }

    function form_album(){
        $this->authorize("create", User::class);
        return view('euterpe.createAlbum');
        
    }

    function form_artist(){
        $this->authorize("create", User::class);
        return view('euterpe.createArtist');
       
    }

    function form_euterpe_playlist(){
        $this->authorize("create", User::class);
        return view('euterpe.createArtist');
        
    }
}
