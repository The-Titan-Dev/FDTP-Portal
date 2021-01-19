<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaController;
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

// Route::get('/', function () {
//     return view('main');
// });

// Route::get('/{any}', [SpaController::class, 'index'])->where('any', '.*');

Route::get('/user/load-sections',[UserController::class, 'load_sections']);
Route::get('/user/load-hris-masterlist',[UserController::class, 'load_hris_masterlist']);

Route::get('/user/get-user-from-hris/{id}',[UserController::class, 'get_user_from_hris']);
Route::get('/user/get-user-from-local/{id}',[UserController::class, 'get_user_from_local']);

Route::post('/user/login/',[UserController::class, 'login']);
