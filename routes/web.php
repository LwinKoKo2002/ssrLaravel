<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/', [PostController::class,'index']);
Route::post('/posts/store',[PostController::class,'create']);
Route::post('/posts/delete',[PostController::class,'destroy']);
Route::get('/posts/edit',[PostController::class,'edit']);
Route::post('/posts/update',[PostController::class,'update']);
