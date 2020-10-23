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
        if(Auth::check()){
            return redirect()->route("welcome");
        }
        try{
        $credentials = [
            "username" =>$request->username,
            "password" =>$request->password
        ];
        if(Auth::attempt($credentials) and Auth::user()->username == "euterpe"){
            return redirect()->route("euterpe");
        }
        if(Auth::attempt($credentials)){
            return redirect()->route("home");
        }else{
            return redirect()->route("login");
        }
        
   
    }catch(Exception $exception){
        return $exception->getMessage();
    }
    }

    function logout(){
        Auth::logout();
        return redirect()->route("welcome");
    }

    function signup(Request $request){
        try{
            if(Auth::check()){
                return redirect()->route("welcome");
            }
            
            if(strlen($request->day) == 1){
                $request['day'] = '0'.$request['day'];
            }
            $birth = $request['year'].'-'.$request['month'].'-'.$request['day'];
            $request->request->add(['birth' => $birth]);
            

            //validating album data
            UserValidator::validate($request);
            
            //seting data
            $data = $request->all();
            
            $user['name'] = $data['name'];  
            $user['username'] = $data['username'];
            $user['email'] = $data['email'];
            $user['password'] = Hash::make($data['password']);
            $user['gender'] = $data['gender']; 
            $user['birth'] = $birth;
            
            $icon = $request->file('icon');
            $icon_name = time() . '.' . $icon->extension();
            $request->icon->storeAs('user/icon',$icon_name);
            $user["icon"]  = $icon_name;
            
            //creating user
            $user = User::create($user);

            //redirectin created user
            $credentials = [
                "username" =>$user["username"],
                "password" =>$data["password"]
            ];

            Auth::attempt($credentials);
            return redirect()->route("home");
            
        }catch(ValidationException $exception){
            return redirect('/signup')->withErrors($exception->getValidator())->withInput();
        }

    }

}
