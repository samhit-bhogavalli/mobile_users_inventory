<?php

namespace App\Models;


use App\Exceptions\UserNotFoundException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use stdClass;

class MobileUserService
{
    public function getAllUserNameAndMobile (): JsonResponse
    {
        try {
            $mobile_users = MobileUser::all()->map(function ($mobile_user) {
                return (object) [
                    'user_name' => $mobile_user->user_name,
                    'mobile_number' => $mobile_user->mobile_number
                ];
            });

            return response()->json([
                'data' => $mobile_users,
                'description' => 'success'
            ]);
        }
        catch (Exception $e) {
            return response()->json([
                "error" => "SERVER_ERROR",
                "description" => $e->getMessage()
            ], 500);
        }
    }

    public function getUserByUserName ($user_name): JsonResponse
    {
        try {
            $mobile_user = MobileUser::query()->where('user_name', '=', $user_name)->first();

            if ($mobile_user == null){
                throw new UserNotFoundException();
            }
            else {
                return response()->json([
                    "data" => $mobile_user,
                    "description" => "success"
                ]);
            }
        }
        catch (UserNotFoundException $e) {
            throw $e;
        }
        catch (Exception $e) {
            return response()->json([
                "error" => "SERVER_ERROR",
                "description" => $e->getMessage()
            ], 500);
        }
    }

    public function getUserByEmail ($email): JsonResponse
    {
        try {
            $mobile_user = MobileUser::query()->where('email', '=', $email)->first();

            if ($mobile_user == null){
                throw new UserNotFoundException();
            }
            else {
                return response()->json([
                    "data" => $mobile_user,
                    "description" => "success"
                ]);
            }
        }
        catch (UserNotFoundException $e) {
            throw $e;
        }
        catch (Exception $e) {
            return response()->json([
                "error" => "SERVER_ERROR",
                "description" => $e->getMessage()
            ], 500);
        }
    }

    public function getUserByMobileNumber ($mobile_number): JsonResponse
    {
        try {
            $mobile_user = MobileUser::query()->where('mobile_number', '=', $mobile_number)->first();

            if ($mobile_user == null){
                throw new UserNotFoundException();
            }
            else {
                return response()->json([
                    "data" => $mobile_user,
                    "description" => "success"
                ]);
            }
        }
        catch (UserNotFoundException $e) {
            throw $e;
        }
        catch (Exception $e) {
            return response()->json([
                "error" => "SERVER_ERROR",
                "description" => $e->getMessage()
            ], 500);
        }
    }

    public function createMobileUser (Request $request): JsonResponse
    {
        try {
            $mobile_user = MobileUser::query()->create([
                'user_name' => $request->get('user_name'),
                'mobile_number' => $request->get('mobile_number'),
                'email' => $request->get('email')
            ]);
            return response()->json([
                "data" => $mobile_user,
                "description" => "success"
            ]);
        }
        catch (Exception $e) {
            return response()->json([
                "error" => "SERVER_ERROR",
                "description" => $e->getMessage()
            ], 500);
        }
    }

    public function deleteUserByUserName ($user_name): JsonResponse
    {
        try {
            $id = MobileUser::query()->where('user_name', '=', $user_name)->delete();

            if ($id == null){
                throw new UserNotFoundException();
            }
            else {
                return response()->json([
                    "data" => null,
                    "description" => "success"
                ]);
            }
        }
        catch (UserNotFoundException $e) {
            throw $e;
        }
        catch (Exception $e) {
            return response()->json([
                "error" => "SERVER_ERROR",
                "description" => $e->getMessage()
            ], 500);
        }
    }

    public function deleteUserByMobileNumber ($mobile_number): JsonResponse
    {
        try {
            $id = MobileUser::query()->where('mobile_number', '=', $mobile_number)->delete();

            if ($id == null){
                throw new UserNotFoundException();
            }
            else {
                return response()->json([
                    "data" => null,
                    "description" => "success"
                ]);
            }
        }
        catch (UserNotFoundException $e) {
            throw $e;
        }
        catch (Exception $e) {
            return response()->json([
                "error" => "SERVER_ERROR",
                "description" => $e->getMessage()
            ], 500);
        }
    }

    public function deleteUserByEmail ($email): JsonResponse
    {
        try {

            $id = MobileUser::query()->where('email', '=', $email)->delete();

            if ($id == null){
                throw new UserNotFoundException();
            }
            else {
                return response()->json([
                    "data" => null,
                    "description" => "success"
                ]);
            }
        }
        catch (UserNotFoundException $e) {
            throw $e;
        }
        catch (Exception $e) {
            return response()->json([
                "error" => "SERVER_ERROR",
                "description" => $e->getMessage()
            ], 500);
        }
    }
}
