<?php

use App\Http\Controllers\CMSController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('phpmyinfo', function () {
    phpinfo(); 
})->name('phpmyinfo');
Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('roles', [RoleController::class, 'index'])->name('role');
    Route::get('role/add', [RoleController::class, 'form_add'])->name('role.add');
    Route::get('role/edit/{id}', [RoleController::class, 'form_edit'])->name('role.edit');

    Route::get('user-groups', [UserGroupController::class, 'index'])->name('user-group');
    Route::get('user-group/add', [UserGroupController::class, 'form_add'])->name('user-group.add');
    Route::get('user-group/edit/{id}', [UserGroupController::class, 'form_edit'])->name('user-group.edit');

    Route::get('users', [RegisteredUserController::class, 'index'])->name('user');
    Route::get('user/edit/{id}', [RegisteredUserController::class, 'form_edit'])->name('user.edit');
    Route::post('user/post-edit', [RegisteredUserController::class, 'update'])->name('user.update');
    
    Route::get('logs', [LogController::class, 'index'])->name('log');
    Route::get('faq', [HomeController::class, 'index_faq'])->name('faq');
    
    // Route::get('employees', [EmployeeController::class, 'index'])->name('employee');
    // Route::get('employee/add', [EmployeeController::class, 'form_add'])->name('employee.add');
    // Route::get('employee/edit/{id}', [EmployeeController::class, 'form_edit'])->name('employee.edit');
    
    // Route::prefix('employee')->group(function () {
    //     Route::get('s/', [EmployeeController::class, 'index'])->name('employee');
    //     Route::get('/add', [EmployeeController::class, 'form_add'])->name('employee.add');
    //     Route::get('/{id}', [EmployeeController::class, 'form_edit'])->name('employee.edit');
    // });
    Route::prefix('employee')->group(function () {
        Route::get('/', [CMSController::class, 'index_employee'])->name('employee');
        Route::get('/add', [CMSController::class, 'form_add_employee'])->name('employee.add');
        Route::get('/{id}', [CMSController::class, 'form_edit_employee'])->name('employee.edit');
    });
});

require __DIR__.'/auth.php';
