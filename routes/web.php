<?php

use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[\App\Http\Controllers\AuthController::class,'index'])->name('auth.index');
Route::post('/login',[\App\Http\Controllers\AuthController::class,'verify'])->name('auth.verify');

Route::group(['middleware' => 'auth:user'], function (){
    Route::prefix('admin')->group(function (){
        Route::get('/',[\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

        Route::get('/user',[\App\Http\Controllers\UserController::class,'index'])->name('user.index');
    });
});

