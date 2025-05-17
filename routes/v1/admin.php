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

Route::post('/register' , [AdminController::class , 'register']);
Route::post('/login',[AdminController::class,'login']);

Route::get('tst' , function (){
   dd('fdfdffddf');
});

 //Tours
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/tours', [AdminController::class, 'storeTours']);
    Route::put('/tours/{id}', [AdminController::class, 'updateTours']);
    Route::delete('/tours/{id}', [AdminController::class, 'destroyTours']);
});





