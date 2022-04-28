<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SliderController;



/* LoginController */
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/check-login', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::group(['namespace' => 'admin', 'middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function(){
    // Log out
    Route::get('/logout', [LoginController::class, 'log_out'])->name('logout');
    Route::get('/home', function () {
        return view('admin.index');
    })->name('home');
    //UserController actions
    Route::middleware('role:admin')->group(function() {
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
        // PermissionController actions
        Route::prefix('permissions')->group(function(){
            Route::get('/', [PermissionController::class, 'index'])->name('permission');
            Route::post('/create', [PermissionController::class, 'store'])->name('permission-store');
            Route::get('/{slug}/edit/{id}', [PermissionController::class, 'edit'])->name('permission-edit');
            Route::post('/update/{id}', [PermissionController::class, 'update'])->name('permission-update');
            Route::post('/delete', [PermissionController::class, 'destroy'])->name('permission-destroy');
        });
    });
        // MenuController actions
        Route::prefix('menu')->group(function(){
            Route::middleware('role:admin,user,author,editor')->group(function(){
                Route::get('/', [MenuController::class, 'index'])->name('menu');
            });
                Route::post('/create', [MenuController::class, 'store'])->name('menu-store')->middleware('role:admin,user,author');
                Route::post('/', [MenuController::class, 'menu_list'])->name('menu-list')->middleware('role:admin');
                Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('edit-menu')->middleware('role:admin,user,editor');
                Route::post('/update/{id}', [MenuController::class, 'update'])->name('update-menu')->middleware('role:admin,user,editor');
                Route::post('/delete', [MenuController::class, 'destroy'])->name('destroy-menu')->middleware('role:admin,user');
        });
        // SliderController actions
        Route::prefix('slider')->group(function(){
            Route::get('/', [SliderController::class, 'index'])->name('slider');
            Route::get('/create', [SliderController::class, 'create'])->name('create-slider')->middleware('can:create');
            Route::post('/store', [SliderController::class, 'store'])->name('store-slider')->middleware('can:create,App\Models\Slider');
            Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('edit-slider');
            Route::post('/update/{id}', [SliderController::class, 'update'])->name('update-slider');
            Route::post('/delete', [SliderController::class, 'destroy'])->name('destroy-slider');
        });
});

// Remplate routes
Route::group(['prefix' => 'yamifood', 'as' => 'template.'], function(){
    Route::get('/home', function(){
        return view('template.index');
    })->name('yamifood');
});


 
    


