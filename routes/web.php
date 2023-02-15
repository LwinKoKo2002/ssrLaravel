<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\CompanyController;

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
//Frontend
Route::get('/', [PostController::class,'index']);
Route::post('/posts/store',[PostController::class,'store']);
Route::post('/posts/delete',[PostController::class,'destroy']);
Route::get('/posts/edit',[PostController::class,'edit']);
Route::post('/posts/update',[PostController::class,'update']);
// Auth
require __DIR__.'/auth.php';
//Backend
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function(){
    Route::get('/',[PageController::class,'index'])->name('dashboard');
    Route::resource('company',CompanyController::class);
});