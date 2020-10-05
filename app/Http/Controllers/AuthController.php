<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use AuthenticatesUsers;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Validators\UserValidator;
use App\Validators\ValidationException;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    
    function login(Request $request){
        
        try{
        $credentials = [
            "username" =>$request->username,
            "password" =>$request->password
        ];
        if(Auth::attempt($credentials) and Auth::user()->username == "euterpe"){
            return redirect()->route("euterpe");
        }else{
            return redirect()->route("home");
        }
        
   
    }catch(Exception $exception){
        return $exception->getMessage();
    }
    }

    function logout(){
        Auth::logout();
        return redirect()->route("home");
    }

    function signup(Request $request){
        try{
            //validating album data
            UserValidator::validate($request);
            
            //seting data
            $data = $request->all();

            $user['name'] = $data['name'];  
            $user['username'] = $data['username'];
            $user['email'] = $data['email'];
            $user['password'] = Hash::make($data['password']);
            $user['gender'] = $data['gender']; 
            $user['birth'] = $data['birth']; 
            $user['icon'] = $data['icon']; 

            //creating album
            $user = User::create($user);

            //redirectin created user
            $credentials = [
                "username" =>$user["username"],
                "password" =>$user["password"]
            ];

            Auth::attempt($credentials);
            return redirect()->route("home");
            
        }catch(ValidationException $exception){
            return redirect('signup')->withErrors($exception->getValidator())->withInput();
        }

    }

}
