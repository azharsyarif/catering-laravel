<?php

use App\Http\Controllers\Ordercontroller;
use App\Models\Wali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Anakcontroller;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\Categorycontroller;
use App\Http\Controllers\DapurController;
use App\Http\Controllers\Menucontroller;
use App\Http\Controllers\Walicontroller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// API Login Wali
Route::post('/user/register', [WaliController::class, 'register']);
Route::post('/user/login',[Walicontroller:: class, 'login']);


// API Login Auth
Route::post('/auth/register',[Authcontroller:: class, 'register']);
Route::post('/auth/login',[Authcontroller:: class, 'login']);

// API Menu
Route::get('/menu', [MenuController::class, 'index']);
Route::get('menu/{id}', [MenuController::class, 'show']);
Route::post('/menu/create', [MenuController::class, 'create']);
Route::post('/menu/update{id}', [MenuController::class, 'update']);
Route::post('/menu/hapus{id}', [MenuController::class, 'destroy']);

// API Wali
Route::apiResource('wali',Walicontroller::class);
Route::get('wali/{id}', [Walicontroller::class, 'show']);
Route::post('wali/create', [Walicontroller::class, 'create']);
Route::post('/wali/update{id}', [WaliController::class, 'update']);
Route::post('/wali/hapus{id}', [WaliController::class, 'delete']);

//API Anak
Route::get('/anak', [Anakcontroller::class, 'index']);
Route::get('anak/{id}', [Anakcontroller::class, 'show']);
Route::post('anak/create', [Anakcontroller::class, 'create']);
Route::post('/anak/update{id}', [Anakcontroller::class, 'update']);
Route::post('/anak/hapus{id}', [Anakcontroller::class, 'delete']);


// API Dapur
Route::post('/dapur/register', [DapurController::class, 'register']);
Route::post('/dapur/login', [DapurController::class, 'login']);
Route::get('/dapur', [DapurController::class, 'index']);
Route::get('dapur/{id}', [DapurController::class, 'show']);
Route::post('dapur/create', [DapurController::class, 'create']);
Route::post('/dapur/update{id}', [DapurController::class, 'update']);
Route::post('/dapur/hapus{id}', [DapurController::class, 'delete']);

// API Order
Route::apiResource('order', Ordercontroller::class);
Route::post('order/create', [Ordercontroller::class, 'create']);
Route::post('order/update{id}', [Ordercontroller::class, 'update']);
Route::post('order/delete{id}', [Ordercontroller::class, 'delete']);


// API Category
Route::apiResource('category', Categorycontroller::class);
Route::post('category/{id}', [Categorycontroller::class, 'create']);
Route::post('category/crate', [Categorycontroller::class, 'create']);
Route::post('category/update{id}', [Categorycontroller::class, 'update']);
Route::post('category/delete{id}', [Categorycontroller::class, 'delete']);





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});