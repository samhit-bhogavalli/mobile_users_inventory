<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class UserNotFoundException extends Exception
{
    function report () {}
    function render (): JsonResponse
    {
        return response()->json([
            'error' => 'BAD_REQUEST',
            'description' => 'user not found'
        ], 400);
    }
}
