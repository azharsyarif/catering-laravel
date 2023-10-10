<?php

use App\Models\Wali;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/', function()
// {
//     $pdo = DB::getPdo();
// });


Route::get('/', function () {
    $wali = new Wali();
    $data = $wali->getdata();
    
    return view('wali', ['data' => $data]);
});



Route::get('/', function () {
    return view('welcome');
});
