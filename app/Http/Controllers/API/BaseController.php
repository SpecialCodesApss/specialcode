<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($message,$result = [])
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if(!empty($result)){
            $response['data'] = $result;
        }
		
		$response=mb_convert_encoding($response, 'UTF-8', 'UTF-8');
        return response()->json($response, 200);
		
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 200)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

		$response=mb_convert_encoding($response, 'UTF-8', 'UTF-8');
        return response()->json($response, $code);
    }
}

