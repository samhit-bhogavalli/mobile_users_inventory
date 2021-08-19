<?php

use App\Http\Controllers\MobileUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [MobileUserController::class, 'getAllUserNameAndMobile']);

Route::get('/users/{user_name}/by_user_name', [MobileUserController::class, 'getUserByUserName']);

Route::get('/users/{email}/by_email', [MobileUserController::class, 'getUserByEmail']);

Route::get('/users/{mobile_number}/by_mobile_number', [MobileUserController::class, 'getUserByMobileNumber']);

Route::post('/users', [MobileUserController::class, 'createMobileUser']);

Route::delete('users/{user_name}/delete_by_user_name', [MobileUserController::class, 'deleteUserByUserName']);

Route::delete('users/{mobile_number}/delete_by_mobile_number', [MobileUserController::class, 'deleteUserByMobileNumber']);

Route::delete('users/{email}/delete_by_email', [MobileUserController::class, 'deleteUserByEmail']);
