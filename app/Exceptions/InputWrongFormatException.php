<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class InputWrongFormatException extends Exception
{
    function report () {}
    function render (): JsonResponse
    {
        return response()->json([
            'error' => 'BAD_REQUEST',
            'description' => $this->getMessage()
        ], 400);
    }
 }
