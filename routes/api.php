<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SystemsController;
use App\Http\Controllers\RoleControllerup;


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


/*USERS*/
Route::get('/user/load-sections', [UserController::class, 'load_sections']);
Route::get('/user/load-hris-masterlist', [UserController::class, 'load_hris_masterlist']);
Route::get('/user/get-user-from-hris/{id}', [UserController::class, 'get_user_from_hris']);
Route::get('/user/get-user-from-local/{id}', [UserController::class, 'get_user_from_local']);
Route::post('/user/login', [UserController::class, 'login']);

/*SYSTEMS*/
Route::get('/systems/load', [SystemsController::class, 'load']);
Route::get('/systems/get/{id}', [SystemsController::class, 'get']);
Route::post('/systems/store', [SystemsController::class, 'store']);
Route::patch('/systems/update/{id}', [SystemsController::class, 'update']);
Route::delete('/systems/delete/{id}', [SystemsController::class, 'delete']);

Route::get('/role/load', [RoleController::class, 'load']);
Route::get('/role/get/{id}', [RoleController::class, 'get']);
Route::post('/role/store', [RoleController::class, 'store']);
Route::patch('/role/update/{id}', [RoleController::class, 'update']);
Route::delete('/role/delete/{id}', [RoleController::class, 'delete']);