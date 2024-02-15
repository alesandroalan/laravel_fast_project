<?php

use Illuminate\Support\Facades\Route;
//in production, uncomment
//Auth::routes(['register' => false]);
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('groups', App\Http\Controllers\GroupsController::class)->middleware('can:menu_groups');

    Route::resource('permissions', App\Http\Controllers\PermissionsController::class)->middleware('can:menu_permissions');

    Route::resource('users', App\Http\Controllers\UsersController::class)->middleware('can:menu_users');

});

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);


