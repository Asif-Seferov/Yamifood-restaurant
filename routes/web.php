<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;

Route::group(['namespace' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::get('/home', function () {
        return view('admin.index');
    })->name('home');
    //UserController actions
    Route::prefix('users')->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::get('/create', [UserController::class, 'create'])->name('add-user');
        Route::post('/user', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::post('/delete', [UserController::class, 'destroy'])->name('user-destroy');
    }); 
    //RoleController actions
    Route::prefix('roles')->group(function(){
        Route::get('/', [RoleController::class, 'index'])->name('role');
        Route::post('/roles', [RoleController::class, 'store'])->name('role-store');
        Route::get('/{slug}/edit/{id}', [RoleController::class, 'edit'])->name('role-edit');
        Route::put('/update/{id}', [RoleController::class, 'update'])->name('role-update');
        Route::post('/delete', [RoleController::class, 'destroy'])->name('role-destroy');
    });
});
    


