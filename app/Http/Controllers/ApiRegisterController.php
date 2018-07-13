<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Response;
use Validator;
//use Response;
use JWTFactory;
use JWTAuth;
use Hash;

class ApiRegisterController extends Controller
{
    public function register(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'name'=> 'required',
    		'email'=> 'required|string|email|unique:users',
    		'password'=> 'required'
    	]);

    	if($validator->fails()) 
    	{
    		return response()->json($validator->errors());
    	}

    	$user = new User();
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = Hash::make($request->password);
    	$user->save();

    	if ($user->save()) {
    		$token = JWTAuth::fromUser($user);
    		return response()->json(compact('token'));
    	}
    }
}
