<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use OpenSpout\Common\Entity\Row;

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

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/request/otp', [AuthController::class, 'otp'])->name('otp');
Route::post('/auth/verify/otp', [AuthController::class, 'verifyOtp'])->name('verifyOtp');
Route::post('/auth/register', [AuthController::class, 'register'])->name('register');

// categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

Route::resource('tasks', TaskController::class);

Route::resource('expenses', ExpensesController::class);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', [UserController::class, 'index'])->name('user');

    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');
});
