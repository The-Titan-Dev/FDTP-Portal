<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SystemsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SystemRestrictionController;
use App\Http\Controllers\SystemAccessController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ImageController;


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
Route::get('/systems', [SystemsController::class, 'load']);
Route::get('/systems/get/{id}', [SystemsController::class, 'get']);
Route::post('/systems', [SystemsController::class, 'store']);
Route::patch('/systems/{id}', [SystemsController::class, 'update']);
Route::delete('/systems/{id}', [SystemsController::class, 'delete']);

Route::get('/role', [RoleController::class, 'load']);
Route::get('/role/get/{id}', [RoleController::class, 'get']);
Route::post('/role', [RoleController::class, 'store']);
Route::patch('/role/{id}', [RoleController::class, 'update']);
Route::delete('/role/{id}', [RoleController::class, 'delete']);

Route::get('/system-restriction', [SystemRestrictionController::class, 'load']);
Route::get('/system-restriction/get/{id}', [SystemRestrictionController::class, 'get']);
Route::post('/system-restriction', [SystemRestrictionController::class, 'store']);
Route::patch('/system-restriction/{id}', [SystemRestrictionController::class, 'update']);
Route::delete('/system-restriction/{id}', [SystemRestrictionController::class, 'delete']);

Route::get('/system-access', [SystemAccessController::class, 'load']);
Route::get('/system-access/get/{id}', [SystemAccessController::class, 'get']);
Route::post('/system-access', [SystemAccessController::class, 'store']);
Route::patch('/system-access/{id}', [SystemAccessController::class, 'update']);
Route::delete('/system-access/{id}', [SystemAccessController::class, 'delete']);

Route::get('/contact', [ContactController::class, 'load']);
Route::get('/contact/get/{id}', [ContactController::class, 'get']);
Route::post('/contact', [ContactController::class, 'store']);
Route::patch('/contact/{id}', [ContactController::class, 'update']);
Route::delete('/contact/{id}', [ContactController::class, 'delete']);

Route::get('/image', [ImageController::class, 'load']);
Route::get('/image/get/{id}', [ImageController::class, 'get']);
Route::post('/image', [ImageController::class, 'store']);
Route::patch('/image/{id}', [ImageController::class, 'update']);
Route::delete('/image/{id}', [ImageController::class, 'delete']);

Route::get('/{any}', [SpaController::class, 'index'])->where('any', '.*');