<?php

namespace App\Models;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MobileUserService
{
    public function getUserByUserName ($user_name): JsonResponse
    {
        $mobile_user = MobileUser::query()->where('user_name', '=', $user_name)->first();

        if ($mobile_user == null){
            return response()->json([
                "error" => "BAD_REQUEST",
                "description" => "requested user not present"
            ], 400);
        }
        else {
            return response()->json([
                "data" => $mobile_user,
                "description" => "success"
            ]);
        }
    }

    public function getUserByEmail ($email): JsonResponse
    {
        $mobile_user = MobileUser::query()->where('email', '=', $email)->first();

        if ($mobile_user == null){
            return response()->json([
                "error" => "BAD_REQUEST",
                "description" => "requested user not present"
            ], 400);
        }
        else {
            return response()->json([
                "data" => $mobile_user,
                "description" => "success"
            ]);
        }
    }

    public function getUserByMobileNumber ($mobile_number): JsonResponse
    {
        $mobile_user = MobileUser::query()->where('mobile_number', '=', $mobile_number)->first();

        if ($mobile_user == null){
            return response()->json([
                "error" => "BAD_REQUEST",
                "description" => "requested user not present"
            ], 400);
        }
        else {
            return response()->json([
                "data" => $mobile_user,
                "description" => "success"
            ]);
        }
    }

    public function createMobileUser (Request $request): JsonResponse
    {
        $mobile_user = MobileUser::query()->create([
            'user_name' => $request->get('user_name'),
            'mobile_number' => $request->get('mobile_number'),
            'email' => $request->get('email')
        ]);

        if ($mobile_user == null){
            return response()->json([
                "error" => "SERVER_ERROR",
                "description" => "db query failed"
            ], 500);
        }
        else {
            return response()->json([
                "data" => $mobile_user,
                "description" => "success"
            ]);
        }
    }

    public function deleteUserByUserName ($user_name): JsonResponse
    {
        $id = MobileUser::query()->where('user_name', '=', $user_name)->delete();

        if ($id == null){
            return response()->json([
                "error" => "SERVER_ERROR",
                "description" => "db query failed"
            ], 500);
        }
        else {
            return response()->json([
                "data" => null,
                "description" => "success"
            ]);
        }
    }

    public function deleteUserByMobileNumber ($mobile_number): JsonResponse
    {
        $id = MobileUser::query()->where('mobile_number', '=', $mobile_number)->delete();

        if ($id == null){
            return response()->json([
                "error" => "SERVER_ERROR",
                "description" => "db query failed"
            ], 500);
        }
        else {
            return response()->json([
                "data" => null,
                "description" => "success"
            ]);
        }
    }

    public function deleteUserByEmail ($email): JsonResponse
    {
        $id = MobileUser::query()->where('email', '=', $email)->delete();

        if ($id == null){
            return response()->json([
                "error" => "SERVER_ERROR",
                "description" => "db query failed"
            ], 500);
        }
        else {
            return response()->json([
                "data" => null,
                "description" => "success"
            ]);
        }
    }
}
