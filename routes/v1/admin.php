<?php

use App\Http\Controllers\AdminPanel\Admin\AdminController;
use App\Http\Controllers\AdminPanel\TourController\AdminTourController;
use Illuminate\Support\Facades\Route;




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

Route::post('store' , [AdminController::class , 'store']);
Route::post('login',[AdminController::class,'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/admin/tours', [AdminController::class, 'store']);
    Route::put('/admin/tours/{id}', [AdminController::class, 'update']);
    Route::delete('/admin/tours/{id}', [AdminController::class, 'destroy']);
});




