<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::prefix('user')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::get('/whoami', function (Request $request) {
        return $request->user();
    })->middleware('auth:api');
});

Route::post('/role/get', [RoleController::class, 'get_list']);
Route::post('/role/post-add', [RoleController::class, 'post_add']);
Route::post('/role/post-edit', [RoleController::class, 'post_edit']);
Route::post('/role/post-delete/{id}', [RoleController::class, 'post_delete']);

Route::post('/user-group/get', [UserGroupController::class, 'get_list']);
Route::post('/user-group/post-add', [UserGroupController::class, 'post_add']);
Route::post('/user-group/post-edit', [UserGroupController::class, 'post_edit']);
Route::post('/user-group/post-delete/{id}', [UserGroupController::class, 'post_delete']);

Route::post('/user/get', [RegisteredUserController::class, 'get_list']);
Route::post('/user/post-add', [RegisteredUserController::class, 'post_add']);
// Route::post('/user/post-edit', [RegisteredUserController::class, 'post_edit']);
Route::post('/user/post-delete/{id}', [RegisteredUserController::class, 'post_delete']);

Route::post('/log/get', [LogController::class, 'get_list']);


Route::resource('employee', EmployeeController::class, ['only' => ['index', 'show']]);
Route::post('/employee/{id}', [EmployeeController::class, 'update'])->middleware(['auth:api']);
Route::resource('employee', EmployeeController::class, ['except' => ['index', 'show']])->middleware(['auth:api']);
