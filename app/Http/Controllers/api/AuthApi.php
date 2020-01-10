<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route; 
use App\Http\Requests\authApiRequest;
use Illuminate\Support\Facades\Hash;

class AuthApi extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','show']]);
    }

    public function login(Request $request){
        
        
        $request->request->add([ 
            'grant_type' => 'password', 
            'client_id'  => 5, 
            'client_secret' => 'fkTC2atiOaahxQkNnnL6FJC4mLITod00ofmGPWKN', 
            'scope' => '*' ,
            'username' => $request->username,
            'password' => $request->password
        ]); 
        
        // forward the request to the oauth token request endpoint 
        $tokenRequest = Request::create('/oauth/token','post'); 
        return Route::dispatch($tokenRequest); 
    }

    public function register(authApiRequest $request){
        
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
    }

    
}
