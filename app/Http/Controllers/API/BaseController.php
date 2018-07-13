<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

/**
 * 
 */
class BaseController extends Controller
{
	
	public function sendResponse($results, $message)
	{
		$resp['message'] = $message;
		$resp['data'] = $results;
		$resp['success'] = TRUE;

		return response()->json($resp, 200);
	}

	public function sendError($error, $errorMessages=[])
	{
		$resp['error'] = $error;
		$resp['success'] = false;

		if(! empty($errorMessages))
		{
			$resp['error_messages'] = $errorMessages;
		}

		return response()->json($resp, 404);
	}

}