<?php

namespace App\Models;


use App\Exceptions\UserNotFoundException;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use stdClass;

class MobileUserService
{
    public function getAllUserNameAndMobile (Request $request): JsonResponse
    {
        try {
            $offset = 0;
            $limit = 10;
            if ($request->query()){
                if ($request->query->has('offset')){
                    $offset = $request->query->get('offset');
                }
                if ($request->query->has('limit')){
                    $limit = $request->query->get('limit');
                }
            }
            $mobile_users = MobileUser::query()->offset($offset)->limit($limit)->get()->map(function ($mobile_user) {
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

    /**
     * @throws UserNotFoundException
     */
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

    /**
     * @throws UserNotFoundException
     */
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

    /**
     * @throws UserNotFoundException
     */
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
        catch (QueryException $queryException) {
            return response()->json([
                "error" => "BAD_REQUEST",
                "description" => "one of the field in request are already used"
            ], 400);
        }
        catch (Exception $e) {
            return response()->json([
                "error" => "SERVER_ERROR",
                "description" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @throws UserNotFoundException
     */
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

    /**
     * @throws UserNotFoundException
     */
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

    /**
     * @throws UserNotFoundException
     */
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
