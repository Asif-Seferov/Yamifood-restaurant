<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::get('/home', function () {
        return view('admin.index');
    })->name('home');

    //UserController actions
    Route::prefix('users')->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::get('/create', [UserController::class, 'create'])->name('add-user');
        Route::post('/user', [UserController::class, 'store'])->name('store');
    }); 
});
    


