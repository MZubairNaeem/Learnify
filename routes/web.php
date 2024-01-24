<?php

use App\Http\Controllers\UserManagement\RoleController;
use App\Http\Controllers\UserManagement\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes();
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [HomeController::class, 'root'])->name('root');

    //user routes
    Route::controller(UserController::class)->group(function(){
        Route::prefix('users')->group(function () {
            Route::get('/list','index')->name('viewusers');
            Route::get('/create','create')->name('addusers');
            Route::post('/store','store')->name('storeuser');
            Route::post('/update/{id}','update')->name('updateuser');
            Route::delete('/delete/{id}','destroy')->name('deleteusers');
        });
    });

    //role routes
    Route::controller(RoleController::class)->group(function(){
        Route::prefix('roles')->group(function () {
            Route::get('/list','index')->name('viewroles');
            Route::get('/create','create')->name('addroles');
            Route::post('/store','store')->name('storerole');
            Route::get('/edit/{id}','edit')->name('editroles');
            Route::post('/update/{id}','update')->name('updaterole');
            Route::delete('/delete/{id}','destroy')->name('deleterole');
        });
    });

});

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

// Update User Details

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
