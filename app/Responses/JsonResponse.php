<?php

namespace App\Responses; 

use Illuminate\Http\Response;

class JsonResponse{

    public static function success(?string $message = null, mixed $data = null)
    {
        return response()->json( [
            'message' => $message,
            'data' => $data,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }

    public static function error(string $message, int $httpcode) {
        return response()->json([
            'message' => $message,
            'code' => $httpcode
        ], $httpcode); 
    }

}