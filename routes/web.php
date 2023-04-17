<?php

use App\Http\Controllers\ListItems\ListItemController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Users\UserPermissionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    Route::prefix('list_items')->name('list_items.')->group(function () {
        Route::get('/datatable', [ListItemController::class, 'datatable'])->name('datatable');
        Route::put('/{listItem}/togle', [ListItemController::class, 'togle'])->name('togle');
        Route::resource('/', ListItemController::class)->parameters(['' => 'listItem']);
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/datatable', [UserController::class, 'datatable'])->name('datatable');
        Route::resource('/', UserController::class)->except('show')->parameters(['' => 'user']);
    });

    Route::prefix('user_permissions')->name('user_permissions.')->group(function () {
        Route::get('/{user}/edit', [UserPermissionController::class, 'edit'])->name('edit');
        Route::put('/{user}/update', [UserPermissionController::class, 'update'])->name('update');
    });
});
