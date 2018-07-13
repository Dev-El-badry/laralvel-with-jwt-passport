<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use JWTAuth;
use JWTFactory;
use App\User;
use App\Http\Controllers\Controller;

class ApiLoginController extends Controller
{
    public function login(Request $request) 
    {
    	$validator = Validator::make($request->all(), [
    		'email'=> 'required|string|email|max:255',
    		'password'=> 'required'
    	]);

    	if($validator->fails()) 
    	{
    		return response()->json($validator->errors());
    	}

    	$credentials = $request->only('email', 'password'); //CREDINTLAS OF LOGIN
    	try 
    	{
    		if(! $token = JWTAuth::attempt($credentials)) 
    		{
    			return response()->json(array('status'=> 401, 'message'=>'invalid username OR password'));
    		}

    	}

    	catch (JWTException $e) 
    	{
    		return response()->json(array('status'=>500, 'message'=> 'could not create token'));
    	}
    	
    	return response()->json(array('status'=> 200, 'token'=> $token));
    }
}
