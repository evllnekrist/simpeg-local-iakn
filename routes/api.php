<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
// use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserGroupController;
use App\Http\Controllers\API\LogController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\StatisticController;

Route::prefix('user')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::get('/whoami', function (Request $request) {
        return $request->user();
    })->middleware('auth:api');
    Route::post('/get', [UserController::class, 'index']);
    Route::post('', [UserController::class, 'store']);
    // Route::post('/user', [UserController::class, 'update']);
    Route::post('/user/post-delete/{id}', [UserController::class, 'destroy']);
});

Route::resource('user', UserController::class, ['only' => ['index', 'show']]);
Route::post('user/{id}', [UserController::class, 'update'])->middleware(['auth:api']);
Route::resource('user', UserController::class, ['except' => ['index', 'show']])->middleware(['auth:api']);

Route::resource('role', RoleController::class, ['only' => ['index', 'show']]);
Route::post('/role/{id}', [RoleController::class, 'update'])->middleware(['auth:api']);
Route::resource('role', RoleController::class, ['except' => ['index', 'show']]);

Route::post('/user-group/get', [UserGroupController::class, 'get_list']);
Route::post('/user-group', [UserGroupController::class, 'post_add']);
Route::post('/user-group', [UserGroupController::class, 'post_edit']);
Route::post('/user-group/post-delete/{id}', [UserGroupController::class, 'post_delete']);


Route::resource('log', LogController::class, ['only' => ['index', 'show']]);
// Route::post('/log/{id}', [LogController::class, 'update'])->middleware(['auth:api']);
// Route::resource('log', LogController::class, ['except' => ['index', 'show']])->middleware(['auth:api']);

Route::resource('employee', EmployeeController::class, ['only' => ['index', 'show']]);
Route::post('/employee/{id}', [EmployeeController::class, 'update'])->middleware(['auth:api']);
Route::resource('employee', EmployeeController::class, ['except' => ['index', 'show']])->middleware(['auth:api']);

Route::get('/statistic/emp/by-count/{var}', [StatisticController::class, 'by_count_employee']);
