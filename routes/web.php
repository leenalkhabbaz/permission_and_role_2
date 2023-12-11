<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {

    Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles');
    Route::get('/roles_create', [App\Http\Controllers\RoleController::class, 'create']);
    Route::post('/roles_store', [App\Http\Controllers\RoleController::class, 'store'])->name('roles_store');
    Route::get('/roles_show/{id}', [App\Http\Controllers\RoleController::class, 'show']);
    Route::get('/roles_edit/{id}', [App\Http\Controllers\RoleController::class, 'edit']);
    Route::post('/roles_update/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles_update');
    Route::delete('/roles_destroy/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles_destroy');



    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('/users_create', [App\Http\Controllers\UserController::class, 'create']);
    Route::post('/users_store', [App\Http\Controllers\UserController::class, 'store'])->name('users_store');
    Route::get('/users_show/{id}', [App\Http\Controllers\UserController::class, 'show']);
    Route::get('/users_edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
    Route::patch('/users_update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users_update');
    Route::delete('/users_destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users_destroy');



    Route::get('/articles', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles');
    Route::get('/articles_create', [App\Http\Controllers\ArticleController::class, 'create']);
    Route::post('/articles_store', [App\Http\Controllers\ArticleController::class, 'store'])->name('articles_store');
    Route::get('/articles_show/{id}', [App\Http\Controllers\ArticleController::class, 'show']);
    Route::get('/articles_edit/{id}', [App\Http\Controllers\ArticleController::class, 'edit']);
    Route::put('/articles_update/{id}', [App\Http\Controllers\ArticleController::class, 'update'])->name('articles_update');
    Route::delete('/articles_destroy/{id}', [App\Http\Controllers\ArticleController::class, 'destroy'])->name('articles_destroy');

    });

