<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\TodoController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group( ['middleware' => 'auth:sanctum' ], function () {
    Route::post('/todo/create', [TodoController::class, 'create']);
    Route::put('/todo/edit/{id}', [TodoController::class, 'edit']);
    Route::delete('/todo/delete/{id}', [TodoController::class, 'delete']);
    Route::get('/todo/get', [TodoController::class, 'getTodos']);
    Route::get('/todo/get/{id}', [TodoController::class, 'getTodoById']);
    Route::post('/logout', [UserAuthController::class, 'logout']);
    Route::get('/users', [UserAuthController::class, 'getUsers']);



    // users endpoints
});

Route::get('/home', [UserAuthController::class, 'home']);
Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/login', [UserAuthController::class, 'login']);
Route::get('unauthorized', [UserAuthController::class, 'unauthorized'])->name('unauthorized');





