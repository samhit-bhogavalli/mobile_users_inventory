<?php

namespace App\Http\Controllers;

use App\Models\MobileUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MobileUserController extends Controller
{
    protected $mobile_user_service;

    public function __construct(MobileUserService $mobile_user_service)
    {
        $this->mobile_user_service = $mobile_user_service;
    }

    public function createMobileUser (Request $request): JsonResponse
    {
        return $this->mobile_user_service->createMobileUser($request);
    }

    public function getUserByMobileNumber ($mobile_number): JsonResponse
    {
        return $this->mobile_user_service->getUserByMobileNumber($mobile_number);
    }

    public function getUserByEmail ($email): JsonResponse
    {
        return $this->mobile_user_service->getUserByEmail($email);
    }

    public function getUserByUserName ($user_name): JsonResponse
    {
        return $this->mobile_user_service->getUserByUserName($user_name);
    }

    public function deleteUserByUserName ($user_name): JsonResponse
    {
        return $this->mobile_user_service->deleteUserByUserName($user_name);
    }

    public function deleteUserByMobileNumber ($mobile_number): JsonResponse
    {
        return $this->mobile_user_service->deleteUserByMobileNumber($mobile_number);
    }

    public function deleteUserByEmail ($email): JsonResponse
    {
        return $this->mobile_user_service->deleteUserByEmail($email);
    }
}
