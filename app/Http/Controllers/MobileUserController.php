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

    public function getAllUserNameAndMobile(Request $request): JsonResponse
    {
        return $this->mobile_user_service->getAllUserNameAndMobile($request);
    }

    /**
     * @throws InputWrongFormatException
     */
    public function createMobileUser (Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'mobile_number' => 'size:10',
            'email' => 'regex:/^.+@.+$/i'
        ]);
        if ($validator->fails()) {
            throw new InputWrongFormatException("given input is in wrong format");
        }

        return $this->mobile_user_service->createMobileUser($request);
    }

    /**
     * @throws InputWrongFormatException
     * @throws UserNotFoundException
     */
    public function getUserByMobileNumber ($mobile_number): JsonResponse
    {
        $validator = Validator::make(['data' => $mobile_number], [
            'data' => 'size:10'
        ]);
        if ($validator->fails()) {
            throw new InputWrongFormatException("given input is in wrong format");
        }
        return $this->mobile_user_service->getUserByMobileNumber($mobile_number);
    }

    /**
     * @throws InputWrongFormatException
     * @throws UserNotFoundException
     */
    public function getUserByEmail ($email): JsonResponse
    {
        $validator = Validator::make(['data' => $email], [
            'data' => 'regex:/^.+@.+$/i'
        ]);
        if ($validator->fails()) {
            throw new InputWrongFormatException("given input is in wrong format");
        }
        return $this->mobile_user_service->getUserByEmail($email);
    }

    /**
     * @throws InputWrongFormatException
     * @throws UserNotFoundException
     */
    public function getUserByUserName ($user_name): JsonResponse
    {
        $validator = Validator::make(['data' => $user_name], [
            'data' => 'required'
        ]);
        if ($validator->fails()) {
            throw new InputWrongFormatException("given input is in wrong format");
        }
        return $this->mobile_user_service->getUserByUserName($user_name);
    }

    /**
     * @throws InputWrongFormatException
     * @throws UserNotFoundException
     */
    public function deleteUserByUserName ($user_name): JsonResponse
    {
        $validator = Validator::make(['data' => $user_name], [
            'data' => 'required'
        ]);
        if ($validator->fails()) {
            throw new InputWrongFormatException("given input is in wrong format");
        }
        return $this->mobile_user_service->deleteUserByUserName($user_name);
    }

    /**
     * @throws InputWrongFormatException
     * @throws UserNotFoundException
     */
    public function deleteUserByMobileNumber ($mobile_number): JsonResponse
    {
        $validator = Validator::make(['data' => $mobile_number], [
            'data' => 'size:10'
        ]);
        if ($validator->fails()) {
            throw new InputWrongFormatException("given input is in wrong format");
        }
        return $this->mobile_user_service->deleteUserByMobileNumber($mobile_number);
    }

    /**
     * @throws InputWrongFormatException
     * @throws UserNotFoundException
     */
    public function deleteUserByEmail ($email): JsonResponse
    {
        $validator = Validator::make(['data' => $email], [
            'data' => 'regex:/^.+@.+$/i'
        ]);
        if ($validator->fails()) {
            throw new InputWrongFormatException("given input is in wrong format");
        }
        return $this->mobile_user_service->deleteUserByEmail($email);
    }
}
