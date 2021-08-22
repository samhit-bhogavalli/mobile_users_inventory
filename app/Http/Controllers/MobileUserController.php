<?php

namespace App\Http\Controllers;

use App\Exceptions\InputWrongFormatException;
use App\Exceptions\UserNotFoundException;
use App\Models\MobileUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MobileUserController extends Controller
{
    protected $mobile_user_service;

    public function __construct(MobileUserService $mobile_user_service)
    {
        $this->mobile_user_service = $mobile_user_service;
    }

    public function getUserNameAndMobile(Request $request): JsonResponse
    {
        return $this->mobile_user_service->getUserNameAndMobile($request);
    }

    /**
     * @throws InputWrongFormatException
     */
    public function createMobileUser (Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|min:1|max:20',
            'mobile_number' => 'required|size:10',
            'email' => 'required|regex:/^.+@.+$/i'
        ]);
        if ($validator->fails()) {
            throw new InputWrongFormatException($validator->errors());
        }

        return $this->mobile_user_service->createMobileUser($request);
    }

    /**
     * @throws UserNotFoundException
     */
    public function deleteUser (Request $request): JsonResponse
    {
        return $this->mobile_user_service->deleteUser($request);
    }
}
