<?php

namespace App\Models;


use App\Exceptions\InputWrongFormatException;
use App\Exceptions\UserNotFoundException;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use stdClass;

class MobileUserService
{
    public function getUserNameAndMobile (Request $request): JsonResponse
    {
        try {
            $offset = 0;
            $limit = 10;
            $mobile_user = new MobileUser();
            $conditions = [];
            $rules = [
                'user_name' => 'required|min:1|max:20',
                'mobile_number' => 'required|size:10',
                'email' => 'required|regex:/^.+@.+$/i'
            ];
            if ($request->query()){
                if ($request->query->has('offset')){
                    $offset = $request->query->get('offset');
                }
                if ($request->query->has('limit')){
                    $limit = $request->query->get('limit');
                }
                foreach ($request->query() as $key => $value) {
                    if ($key != 'offset' && $key != 'limit') {
                        foreach ($mobile_user->getTableColumns() as $val) {
                            if ($key == $val) {
                                $validator = Validator::make([$key => $value], [$key => $rules[$key]]);
                                if ($validator->fails()){
                                    throw new InputWrongFormatException($validator->errors());
                                }
                                array_push($conditions, [$key, '=', $value]);
                            }
                        }
                    }
                }
            }
            $mobile_users = MobileUser::query()->where($conditions)->offset($offset)->limit($limit)->get()->map(function ($mobile_user) {
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
    public function deleteUser (Request $request): JsonResponse
    {
        try {
            $mobile_user = new MobileUser();
            $conditions = [];
            $rules = [
                'user_name' => 'required|min:1|max:20',
                'mobile_number' => 'required|size:10',
                'email' => 'required|regex:/^.+@.+$/i'
            ];
            $flag = false;
            if ($request->query()){
                foreach ($request->query() as $key => $value) {
                    foreach ($mobile_user->getTableColumns() as $val) {
                        if ($key == $val) {
                            $validator = Validator::make([$key => $value], [$key => $rules[$key]]);
                            if ($validator->fails()){
                                throw new InputWrongFormatException($validator->errors());
                            }
                            $flag = true;
                            array_push($conditions, [$key, '=', $value]);
                        }
                    }
                }
            }

            if (!$flag) {
                throw new InputWrongFormatException("give atleast one valid on condition");
            }

            $id = MobileUser::query()->where($conditions)->delete();

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
